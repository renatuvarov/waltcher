<?php

namespace App\Repositories;

use App\Entities\Catalog\Order;

class OrderRepository
{
    public function findEqual(Order $order): ?Order
    {
        return Order::where('machine_id', $order->machine_id)
            ->where('customer_email', $order->customer_email)
            ->where('viewed', false)
            ->orderByDesc('created_at')
            ->first();
    }
}
