<?php

namespace App\Events;

use App\Models\JobApplication;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicantStatusUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public JobApplication $application,
        public string $fromStatus,
        public string $toStatus,
    ) {
    }
}

