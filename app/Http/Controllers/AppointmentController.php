<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointment');
    }

    public function availability(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
        ]);

        $date = Carbon::parse($validated['date'])->startOfDay();
        $duration = 60;
        $timezone = config('app.timezone');

        $startOfBusiness = $date->copy()->setTime(9, 0);
        $endOfBusiness = $date->copy()->setTime(17, 0);

        $appointments = Appointment::query()
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereDate('starts_at', $date->toDateString())
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

            $isPastCutoff = $slotStart->lt(now()->addMinutes(30));

            $slots[] = [
                'time' => $slotStart->format('H:i'),
                'label' => $slotStart->format('H:i') . ' - ' . $slotEnd->format('H:i'),
                'available' => !$hasOverlap && !$isPastCutoff,
            ];

            $cursor->addMinutes(30);
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:120'],
            'appointment_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $startsAt = Carbon::parse($validated['appointment_date'] . ' ' . $validated['start_time']);
        $duration = 60;
        $endsAt = $startsAt->copy()->addMinutes($duration);
        $endOfBusiness = Carbon::parse($validated['appointment_date'])->setTime(17, 0);

        if ($startsAt->lt(now()->addMinutes(30))) {
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

        Appointment::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => 'pending',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Appointment request submitted. Our team will contact you shortly.',
            ]);
        }

        return redirect()
            ->route('appointments.create')
            ->with('success', 'Appointment request submitted. Our team will contact you shortly.');
    }
}
