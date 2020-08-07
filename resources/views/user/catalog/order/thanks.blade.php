@extends('layouts.waltcher')

@section('title')
    <title>Thanks!</title>
@endsection

@section('description')
    <meta name="description" content="Thanks!">
@endsection

@section('body')
    <div class="order-form_success">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/img/logo.webp') }}" class="w-25 mt-5" alt="">
        </div>
        <div class="order-form">
            <h3 class="order-form_title">
                <span class="equipment-title order-form_title-text">Success!</span>
            </h3>
            <div class="order-form_body text-center">
                <p>Thanks! Your application has been sent successfully! Expect feedback on the provided contact
                    details.</p>
                <p class="text-center">
                    <a href="{{ route('user.catalog.index') }}" type="button" class="form_btn btn-red">Ok</a>
                </p>
            </div>
        </div>
    </div>
@endsection
