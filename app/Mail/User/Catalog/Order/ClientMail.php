<?php

namespace App\Mail\User\Catalog\Order;

use App\Entities\Catalog\Machine;
use App\Entities\Catalog\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {

        $mail = $this->markdown('emails.user.catalog.order.client')->with([
            'text' => $this->order->machine->mail,
            'name' => $this->order->customer_name,
        ])->subject('Waltcher');

        if (! empty($this->order->machine->pdf)) {
            $mail->attachFromStorageDisk('local', $this->order->machine->pdf);
        }

        return $mail;
    }
}
