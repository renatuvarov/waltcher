<?php

namespace App\UseCases\Catalog;

use App\Dto\Catalog\Orders\Dto;
use App\Entities\Catalog\Order;
use App\Events\Order\Accepted;
use App\Repositories\MachineRepository;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Events\Dispatcher;

class CreateOrder
{
    /**
     * @var OrderRepository
     */
    private $orders;
    /**
     * @var MachineRepository
     */
    private $machines;
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    public function __construct(OrderRepository $orderRepository, MachineRepository $machineRepository, Dispatcher $dispatcher)
    {
        $this->orders = $orderRepository;
        $this->machines = $machineRepository;
        $this->dispatcher = $dispatcher;
    }

    public function action(Dto $dto)
    {
        /** @var Order $order */
        $order = Order::query()->make([
            'customer_name' => $dto->getName(),
            'customer_company' => $dto->getCompany(),
            'customer_email' => $dto->getEmail(),
            'customer_phone' => $dto->getPhone(),
        ]);

        $order->machine()->associate($this->machines->findById($dto->getMachineId()));

        $previousOrder = $this->orders->findEqual($order);

        if ( is_null($previousOrder) || $previousOrder->isExpired()) {
            $order->save();
            $this->dispatcher->dispatch(new Accepted($order));
        }

        return $order;
    }
}
