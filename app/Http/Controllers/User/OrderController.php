<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Catalog\OrderRequest;
use App\UseCases\Catalog\CreateOrder;

class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateOrder $createOrder)
    {
        $order = $createOrder->action($request->getDto());
        return redirect()->route('user.order.thanks', ['slug' => $order->machine->slug]);
    }

    public function thanks()
    {
        return view('user.catalog.order.thanks');
    }
}
