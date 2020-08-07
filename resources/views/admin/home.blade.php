@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="display-4 text-center mb-5">{{ \Illuminate\Support\Facades\Auth::user()->email }}</h1>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="card border-dark">
                    <div class="card-header display-3" style="color:#fff; background-color: #343a40;">Всего заказов</div>
                    <div class="card-body text-dark" style="font-size: 85px;">{{ $ordersCount }}</div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="card border-dark">
                    <div class="card-header display-3" style="color:#fff; background-color:#009d00;">Новых заказов</div>
                    <div class="card-body text-dark" style="font-size: 85px;">{{ $activeOrdersCount }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
