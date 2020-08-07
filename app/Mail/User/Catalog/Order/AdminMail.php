<?php

namespace App\Mail\User\Catalog\Order;

use App\Entities\Catalog\Machine;
use App\Entities\Catalog\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.catalog.order.admin')->with([
            'order' => $this->order,
            'machine' => $this->order->machine,
        ])->subject($this->order->machine->name);
    }
}
