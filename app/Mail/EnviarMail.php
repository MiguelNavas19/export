<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bl;

    public function __construct($bl)
    {
        $this->bl = $bl;
    }

    public function envelope(): Envelope
    {

        return new Envelope(
            from: new Address('operaciones@machadoyguedez.com', 'Machado & Guedez'),
            subject: 'Solicitud de estatus de liberación y dias libres del BL '.$this->bl,
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.emailbl',
            with: [
                'bl' => $this->bl,
            ],
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
