<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::query()
            ->orderBy('starts_at')
            ->limit(500)
            ->get();

        $appointmentsForJs = $appointments->map(function (Appointment $appointment): array {
            return [
                'id' => $appointment->id,
                'title' => $appointment->name,
                'status' => $appointment->status,
                'starts_at' => $appointment->starts_at?->toIso8601String(),
                'ends_at' => $appointment->ends_at?->toIso8601String(),
                'email' => $appointment->email,
                'phone' => $appointment->phone,
            ];
        })->values();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'appointmentsForJs' => $appointmentsForJs,
        ]);
    }

    public function approve(Appointment $appointment): RedirectResponse
    {
        if ($appointment->status !== 'confirmed') {
            $appointment->update(['status' => 'confirmed']);
        }

        return back()->with('success', 'Appointment approved successfully.');
    }
}
