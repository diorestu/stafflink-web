<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Throwable;

class MailTestService
{
    public function send(?string $to = null): array
    {
        $recipient = trim((string) ($to ?: config('mail.notifications.appointments', config('mail.from.address'))));

        if ($recipient === '') {
            return [
                'ok' => false,
                'message' => 'Recipient email is empty. Set APPOINTMENT_NOTIFICATION_TO or MAIL_FROM_ADDRESS.',
                'recipient' => '',
            ];
        }

        $subject = 'Stafflink SMTP Test - ' . now()->format('Y-m-d H:i:s');
        $body = implode("\n", [
            'This is a test email from Stafflink.',
            'Time: ' . now()->toDateTimeString(),
            'App URL: ' . (string) config('app.url'),
            'Mailer: ' . (string) config('mail.default'),
            'SMTP Host: ' . (string) config('mail.mailers.smtp.host'),
            'SMTP Port: ' . (string) config('mail.mailers.smtp.port'),
            'SMTP Scheme: ' . (string) config('mail.mailers.smtp.scheme'),
        ]);

        try {
            Mail::raw($body, function ($message) use ($recipient, $subject): void {
                $message->to($recipient)->subject($subject);
            });

            return [
                'ok' => true,
                'message' => "Test email sent to {$recipient}.",
                'recipient' => $recipient,
            ];
        } catch (Throwable $e) {
            report($e);

            return [
                'ok' => false,
                'message' => $e->getMessage(),
                'recipient' => $recipient,
            ];
        }
    }
}
