<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminLeadController extends Controller
{
    private const LEAD_STATUS_OPTIONS = ['new', 'contacted', 'qualified', 'lost'];

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $leadStatus = trim((string) $request->query('lead_status', ''));
        $appointmentStatus = trim((string) $request->query('appointment_status', ''));

        $leads = Appointment::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($sub) use ($search): void {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%");
                });
            })
            ->when(in_array($leadStatus, self::LEAD_STATUS_OPTIONS, true), function ($query) use ($leadStatus): void {
                $query->where('lead_status', $leadStatus);
            })
            ->when(in_array($appointmentStatus, ['pending', 'confirmed', 'cancelled'], true), function ($query) use ($appointmentStatus): void {
                $query->where('status', $appointmentStatus);
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.leads.index', [
            'leads' => $leads,
            'search' => $search,
            'leadStatus' => $leadStatus,
            'appointmentStatus' => $appointmentStatus,
            'leadStatusOptions' => self::LEAD_STATUS_OPTIONS,
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'lead_status' => ['required', 'in:' . implode(',', self::LEAD_STATUS_OPTIONS)],
            'lead_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $appointment->update([
            'lead_status' => $validated['lead_status'],
            'lead_notes' => $validated['lead_notes'] ?? null,
        ]);

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Lead updated successfully.',
                'lead_status' => $appointment->lead_status,
            ]);
        }

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead updated successfully.');
    }
}

