<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;

class NotificarSuscriptor extends Mailable
{
    use SerializesModels;

    public readonly string $tituloEntrada;
    public readonly string $slugEntrada;
    public readonly string $bajadaEntrada;

    /**
     * Create a new message instance.
     */
    public function __construct($titulo, $slug, $bajada)
    {
        $this->tituloEntrada = $titulo;
        $this->slugEntrada = $slug;
        $this->bajadaEntrada = $bajada;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'He Publicado Una Nueva Entrada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.suscripcion.notificar', text: 'email.suscripcion.notificar-plano'
        );
    }

    public function headers(): Headers{
        return new Headers(
            text: [
                'List-Unsuscribe' => '<mailto:desuscribir@lohumanoquemequeda.blog>, <https://lohumanoquemequeda.blog/desuscribir>',
                'List-Unsuscribe-Post' => 'List-Unsubscribe=One-Click'
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
