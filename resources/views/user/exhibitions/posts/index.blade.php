@extends('layouts.waltcher')

@section('title')
    <title>All Exhibitions | {{ config('site.user.app.name') }}</title>
@endsection

@section('description')
    <meta content="last Exhibitions" name="description">
@endsection

@section('body')
    <div class="wrapper">
        <div class="content content-gradient-2">
            <div class="equipment">
                <div class="equipment-block">
                    <h1 class="text-center align-items-center">Exhibitions</h1>
                    <div class="container">
                        <div class="row">
                            @if($posts->isNotEmpty())
                                @foreach($posts as $post)
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ route('user.exhibitions.news.show', ['slug' => $post->slug]) }}">
                                            <div class="card">
                                                <div class="card-top">
                                                    <img src="{{ $post->img }}" alt="">
                                                </div>
                                                <div class="card-content">
                                                    <h3 class="title">{{ $post->title }}</h3>
                                                    <h6 class="tag">{{ $post->created_at->format('Y-m-d') }}</h6>
                                                    <div class="text-exhibitions">
                                                        {{ $post->short_description }}
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-exhibitions">Read more</button>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="intro news-bg intro-single route">
        <div class="intro-content-news  display-table">
            <div class="table-cell">
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <h1 class="equipment-title equipment-title-all mb-4">Exhibitions</h1>
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
            <div class="col-md-12 card-news">
                <div class="row">
            @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                    <a class="card-news-square card-news-square-all" href="{{ route('user.exhibitions.news.show', ['slug' => $post->slug]) }}">
                        <img src="{{ $post->img }}" alt="{{ $post->title }}" class="img-fluid">
                        <div class="card-news-square-2">
                            <h3>{{ $post->title }}</h3>
                            <div class="card-news-square-info">
                                <div class="card-news-btn-wrapper">
                                    <div class="news-more text-uppercase">Show More</div>
                                </div>
                            </div>
                            <div class="card-news-footer">
                                <div class="card-news-date">{{ $post->created_at->format('Y-m-d') }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
            </div>
                </div>
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
