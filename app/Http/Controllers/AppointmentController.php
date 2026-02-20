<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentSubmitted;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class AppointmentController extends Controller
{
    private const APPOINTMENT_TIMEZONE = '+08:00';

    public function create()
    {
        $phoneCodes = Country::query()
            ->select(['name', 'phonecode'])
            ->whereNotNull('phonecode')
            ->where('phonecode', '!=', '')
            ->orderBy('name')
            ->get()
            ->map(function (Country $country): array {
                $digits = preg_replace('/\D+/', '', (string) $country->phonecode);
                $code = $digits ? '+' . $digits : '';

                return [
                    'name' => $country->name,
                    'code' => $code,
                    'label' => $country->name . ' (' . $code . ')',
                ];
            })
            ->filter(fn (array $item) => $item['code'] !== '')
            ->unique('code')
            ->values();

        return view('appointment', [
            'phoneCodes' => $phoneCodes,
            'turnstileEnabled' => (bool) config('services.cloudflare_turnstile.enabled', false),
            'turnstileSiteKey' => (string) config('services.cloudflare_turnstile.site_key', ''),
        ]);
    }

    public function availability(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
        ]);

        $appointmentTimezone = self::APPOINTMENT_TIMEZONE;
        $date = Carbon::createFromFormat('Y-m-d', $validated['date'], $appointmentTimezone)->startOfDay();
        $duration = 60;
        $timezone = 'UTC+8';

        $startOfBusiness = $date->copy()->setTime(9, 0);
        $endOfBusiness = $date->copy()->setTime(17, 0);
        $startOfDay = $date->copy()->startOfDay();
        $endOfDay = $date->copy()->endOfDay();
        $nowInAppointmentTimezone = now($appointmentTimezone);

        $appointments = Appointment::query()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('starts_at', '<', $endOfDay)
            ->where('ends_at', '>', $startOfDay)
            ->get(['starts_at', 'ends_at']);

        $slots = [];
        $cursor = $startOfBusiness->copy();
        $latestStart = $endOfBusiness->copy()->subMinutes($duration);

        while ($cursor->lte($latestStart)) {
            $slotStart = $cursor->copy();
            $slotEnd = $slotStart->copy()->addMinutes($duration);
            $hasOverlap = $appointments->contains(function ($appointment) use ($slotStart, $slotEnd) {
                return $appointment->starts_at->lt($slotEnd) && $appointment->ends_at->gt($slotStart);
            });

            $isPastCutoff = $slotStart->lt($nowInAppointmentTimezone->copy()->addMinutes(30));

            $slots[] = [
                'date' => $slotStart->format('Y-m-d'),
                'time' => $slotStart->format('H:i'),
                'end_time' => $slotEnd->format('H:i'),
                'label' => $slotStart->format('H:i') . ' - ' . $slotEnd->format('H:i'),
                'starts_at_iso' => $slotStart->toIso8601String(),
                'ends_at_iso' => $slotEnd->toIso8601String(),
                'available' => !$hasOverlap && !$isPastCutoff,
            ];

            $cursor->addMinutes(60);
        }

        return response()->json([
            'date' => $date->toDateString(),
            'duration_minutes' => 60,
            'timezone' => $timezone,
            'slots' => $slots,
        ]);
    }

    public function store(Request $request)
    {
        if ($turnstileError = $this->validateTurnstile($request)) {
            return $this->validationErrorResponse($request, [
                'captcha' => [$turnstileError],
            ]);
        }

        if (filled($request->input('website'))) {
            return $this->validationErrorResponse(
                $request,
                ['name' => ['Unable to submit appointment request. Please try again.']]
            );
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone_country_code' => ['required', 'string', 'regex:/^\+\d{1,4}$/'],
            'phone_number' => ['required', 'string', 'max:30', 'regex:/^[0-9\s\-()]+$/'],
            'company' => ['nullable', 'string', 'max:120'],
            'appointment_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        if ($contentViolation = $this->detectContentViolation($validated)) {
            return $this->validationErrorResponse($request, [
                $contentViolation['field'] => [$contentViolation['message']],
            ]);
        }

        $phoneNumber = preg_replace('/\s+/', '', (string) $validated['phone_number']);
        $fullPhone = trim($validated['phone_country_code'] . ' ' . $phoneNumber);

        $appointmentTimezone = self::APPOINTMENT_TIMEZONE;
        $startsAt = Carbon::createFromFormat('Y-m-d H:i', $validated['appointment_date'] . ' ' . $validated['start_time'], $appointmentTimezone);
        $duration = 60;
        $endsAt = $startsAt->copy()->addMinutes($duration);
        $endOfBusiness = Carbon::createFromFormat('Y-m-d', $validated['appointment_date'], $appointmentTimezone)->setTime(17, 0);

        if ($startsAt->lt(now($appointmentTimezone)->addMinutes(30))) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => ['appointment_date' => ['Please choose a future time at least 30 minutes from now.']],
                ], 422);
            }
            return back()
                ->withInput()
                ->withErrors(['appointment_date' => 'Please choose a future time at least 30 minutes from now.']);
        }

        if ($startsAt->diffInMinutes($endsAt) > 60) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => ['start_time' => ['Appointment duration cannot exceed 1 hour.']],
                ], 422);
            }
            return back()
                ->withInput()
                ->withErrors(['start_time' => 'Appointment duration cannot exceed 1 hour.']);
        }

        if ($endsAt->gt($endOfBusiness)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => ['start_time' => ['Please choose a timeslot that ends by 17:00.']],
                ], 422);
            }
            return back()
                ->withInput()
                ->withErrors(['start_time' => 'Please choose a timeslot that ends by 17:00.']);
        }

        $hasOverlap = Appointment::query()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('starts_at', '<', $endsAt)
            ->where('ends_at', '>', $startsAt)
            ->exists();

        if ($hasOverlap) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => ['start_time' => ['This timeslot is already booked. Please pick another time.']],
                ], 422);
            }
            return back()
                ->withInput()
                ->withErrors(['start_time' => 'This timeslot is already booked. Please pick another time.']);
        }

        $appointment = Appointment::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $fullPhone,
            'company' => $validated['company'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => 'pending',
        ]);

        // Guard against unintended timezone shifts in persisted data.
        $storedStart = $appointment->fresh()->starts_at?->copy()->timezone($appointmentTimezone);
        if (!$storedStart || $storedStart->format('Y-m-d H:i') !== $startsAt->format('Y-m-d H:i')) {
            $appointment->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => ['start_time' => ['Timezone validation failed. Please choose the slot again.']],
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors(['start_time' => 'Timezone validation failed. Please choose the slot again.']);
        }

        $notificationRecipient = (string) config('mail.notifications.appointments', config('mail.from.address'));

        if ($notificationRecipient !== '') {
            try {
                // To Admin/Bookings
                Mail::to($notificationRecipient)->send(new AppointmentSubmitted($appointment));
                
                // To User
                Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment));

            } catch (Throwable $e) {
                report($e);

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Appointment request submitted, but notification email delivery failed.',
                    ]);
                }

                return redirect()
                    ->route('appointments.create')
                    ->with('warning', 'Appointment request submitted, but notification email delivery failed.');
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Appointment request submitted. Our team will contact you shortly.',
            ]);
        }

        return redirect()
            ->route('appointments.create')
            ->with('success', 'Appointment request submitted. Our team will contact you shortly.');
    }

    private function detectContentViolation(array $validated): ?array
    {
        $badWords = [
            'anjing', 'bangsat', 'bajingan', 'kontol', 'memek',
            'fuck', 'bitch', 'asshole', 'motherfucker', 'bastard',
        ];

        $spamPhrases = [
            'buy now', 'click here', 'free money', 'earn money fast',
            'crypto giveaway', 'loan approval', 'casino', 'adult dating',
            'viagra', 'work from home and earn',
        ];

        $fieldsToScan = [
            'name' => (string) ($validated['name'] ?? ''),
            'company' => (string) ($validated['company'] ?? ''),
            'notes' => (string) ($validated['notes'] ?? ''),
        ];

        foreach ($fieldsToScan as $field => $value) {
            if ($value === '') {
                continue;
            }

            $normalized = Str::lower($value);

            foreach ($badWords as $term) {
                if (preg_match('/\b' . preg_quote($term, '/') . '\b/u', $normalized)) {
                    return [
                        'field' => $field,
                        'message' => 'Please remove inappropriate words from your input.',
                    ];
                }
            }

            foreach ($spamPhrases as $term) {
                if (str_contains($normalized, $term)) {
                    return [
                        'field' => $field,
                        'message' => 'Your input looks like spam. Please revise and try again.',
                    ];
                }
            }

            if (preg_match('/https?:\/\/|www\./i', $value)) {
                return [
                    'field' => $field,
                    'message' => 'Please remove links from this field.',
                ];
            }

            if (preg_match('/(.)\1{6,}/u', $value)) {
                return [
                    'field' => $field,
                    'message' => 'Please avoid repeated characters.',
                ];
            }
        }

        return null;
    }

    private function validationErrorResponse(Request $request, array $errors)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $errors,
            ], 422);
        }

        return back()->withInput()->withErrors($errors);
    }

    private function validateTurnstile(Request $request): ?string
    {
        $enabled = (bool) config('services.cloudflare_turnstile.enabled', false);
        if (!$enabled) {
            return null;
        }

        $token = (string) $request->input('cf-turnstile-response', '');
        if ($token === '') {
            return 'Please complete the Cloudflare verification.';
        }

        $secret = (string) config('services.cloudflare_turnstile.secret_key', '');
        $verifyUrl = (string) config('services.cloudflare_turnstile.verify_url', '');
        if ($secret === '' || $verifyUrl === '') {
            Log::warning('Cloudflare Turnstile is enabled but not fully configured.');
            return 'Captcha verification is currently unavailable. Please try again later.';
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post($verifyUrl, [
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $request->ip(),
                ]);

            if (!$response->ok()) {
                Log::warning('Cloudflare Turnstile verification failed with non-200 response.', [
                    'status' => $response->status(),
                ]);
                return 'Captcha verification failed. Please try again.';
            }

            $result = $response->json();
            if (!is_array($result) || !($result['success'] ?? false)) {
                Log::warning('Cloudflare Turnstile verification failed.', [
                    'error_codes' => $result['error-codes'] ?? [],
                ]);
                return 'Captcha verification failed. Please try again.';
            }
        } catch (Throwable $e) {
            Log::warning('Cloudflare Turnstile request error.', [
                'error' => $e->getMessage(),
            ]);
            return 'Captcha verification failed. Please try again.';
        }

        return null;
    }
}
