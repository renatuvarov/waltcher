<?php

namespace App\Events\Order;

use App\Entities\Catalog\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Accepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Order
     */
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
