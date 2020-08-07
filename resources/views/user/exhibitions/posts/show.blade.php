@extends('layouts.waltcher')

@section('title')
    <title>{{ $post->title . ' | ' . env('APP_NAME') }}</title>
@endsection

@section('description')
    <meta content="{{ $post->short_description ?? $post->title }}" name="description">
@endsection

@section('body')
    <div class="wrapper">
        <div class="content content-gradient-2">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="exhibitions-blog">
                        <div class="exhibitions-title">
                            <h1>{{ $post->title }}</h1>
                        </div>
                        <div class="exhibitions-text">
                            <img class="exhibitions-img" src="{{ $post->img }}" alt="">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/js-content.js') }}"></script>
@endpush
