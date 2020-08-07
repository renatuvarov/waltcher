@component('mail::message')
# Новый заказ

<b>Имя:</b> {{ $order->customer_name }}

<b>Email:</b> {{ $order->customer_email }}

<b>Телефон:</b> {{ $order->customer_phone ?: '---' }}

<b>Продукт:</b> {{ $machine->name }}

@endcomponent
