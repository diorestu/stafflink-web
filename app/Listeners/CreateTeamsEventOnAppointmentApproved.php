<?php

namespace App\Listeners;

use App\Events\AppointmentApproved;
use App\Services\MicrosoftGraphService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateTeamsEventOnAppointmentApproved
{
    private const FALLBACK_CACHE_KEY = 'microsoft_graph:appointment_failures';

    private const FALLBACK_LIMIT = 100;

    public function __construct(private MicrosoftGraphService $graphService)
    {
    }

    public function handle(AppointmentApproved $event): void
    {
        if (!$this->graphService->isEnabled()) {
            Log::info('Microsoft Graph sync skipped because integration is disabled.', [
                'appointment_id' => $event->appointment->id,
            ]);

            return;
        }

        try {
            $result = $this->graphService->createTeamsEventForAppointment($event->appointment);

            Log::info('Microsoft Teams event created for approved appointment.', [
                'appointment_id' => $event->appointment->id,
                'teams_event_id' => $result['event_id'] ?? null,
                'teams_join_url' => $result['join_url'] ?? null,
            ]);
        } catch (Throwable $e) {
            report($e);

            Log::error('Failed to create Microsoft Teams event for approved appointment.', [
                'appointment_id' => $event->appointment->id,
                'appointment_email' => $event->appointment->email,
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
            'starts_at' => $event->appointment->starts_at?->toIso8601String(),
            'ends_at' => $event->appointment->ends_at?->toIso8601String(),
            'error' => $e->getMessage(),
            'failed_at' => now()->toIso8601String(),
        ];

        if (count($failures) > self::FALLBACK_LIMIT) {
            $failures = array_slice($failures, -self::FALLBACK_LIMIT);
        }

        Cache::put(self::FALLBACK_CACHE_KEY, $failures, now()->addDays(14));
    }
}

