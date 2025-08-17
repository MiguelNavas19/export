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

      // Definir las direcciones de correo electrónico en variables para mayor claridad
        $fromAddress = new Address('operaciones@exportar.salvadordelaplaza.com', 'Machado & Guedez');
        $ccAddresses = [
            new Address('operaciones@machadoyguedez.com', 'Operaciones')
        ];
        
        // Crear el asunto del correo
        $subject = sprintf('Solicitud de estatus de liberación y días libres del BL %s', $this->bl);
        // Retornar un nuevo Envelope
        return new Envelope(
            from: $fromAddress,
            subject: $subject,
            cc: $ccAddresses
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
