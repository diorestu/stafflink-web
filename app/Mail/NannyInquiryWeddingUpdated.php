<?php

namespace App\Mail;

use App\Models\NannyInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NannyInquiryWeddingUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  Collection<int, NannyInquiry>  $groupedInquiries
     */
    public function __construct(
        public NannyInquiry $inquiry,
        public Collection $groupedInquiries,
        public string $csvFilename,
        public string $csvContent,
        public int $totalChildren,
        public int $totalNannies,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Wedding Nanny Booking Updated - '.$this->inquiry->wedding_couple_names,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nanny-inquiry-wedding-updated',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->csvContent, $this->csvFilename)
                ->withMime('text/csv'),
        ];
    }
}
