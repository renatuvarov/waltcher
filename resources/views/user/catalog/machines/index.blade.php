@extends('layouts.waltcher')

@section('title')
    <title>Equipment</title>
@endsection

@section('body')
    <div class="wrapper">
        <div class="content content-gradient">
            <div class="equipment">
                <div class="equipment-block">
                    <h1 class="text-center align-items-center">Equipment</h1>
                    <div class="container-fluid d-flex justify-content-center">
                        <div id="grid" class="col-md-7 align-items-center">
                            @if($machines->isNotEmpty())
                                @foreach($machines as $machine)
                                    <div class="equipment-card">
                                        <div class="row row-equipment">
                                            <div class="col-md-8 equipment-text">
                                                <h3>{{ $machine->name }}</h3>
                                                <div itemprop="description" class="text-desc">
                                                    {{ $machine->short_description }}
                                                </div>
                                                <a href="{{ route('user.catalog.show', ['machine' => $machine->slug]) }}" class="btn-equipment"><span>More</span></a>
                                            </div>
                                            <div class="col-md-4 equipment-img">
                                                <img src="{{ $machine->img }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
