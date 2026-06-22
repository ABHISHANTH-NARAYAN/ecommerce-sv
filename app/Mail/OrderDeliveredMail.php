<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderDeliveredMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Your Order Has Been Delivered')
            ->view('email.order-delivered');
    }
}