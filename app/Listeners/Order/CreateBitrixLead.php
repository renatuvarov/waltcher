<?php

namespace App\Listeners\Order;

use App\Events\Order\Accepted;
use GuzzleHttp\Client;

class CreateBitrixLead
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(Accepted $event)
    {
        $this->client->post(env('BITRIX_URL'), [
            'form_params' => [
                'fields' => [
                    'TITLE' => 'Заказ с sweetstech.com: ' . $event->order->machine->name,
                    'NAME' => $event->order->customer_name,
                    'LAST_NAME' => $event->order->customer_name,
                    'STATUS_ID' => 'NEW',
                    'OPENED' => 'Y',
                    'ASSIGNED_BY_ID' => env('BITRIX_ID'),
                    'COMPANY_TITLE' => $event->order->customer_company,
                    'PHONE' => [
                        [
                            'VALUE' => $event->order->customer_phone,
                            'VALUE_TYPE' => 'WORK',
                        ],
                    ],
                    'EMAIL' => [
                        [
                            'VALUE' => $event->order->customer_email,
                            'VALUE_TYPE' => 'WORK',
                        ],
                    ],
                ],
                'params' => ['REGISTER_SONET_EVENT' => 'Y'],
            ],
            'verify' => false,
        ]);
    }
}
