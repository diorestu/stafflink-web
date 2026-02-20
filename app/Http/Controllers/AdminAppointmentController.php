<?php

namespace App\Http\Controllers;

use App\Events\AppointmentApproved;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function approve(Appointment $appointment): RedirectResponse|JsonResponse
    {
        $updated = Appointment::query()
            ->whereKey($appointment->id)
            ->where('status', '!=', 'confirmed')
            ->update(['status' => 'confirmed']);

        if ($updated > 0) {
            dispatch(function () use ($appointment): void {
                $fresh = Appointment::query()->find($appointment->id);
                if (!$fresh) {
                    return;
                }

                try {
                    event(new AppointmentApproved($fresh));
                } catch (\Throwable $e) {
                    report($e);
                    Log::error('Failed to dispatch AppointmentApproved event.', [
                        'appointment_id' => $appointment->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            })->afterResponse();
        }

        if (request()->expectsJson() || request()->wantsJson()) {
            return response()->json([
                'message' => 'Appointment approved successfully.',
                'status' => 'confirmed',
                'appointment_id' => $appointment->id,
            ]);
        }

        return back()->with('success', 'Appointment approved successfully.');
    }

    public function cancel(Appointment $appointment, Request $request): RedirectResponse|JsonResponse
    {
        $updated = Appointment::query()
            ->whereKey($appointment->id)
            ->where('status', '!=', 'cancelled')
            ->update(['status' => 'cancelled']);

        if ($updated === 0) {
            return $this->actionResponse(
                $request,
                'Appointment is already cancelled.',
                $appointment->status,
                $appointment->id
            );
        }

        return $this->actionResponse(
            $request,
            'Appointment cancelled successfully.',
            'cancelled',
            $appointment->id
        );
    }

    public function destroy(Appointment $appointment, Request $request): RedirectResponse|JsonResponse
    {
        $appointmentId = $appointment->id;
        $appointment->delete();

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Appointment deleted successfully.',
                'appointment_id' => $appointmentId,
                'deleted' => true,
            ]);
        }

        return back()->with('success', 'Appointment deleted successfully.');
    }

    private function actionResponse(
        Request $request,
        string $message,
        string $status,
        int $appointmentId
    ): RedirectResponse|JsonResponse {
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'status' => $status,
                'appointment_id' => $appointmentId,
            ]);
        }

        return back()->with('success', $message);
    }
}
