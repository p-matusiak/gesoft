<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequest $contactRequest,
        public string $reply
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Odpowiedź na Twoje zapytanie — GESOFT',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.client-reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
