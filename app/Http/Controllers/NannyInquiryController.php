<?php

namespace App\Http\Controllers;

use App\Mail\NannyInquiryWeddingUpdated;
use App\Models\NannyInquiry;
use App\Models\WeddingEvent;
use App\Support\NannyInquiryWeddingCsv;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class NannyInquiryController extends Controller
{
    public function create(Request $request)
    {
        $prefillWedding = null;
        $eventToken = trim((string) $request->query('event', ''));

        if ($eventToken !== '') {
            $event = WeddingEvent::query()
                ->where('share_token', $eventToken)
                ->where('is_active', true)
                ->first();

            if ($event) {
                $prefillWedding = [
                    'wedding_couple_names' => $event->couple_names,
                    'wedding_date' => $event->wedding_date?->format('Y-m-d'),
                    'wedding_start_time' => $event->wedding_start_time,
                    'wedding_location_address' => $event->wedding_location_address,
                    'wedding_venue_name' => $event->wedding_venue_name,
                ];
            }
        }

        return view('forms.nannies-inquiry', [
            'prefillWedding' => $prefillWedding,
            'eventToken' => $eventToken,
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $guardianCountryCode = trim((string) $request->input('guardian_country_code', ''));
        $guardianPhoneLocal = trim((string) $request->input('guardian_phone_local', ''));
        $guardianPhone = trim((string) $request->input('guardian_phone', ''));

        if ($guardianPhone === '' && $guardianCountryCode !== '' && $guardianPhoneLocal !== '') {
            $request->merge([
                'guardian_phone' => $guardianCountryCode.' '.$guardianPhoneLocal,
            ]);
        }

        $validated = $request->validate([
            'wedding_couple_names' => ['required', 'string', 'max:190'],
            'wedding_date' => ['required', 'date'],
            'wedding_start_time' => ['required', 'date_format:H:i'],
            'wedding_location_address' => ['required', 'string', 'max:2000'],
            'wedding_venue_name' => ['nullable', 'string', 'max:190'],
            'guardian_name' => ['required', 'string', 'max:120'],
            'guardian_country_code' => ['required', 'string', 'max:10'],
            'guardian_phone_local' => ['required', 'string', 'max:40'],
            'guardian_phone' => ['required', 'string', 'max:50'],
            'guardian_email' => ['required', 'email', 'max:190'],
            'children_count' => ['required', 'in:1,2,3,4+'],
            'nannies_required' => ['required', 'in:1,2,3,4,5+'],
            'child_name' => ['required', 'array', 'min:1'],
            'child_name.*' => ['required', 'string', 'max:120'],
            'child_age' => ['required', 'array', 'min:1'],
            'child_age.*' => ['required', 'string', 'max:60'],
            'child_special_requirement' => ['nullable', 'array'],
            'child_special_requirement.*' => ['nullable', 'string', 'max:2000'],
            'accommodation_location_option' => ['required', 'in:wedding,prior'],
            'accommodation_detail' => ['nullable', 'string', 'max:2000'],
            'ceremony_service_choice' => ['required', 'in:yes,no'],
            'additional_hours' => ['nullable', 'string', 'max:4000'],
            'payment_acknowledgement' => ['required', 'in:agreed'],
        ]);

        $childNames = $validated['child_name'] ?? [];
        $childAges = $validated['child_age'] ?? [];
        $childSpecials = $validated['child_special_requirement'] ?? [];
        $childCountFromSelector = $validated['children_count'] === '4+' ? 4 : (int) $validated['children_count'];

        if (count($childNames) !== count($childAges) || count($childNames) !== $childCountFromSelector) {
            return $this->invalidChildrenResponse($request);
        }

        $children = [];
        foreach ($childNames as $index => $name) {
            $children[] = [
                'name' => trim((string) $name),
                'age' => trim((string) ($childAges[$index] ?? '')),
                'special_requirement' => trim((string) ($childSpecials[$index] ?? '')),
            ];
        }

        $accommodationValue = (string) $validated['accommodation_location_option'];
        $accommodationLabel = $accommodationValue === 'wedding'
            ? 'a. at the wedding'
            : 'b. prior to the wedding';
        $ceremonyLabel = (string) $validated['ceremony_service_choice'] === 'yes'
            ? 'Yes - Use 1-hour subsidized ceremony service'
            : 'No - i will pay by myself';
        $accommodationDetail = trim((string) ($validated['accommodation_detail'] ?? ''));
        $additionalHours = trim((string) ($validated['additional_hours'] ?? ''));
        $weddingVenueName = trim((string) ($validated['wedding_venue_name'] ?? ''));
        $weddingGroupKey = NannyInquiryWeddingCsv::groupKey(
            (string) $validated['wedding_couple_names'],
            (string) $validated['wedding_date'],
        );

        $childLines = array_map(function (array $child, int $index): string {
            $special = $child['special_requirement'] !== '' ? $child['special_requirement'] : '-';

            return 'Child ' . ($index + 1) . ': Name: ' . $child['name'] . '; Age: ' . $child['age'] . '; Special Requirements: ' . $special;
        }, $children, array_keys($children));

        $messageLines = [
            '*Wedding Nanny Service Inquiry Form*',
            '',
            '*Wedding Details*',
            'Wedding Of: ' . $validated['wedding_couple_names'],
            'Wedding Date: ' . $validated['wedding_date'],
            'Wedding Start Time: ' . $validated['wedding_start_time'],
            'Wedding Location Address: ' . $validated['wedding_location_address'],
            'Hotel/Villa Venue Name: ' . ($weddingVenueName !== '' ? $weddingVenueName : '-'),
            '',
            '*1. Parent / Guardian Information*',
            'Full Name: ' . $validated['guardian_name'],
            'Phone/WhatsApp: ' . $validated['guardian_phone'],
            'Email: ' . $validated['guardian_email'],
            '',
            '*2. Child(ren) Details*',
            'Number of Children: ' . $validated['children_count'],
            'Number of Nannies Needed: ' . $validated['nannies_required'],
            ...$childLines,
            '',
            '*3. Service Requirements*',
            'Accommodation Location: ' . $accommodationLabel,
            'Accommodation Detail Location: ' . ($accommodationDetail !== '' ? $accommodationDetail : '-'),
            'Wedding Ceremony Service: ' . $ceremonyLabel,
            'Additional Hours Needed: ' . ($additionalHours !== '' ? $additionalHours : '-'),
            '',
            '*4. Agreement*',
            'Payment Acknowledgement: I understand this booking is NOT confirmed until i make full payment.',
        ];
        $whatsAppMessage = implode("\n", $messageLines);

        $inquiry = NannyInquiry::create([
            'wedding_couple_names' => $validated['wedding_couple_names'],
            'wedding_date' => $validated['wedding_date'],
            'wedding_start_time' => $validated['wedding_start_time'],
            'wedding_location_address' => $validated['wedding_location_address'],
            'wedding_venue_name' => $weddingVenueName !== '' ? $weddingVenueName : null,
            'wedding_group_key' => $weddingGroupKey,
            'guardian_name' => $validated['guardian_name'],
            'guardian_phone' => $validated['guardian_phone'],
            'guardian_email' => $validated['guardian_email'],
            'children_count' => $validated['children_count'],
            'nannies_required' => $validated['nannies_required'],
            'children' => $children,
            'accommodation_location_option' => $validated['accommodation_location_option'],
            'accommodation_detail' => $accommodationDetail !== '' ? $accommodationDetail : null,
            'ceremony_service_choice' => $validated['ceremony_service_choice'],
            'additional_hours' => $additionalHours,
            'payment_acknowledgement' => $validated['payment_acknowledgement'],
            'whatsapp_message' => $whatsAppMessage,
            'submitted_from_ip' => $request->ip(),
            'submitted_user_agent' => $request->userAgent(),
        ]);

        $notificationRecipient = trim((string) config('mail.notifications.nanny_inquiries', config('mail.notifications.appointments', config('mail.from.address'))));
        if ($notificationRecipient !== '') {
            try {
                $weddingInquiries = NannyInquiry::query()
                    ->where('wedding_group_key', $weddingGroupKey)
                    ->orderBy('created_at')
                    ->get();
                $csvExport = NannyInquiryWeddingCsv::build($weddingInquiries);

                Mail::to($notificationRecipient)->send(
                    new NannyInquiryWeddingUpdated(
                        inquiry: $inquiry,
                        groupedInquiries: $weddingInquiries,
                        csvFilename: $csvExport['filename'],
                        csvContent: $csvExport['content'],
                        totalChildren: $csvExport['total_children'],
                        totalNannies: $csvExport['total_nannies'],
                    )
                );
            } catch (Throwable $e) {
                report($e);
            }
        }

        $waNumber = preg_replace('/\D+/', '', (string) config('services.whatsapp.inquiry_number', '6285739660906'));
        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($whatsAppMessage);

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Inquiry submitted successfully.',
                'whatsapp_url' => $waUrl,
            ]);
        }

        return redirect()->away($waUrl);
    }

    private function invalidChildrenResponse(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => [
                    'children_count' => ['Child details do not match the selected number of children.'],
                ],
            ], 422);
        }

        return back()
            ->withInput()
            ->withErrors([
                'children_count' => 'Child details do not match the selected number of children.',
            ]);
    }
}
