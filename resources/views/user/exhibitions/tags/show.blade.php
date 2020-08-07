@extends('layouts.app')

@section('title')
    <title>Tag: {{ $tag->name }} | {{ config('site.user.app.name') }}</title>
@endsection

@section('description')
    <meta content="last news" name="description">
@endsection

@section('content')
    <div class="intro news-bg intro-single route">
        <div class="intro-content-news  display-table">
            <div class="table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="equipment-title equipment-title-all mb-4">{{ $tag->name }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('main') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">News</li>
                            </ol>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="phone-none">
                                <a href="{{ route('main') }}"><img class="logo-equipment logo-news" src="{{ asset('assets/img/logo.png') }}" alt="{{ config('site.user.app.name') }} logo"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container all-news">
            @if($posts->isNotEmpty())
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-12 card-news">
                            <div class="row">
                                <div class="col-md-7 text-news">
                                    <span class="date-news">{{ $post->created_at->format('Y m d') }}</span>
                                    <span class="title-news">{{ $post->title }}</span>
                                    <div class="description-news _hidden">
                                        <div class="inner-text">
                                            <p>
                                                <span>
                                                    {{ $post->short_description }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.exhibitions.news.show', ['slug' => $post->slug]) }}" class="news-button">
                                        <span>Show More...</span>
                                    </a>
                                </div>
                                <div class="col-md-5 main-img-news">
                                    <img src="{{ $post->img }}" class="img-fluid" alt="{{ $post->title }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                {{ $posts->links('vendor.pagination.default') }}
            @else
                <div class="col-md-12 card-news text-center d-flex justify-content-center align-items-center" style="min-height: 300px">
                    <div class="row">
                        <div class="col-md-12 text-news m-0" style="font-size: 35px;">
                            <p class="align-self-center">Nothing found.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
