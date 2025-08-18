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
    public $puerto;

    public function __construct($bl, $puerto)
    {
        $this->bl = $bl;
        $this->puerto = $puerto;
    }

    public function envelope(): Envelope
    {


        if ($this->puerto == 1) {
            $correo = "mglaguaira@exportar.salvadordelaplaza.com";
            $correocopia = "mglaguaira@mgasociadosve.com";
        } else {
            $correo = "mgguanta@exportar.salvadordelaplaza.com";
            $correocopia = "mgguanta@mgasociadosve.com";
        }

        // Definir las direcciones de correo electrónico en variables para mayor claridad
        $fromAddress = new Address($correo, 'MG Asociados');
        $ccAddresses = [
            new Address($correocopia, 'Operaciones')
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
