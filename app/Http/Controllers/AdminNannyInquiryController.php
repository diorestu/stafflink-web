<?php

namespace App\Http\Controllers;

use App\Models\NannyInquiry;
use App\Models\WeddingEvent;
use App\Support\NannyInquiryWeddingCsv;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminNannyInquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $baseQuery = NannyInquiry::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($sub) use ($search): void {
                    $sub->where('guardian_name', 'like', "%{$search}%")
                        ->orWhere('guardian_email', 'like', "%{$search}%")
                        ->orWhere('guardian_phone', 'like', "%{$search}%")
                        ->orWhere('wedding_couple_names', 'like', "%{$search}%")
                        ->orWhere('unique_code', 'like', "%{$search}%")
                        ->orWhere('wedding_date', 'like', "%{$search}%");
                });
            });

        $inquiries = (clone $baseQuery)
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $groupedBookings = (clone $baseQuery)
            ->whereNotNull('wedding_group_key')
            ->select('wedding_group_key', 'wedding_couple_names', 'unique_code', 'wedding_date')
            ->selectRaw('COUNT(*) as total_families')
            ->selectRaw("SUM(CASE WHEN children_count = '4+' THEN 4 ELSE CAST(children_count AS UNSIGNED) END) as total_children")
            ->selectRaw("SUM(CASE WHEN nannies_required = '5+' THEN 5 ELSE CAST(COALESCE(nannies_required, '0') AS UNSIGNED) END) as total_nannies")
            ->groupBy('wedding_group_key', 'wedding_couple_names', 'unique_code', 'wedding_date')
            ->orderByDesc('wedding_date')
            ->get();

        $weddingEvents = WeddingEvent::query()
            ->orderByDesc('wedding_date')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        return view('admin.nanny-inquiries.index', [
            'inquiries' => $inquiries,
            'search' => $search,
            'groupedBookings' => $groupedBookings,
            'weddingEvents' => $weddingEvents,
        ]);
    }

    public function storeWeddingEvent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'couple_names' => ['required', 'string', 'max:190'],
            'unique_code' => ['required', 'string', 'max:40', 'regex:/^[A-Za-z0-9-]+$/', 'unique:wedding_events,unique_code'],
            'wedding_date' => ['required', 'date'],
            'wedding_start_time' => ['required', 'date_format:H:i'],
            'wedding_location_address' => ['required', 'string', 'max:2000'],
            'wedding_venue_name' => ['nullable', 'string', 'max:190'],
        ]);

        $uniqueCode = strtoupper(trim((string) $validated['unique_code']));
        $tokenBase = Str::slug((string) $validated['couple_names']).'-'.$validated['wedding_date'].'-'.Str::slug($uniqueCode);
        $shareToken = $tokenBase;
        $counter = 1;
        while (WeddingEvent::query()->where('share_token', $shareToken)->exists()) {
            $counter++;
            $shareToken = $tokenBase.'-'.$counter;
        }

        WeddingEvent::create([
            'couple_names' => $validated['couple_names'],
            'unique_code' => $uniqueCode,
            'wedding_date' => $validated['wedding_date'],
            'wedding_start_time' => $validated['wedding_start_time'],
            'wedding_location_address' => $validated['wedding_location_address'],
            'wedding_venue_name' => trim((string) ($validated['wedding_venue_name'] ?? '')) ?: null,
            'share_token' => $shareToken,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.nanny-inquiries.index')
            ->with('success', 'Wedding event saved. Share link generated in the event list below.');
    }

    public function exportWedding(Request $request): StreamedResponse
    {
        $groupKey = trim((string) $request->query('wedding', ''));
        abort_if($groupKey === '', 404);

        $inquiries = NannyInquiry::query()
            ->where('wedding_group_key', $groupKey)
            ->orderBy('created_at')
            ->get();

        abort_if($inquiries->isEmpty(), 404);

        $csvExport = NannyInquiryWeddingCsv::build($inquiries);

        return response()->streamDownload(
            static function () use ($csvExport): void {
                echo $csvExport['content'];
            },
            $csvExport['filename'],
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]
        );
    }

    public function destroy(NannyInquiry $nannyInquiry): RedirectResponse
    {
        $nannyInquiry->delete();

        return redirect()
            ->route('admin.nanny-inquiries.index')
            ->with('success', 'Nanny inquiry deleted.');
    }

    public function destroyWeddingEvent(WeddingEvent $weddingEvent): RedirectResponse
    {
        $weddingEvent->delete();

        return redirect()
            ->route('admin.nanny-inquiries.index')
            ->with('success', 'Wedding event deleted.');
    }
}
