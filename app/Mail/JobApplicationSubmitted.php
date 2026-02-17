<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public JobApplication $application)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job Application - ' . $this->application->position_title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job-application-submitted',
        );
    }

    public function attachments(): array
    {
        $files = array_filter([
            $this->application->resume_path,
            $this->application->id_ktp_path,
            $this->application->skck_path,
            $this->application->cover_letter_file_path,
            $this->application->portfolio_file_path,
        ]);

        $attachments = [];

        foreach ($files as $path) {
            $fullPath = storage_path('app/public/' . $path);
            if (!is_file($fullPath)) {
                continue;
            }

            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath($fullPath)
                ->as(basename($fullPath));
        }

        return $attachments;
    }
}
