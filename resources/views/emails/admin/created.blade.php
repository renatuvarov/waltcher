@component('mail::message')
# Данные пользователя {{ env('APP_URL') }}
<br>
<b>Логин: </b>{{ $login }}<br>
<b>Пароль: </b>{{ $email }}<br>
<b>Роль: </b>{{ $role }}<br>
<br><br>
@component('mail::button', ['url' => route('admin.home')])
    => На главную =>
@endcomponent

@endcomponent
