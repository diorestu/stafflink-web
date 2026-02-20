<?php

namespace App\Services;

use App\Models\Appointment;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class MicrosoftGraphService
{
    public function isEnabled(): bool
    {
        return (bool) config('services.microsoft_graph.enabled', false);
    }

    public function createTeamsEventForAppointment(Appointment $appointment): array
    {
        if (!$this->isEnabled()) {
            throw new RuntimeException('Microsoft Graph integration is disabled.');
        }

        $tenantId = trim((string) config('services.microsoft_graph.tenant_id'));
        $clientId = trim((string) config('services.microsoft_graph.client_id'));
        $clientSecret = trim((string) config('services.microsoft_graph.client_secret'));
        $calendarUserId = trim((string) config('services.microsoft_graph.user_id'));
        $timeZone = trim((string) config('services.microsoft_graph.timezone', 'Asia/Makassar'));

        if ($tenantId === '' || $clientId === '' || $clientSecret === '' || $calendarUserId === '') {
            throw new RuntimeException('Microsoft Graph credentials are incomplete.');
        }

        $token = $this->fetchAccessToken($tenantId, $clientId, $clientSecret);

        $start = $appointment->starts_at?->copy()->timezone($timeZone);
        $end = $appointment->ends_at?->copy()->timezone($timeZone);

        if (!$start || !$end) {
            throw new RuntimeException('Appointment start/end time is missing.');
        }

        $payload = [
            'subject' => 'Consultation with ' . $appointment->name,
            'body' => [
                'contentType' => 'HTML',
                'content' => sprintf(
                    '<p>Consultation appointment approved.</p><p><strong>Name:</strong> %s<br><strong>Email:</strong> %s<br><strong>Phone:</strong> %s</p>',
                    e($appointment->name),
                    e($appointment->email),
                    e($appointment->phone)
                ),
            ],
            'start' => [
                'dateTime' => $start->format('Y-m-d\TH:i:s'),
                'timeZone' => $timeZone,
            ],
            'end' => [
                'dateTime' => $end->format('Y-m-d\TH:i:s'),
                'timeZone' => $timeZone,
            ],
            'attendees' => [
                [
                    'emailAddress' => [
                        'address' => $appointment->email,
                        'name' => $appointment->name,
                    ],
                    'type' => 'required',
                ],
            ],
            'isOnlineMeeting' => true,
            'onlineMeetingProvider' => 'teamsForBusiness',
            'allowNewTimeProposals' => true,
            'transactionId' => sprintf('appointment-%d-%s', $appointment->id, $appointment->updated_at?->timestamp ?? time()),
        ];

        $response = Http::retry(
            3,
            1000,
            function (Throwable $exception): bool {
                if ($exception instanceof ConnectionException) {
                    return true;
                }

                if ($exception instanceof RequestException) {
                    $status = $exception->response?->status() ?? 0;

                    return $status === 429 || $status >= 500;
                }

                return false;
            }
        )
            ->withToken($token)
            ->acceptJson()
            ->post("https://graph.microsoft.com/v1.0/users/{$calendarUserId}/events", $payload);

        if ($response->failed()) {
            throw new RuntimeException(
                'Microsoft Graph event creation failed with status ' . $response->status() . ': ' . $response->body()
            );
        }

        $json = $response->json();

        return [
            'event_id' => $json['id'] ?? null,
            'join_url' => $json['onlineMeeting']['joinUrl'] ?? null,
            'web_link' => $json['webLink'] ?? null,
        ];
    }

    private function fetchAccessToken(string $tenantId, string $clientId, string $clientSecret): string
    {
        $response = Http::asForm()
            ->retry(3, 800, function (Throwable $exception): bool {
                if ($exception instanceof ConnectionException) {
                    return true;
                }

                if ($exception instanceof RequestException) {
                    $status = $exception->response?->status() ?? 0;

                    return $status === 429 || $status >= 500;
                }

                return false;
            })
            ->post("https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token", [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => 'https://graph.microsoft.com/.default',
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                'Microsoft Graph token request failed with status ' . $response->status() . ': ' . $response->body()
            );
        }

        $accessToken = (string) ($response->json('access_token') ?? '');
        if ($accessToken === '') {
            throw new RuntimeException('Microsoft Graph access token is empty.');
        }

        return $accessToken;
    }
}

