<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $title,$description;
    public function __construct($title,$description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Created',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.ticket-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
