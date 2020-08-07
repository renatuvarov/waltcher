@component('mail::message')
# Новое сообщение с сайта

<b>Имя:</b> {{ $data['st_nsp'] }}<br>
<b>Компания:</b> {{ $data['st_company'] ?? '-' }}<br>
<b>Телефон:</b> {{ $data['st_phone'] ?? '-' }}<br>
<b>E-mail:</b> {{ $data['st_email'] }}<br>
<b>Сообщение:</b> {{ $data['st_message'] }}<br>

@endcomponent
