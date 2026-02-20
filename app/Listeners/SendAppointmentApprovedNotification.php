<?php

namespace App\Listeners;

use App\Events\AppointmentApproved;
use App\Mail\AppointmentApprovedNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendAppointmentApprovedNotification
{
    private const FALLBACK_CACHE_KEY = 'mail:appointment_approved_failures';

    private const FALLBACK_LIMIT = 100;

    public function handle(AppointmentApproved $event): void
    {
        $email = trim((string) $event->appointment->email);
        if ($email === '') {
            return;
        }

        try {
            Mail::to($email)->send(new AppointmentApprovedNotification($event->appointment));

            Log::info('Appointment approved email notification sent.', [
                'appointment_id' => $event->appointment->id,
                'email' => $email,
            ]);
        } catch (Throwable $e) {
            report($e);

            Log::error('Failed to send appointment approved email notification.', [
                'appointment_id' => $event->appointment->id,
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            $this->pushFallbackRecord($event, $e);
        }
    }

    private function pushFallbackRecord(AppointmentApproved $event, Throwable $e): void
    {
        $failures = Cache::get(self::FALLBACK_CACHE_KEY, []);
        if (!is_array($failures)) {
            $failures = [];
        }

        $failures[] = [
            'appointment_id' => $event->appointment->id,
            'email' => $event->appointment->email,
            'error' => $e->getMessage(),
            'failed_at' => now()->toIso8601String(),
        ];

        if (count($failures) > self::FALLBACK_LIMIT) {
            $failures = array_slice($failures, -self::FALLBACK_LIMIT);
        }

        Cache::put(self::FALLBACK_CACHE_KEY, $failures, now()->addDays(14));
    }
}
