<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ProductEnquiryMail extends Mailable
{
    public $enquiry;

    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Product Enquiry'
        );
    }

   public function content(): Content
{
    return new Content(
        view: 'email.product-enquiry'
    );
}

    public function attachments(): array
    {
        return [];
    }
}