@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
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
        <div class="row mt-5" style="min-height: 250px">
            <form action="{{ route('admin.home') }}" class="datepicker-form col-md-6">
                <div class="form-group">
                    <label for="machine_id">Наименование оборудования: </label>
                    <select class="form-control" id="machine_id" name="machine_id">
                        <option value="" selected>---</option>
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="start_date" class="datepicker form-control w-25 d-inline" placeholder="C:">
                <input type="text" name="end_date" class="datepicker form-control w-25 d-inline" placeholder="По:">
                <button type="submit" class="btn btn-info">Посчитать</button>
            </form>
            <div class="col-md-6 text-center">
                <div class="card border-dark">
                    <div class="card-header" style="color:#fff; background-color:#00719d;">{{ $selectedMachine ?? 'Все оборудование' }}</div>
                    <div class="d-flex justify-content-around" style="font-size: 25px">
                        <div>С: {{ $startDate->format('d.m.Y') }}</div>
                        <div>По: {{ $endDate->format('d.m.Y') }}</div>
                    </div>
                    <div class="card-body text-dark" style="font-size: 85px;">{{ $count ?? $ordersCount }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script>
        xCal.all('datepicker', {
            lang: 'ru'
        });
    </script>
@endpush
