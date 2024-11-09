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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('myFavourites') }}">المفضله</a></li>
                    </ol>
                </nav>
            </div>
            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>مفضلاتي</h2>
                    </div>
                </div>
                <div class="album py-5 bg-body-tertiary">
                    <div class="container" style="padding: 20px;">
                        @foreach($posts->chunk(3) as $chunk)
                            <div class="row g-3">
                                @foreach($chunk as $article)
                                    <div class="col-md-4">
                                        <div class="card shadow-sm" style="margin-bottom: 20px; border-radius: 8px;">
                                            <div class="photo">
                                                <img src="{{ asset('storage/' . $article->thumbnail) }}" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="{{ $article->title }}">
                                                <!-- Favorite Icon -->
                                                <a class="favourite" onclick="toggleFavourite(this)">
                                                    <i id="{{ $article->id }}" class="{{ $article->is_favourite ? 'fa-solid fa-heart ' : 'fa-regular fa-heart' }}"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                                <small class="text-body-secondary">{{ $article->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function toggleFavourite(heart) {
                var post_id = heart.querySelector('i').id; // Get the post ID from the icon's ID
                $.ajax({
                    url: '{{ route('post-favourite') }}', // Ensure this route is correct
                    type: 'POST', // Make sure this is set to POST
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token for security
                        post_id: post_id // Post ID to toggle
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            // Toggle the heart icon class
                            $(heart).find('i').toggleClass('fa-regular fa-heart  fa-solid fa-heart');
                        }
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        console.error('Error:', errorMessage); // Log error to console
                        alert('An error occurred: ' + errorMessage); // Alert user
                    }
                });
            }
        </script>
    @endpush
@stop
