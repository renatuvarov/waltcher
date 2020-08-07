@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Подтверждение E-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Ссылка для подтверждения E-mail была отправлена на указанный адрес
                        </div>
                    @endif

                    Для продолжения необходимо пройти по ссылке в письме
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Отправить письмо еще раз</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
