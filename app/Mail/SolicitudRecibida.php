<?php

namespace App\Mail;

use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudRecibida extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Solicitud $solicitud)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva solicitud de reservación — '.$this->solicitud->nombre,
            // Permite responderle directo al visitante desde el correo
            replyTo: [new Address($this->solicitud->email, $this->solicitud->nombre)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.solicitud',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
