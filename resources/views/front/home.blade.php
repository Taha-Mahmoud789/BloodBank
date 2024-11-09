@extends('front.master')
@section('content')
    <!--intro-->
    <body class="donation-requests">
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي للنص.
                            </p>
                            <a href="#">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي للنص.
                            </p>
                            <a href="#">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي.
                            </p>
                            <a href="#">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>بنك الدم</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
                    التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة
                    لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.
                </p>
            </div>
        </div>
    </div>
    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>المقالات</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <div class="owl-carousel articles-carousel">
                        @foreach($posts as $article)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
                                    <a href="{{ route('article-details', ['id' => $article->id]) }}" class="click">المزيد</a>
                                </div>
                                <!-- Favorite Icon -->
                                <a class="favourite" onclick="toggleFavourite(this)">
                                    <i id="{{ $article->id }}" class="{{ $article->is_favourite ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                    <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                </div>
                                <small class="text-body-secondary">{{ $article->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Request Donation  section  -->
    <div class="all-requests">
        <div class="container">
            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>طلبات التبرع</h2>
                </div>
                <div class="content">
                    <form class="row filter" id="filterForm">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="blood_type_id" class="form-control" id="bloodTypeSelect">
                                        <option selected disabled>اختر فصيلة الدم</option>
                                        @foreach($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select name="city_id" class="form-control" id="citySelect">
                                        <option selected disabled>اختر المدينة</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div id="donationRequestsList">
                        @include('front.partials.donation-requests-list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- call us section  -->
    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>اتصل بنا</h3>
                </div>
                <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{asset('front/imgs/whats.png')}}" alt="">
                        <p dir="ltr">{{$settings->phone}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- mobile app   -->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>تطبيق بنك الدم</h3>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                    </p>
                    <div class="download">
                        <h4>متوفر على</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('front/imgs/google.png')}}" alt="">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('front/imgs/ios.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{asset('front/imgs/App.png')}}" alt="">
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
        <script>
            $(document).ready(function () {
                // Handle pagination links
                $(document).on('click', '.pagination a', function (e) {
                    e.preventDefault();

                    // Get the page number from the link URL
                    const page = $(this).attr('href').split('page=')[1];

                    // Load the specific page
                    fetchDonationRequests(page);
                });

                function fetchDonationRequests(page) {
                    $.ajax({
                        url: '?page=' + page,
                        type: 'GET',
                        success: function (response) {
                            $('#donationRequestsList').html(response.html); // Update the content
                        },
                        error: function (xhr) {
                            console.log("An error occurred:", xhr.statusText);
                        }
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                // Handle form submission with AJAX
                $('#filterForm').on('submit', function (e) {
                    e.preventDefault();

                    // Get the selected filter values
                    const bloodTypeId = $('#bloodTypeSelect').val();
                    const cityId = $('#citySelect').val();

                    // Send an AJAX request with the selected filters
                    $.ajax({
                        url: '{{ route("HomePage") }}',
                        type: 'GET',
                        data: {
                            blood_type_id: bloodTypeId,
                            city_id: cityId
                        },
                        success: function (response) {
                            // Update the donation requests list with the filtered data
                            $('#donationRequestsList').html(response.html);
                        },
                        error: function (xhr) {
                            console.error("An error occurred:", xhr.statusText);
                        }
                    });
                });
            });
        </script>
    @endpush
@stop
