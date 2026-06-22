<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

   public $registration;

public function __construct($registration)
{
    $this->registration = $registration;
}

public function build()
{
    return $this
        ->subject('Registration Successful')
        ->view('email.registration-success');
}
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Successful'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.registration-success'
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}