@extends('layouts.app')

@section('title')
    <title>All Posts | {{ config('site.user.app.name') }}</title>
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
                            <h1 class="equipment-title equipment-title-all mb-4">NEWS</h1>
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
                                <a class="card-news-square card-news-square-all" href="{{ route('user.blog.news.show', ['slug' => $post->slug]) }}">
                                    <img src="{{ $post->img }}" alt="{{ $post->title }}" class="img-fluid">
                                    <div class="card-news-square-2">
                                        <h3>{{ $post->title }}</h3>
                                        <div class="card-news-square-info">
                                            <div class="card-news-btn-wrapper">
                                                <div class="news-more text-uppercase">Show More</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-news-footer">
                                        <div class="card-news-category">{{ $post->category->name }}</div>
                                        <div class="card-news-date">{{ $post->created_at->format('Y-m-d') }}</div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                </div>
                {{ $posts->links('vendor.pagination.default') }}
            @else
                <div class="col-md-12 card-news-inside text-center d-flex justify-content-center align-items-center" style="min-height: 300px">
                    <div class="row">
                        <div class="col-md-12 text-news m-0" style="font-size: 35px;">
                            <p class="align-self-center">Nothing found.</p>
                        </div>
                    </div>
                </div>
            @endif
    </section>
@endsection
