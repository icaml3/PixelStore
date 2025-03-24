<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CustomVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;

    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác Thực Email Của Bạn - PixelStore',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.verify-email',
            with: [
                'user' => $this->user,
                'url' => $this->url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
