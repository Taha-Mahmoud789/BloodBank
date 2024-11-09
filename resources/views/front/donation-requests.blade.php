@extends('front.master')
@section('content')
    <body class="donation-requests">
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('HomePage') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                    </ol>
                </nav>
            </div>

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
    @stop
    @push('scripts')
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
                        url: '{{ route("donation-requests") }}',
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
