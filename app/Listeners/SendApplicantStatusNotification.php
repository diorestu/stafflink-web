<?php

namespace App\Listeners;

use App\Events\ApplicantStatusUpdated;
use App\Mail\ApplicantStatusNotification;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendApplicantStatusNotification
{
    public function handle(ApplicantStatusUpdated $event): void
    {
        if (!in_array($event->toStatus, ['hired', 'onboard'], true)) {
            return;
        }

        $email = trim((string) $event->application->email);
        if ($email === '') {
            return;
        }

        try {
            Mail::to($email)->send(
                new ApplicantStatusNotification($event->application, $event->toStatus)
            );
        } catch (Throwable $e) {
            report($e);
        }
    }
}

