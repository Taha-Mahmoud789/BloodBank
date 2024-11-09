@extends('front.master')
@section('content')
    <body class="article-details">
    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('HomePage') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('articles') }}">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="article-image">
                <img src="{{ asset('storage/'. $article->thumbnail) }}" alt="{{ $article->title }}">
            </div>
            <div class="article-title col-12">
                <div class="h-text col-6">
                    <h4>{{ $article->title }}</h4>
                </div>
                <div class="icon col-6">
                    <button type="button"><i class="far fa-heart"></i></button>
                </div>
            </div>
            <!--text-->
            <div class="text">
                <p>
                    {{$article->content}}
                </p> <br>
            </div>
            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>مقالات ذات صلة</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="container">
                        <div class="row">
                            <!-- Set up your HTML -->
                            <div class="owl-carousel articles-carousel">
                                @foreach($posts as $article)
                                    <div class="card">
                                        <div class="photo">
                                            <img src="{{ asset('storage/' . $article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
                                            <a href="{{ route('article-details', ['id' => $article->id]) }}" class="click">المزيد</a> <!-- Update link -->
                                        </div>
                                        <a href="#" class="favourite">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $article->title }}</h5>
                                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
