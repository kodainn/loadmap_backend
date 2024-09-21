<?php

declare(strict_types=1);

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SendRegisterUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $token;

    /**
     * Create a new message instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: '仮登録完了のお知らせ - 本登録をお願いいたします',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $params = ['token' => $this->token];

        $now = Carbon::now();

        $url = URL::temporarySignedRoute(
            'register.store',
            $now->addHours(1),
            $params
        );

        return new Content(
            view: 'mail.register',
            with: [
                'appName' => config('mail.from.name'),
                'url' =>     $url
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
