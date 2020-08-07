<?php

namespace App\Listeners\Order;

use App\Events\Order\Accepted;
use App\Mail\User\Catalog\Order\AdminMail;
use App\Mail\User\Catalog\Order\ClientMail;
use Illuminate\Contracts\Mail\Mailer;

class SendNotifications
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(Accepted $event)
    {
        $this->mailer->to($event->order->customer_email)->send(new ClientMail($event->order));
        $this->mailer->to(env('ADMIN_EMAIL'))->send(new AdminMail($event->order));
    }
}
