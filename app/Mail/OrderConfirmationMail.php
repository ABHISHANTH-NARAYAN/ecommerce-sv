<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cart;

    public function __construct($order, $cart)
    {
        $this->order = $order;
        $this->cart = $cart;
    }

    public function build()
    {
        // Generates the SV-00042 style invoice number
        $invoiceNumber = 'SV-' . str_pad($this->order->id, 5, '0', STR_PAD_LEFT);

        return $this->subject('Your SV Distribution Invoice #' . $invoiceNumber)
                    ->view('email.invoice')
                    ->with([
                        'invoiceNumber' => $invoiceNumber
                    ]);
    }
}