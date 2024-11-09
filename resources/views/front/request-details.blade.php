@extends('front.master')

@section('content')
    <body class="inside-request">
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('الرئيسية')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('donation-requests') }}">@lang('طلبات التبرع')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('طلب التبرع'): {{ $donor->patient_name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="person">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('الإسم')</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donor->patient_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('فصيلة الدم')</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{ $donor->bloodType->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('العمر')</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donor->patient_age }} @lang('عام')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('عدد الأكياس المطلوبة')</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donor->bags }} @lang('أكياس')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('المشفى')</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donor->hospital_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>@lang('رقم الجوال')</p>
                                    </div>
                                    <div class="light">
                                        <p>{{ $donor->patient_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="inside">
                                <div class="info">
                                    <div class="special-dark dark">
                                        <p>@lang('عنوان المشفى')</p>
                                    </div>
                                    <div class="special-light light">
                                        <p>{{ $donor->hospital_address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="details-button">--}}
{{--                        <a href="#">@lang('التفاصيل')</a>--}}
{{--                    </div>--}}
                </div>
                <div class="text">
                    <p>
                        {{ $donor->details }}
                    </p>
                </div>
                <div class="location">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/view?key=AIzaSyAQe8JnWHjnPH7B4Y9e5fiAHZEdd9zI2rY&center={{ $donor->latitude }},{{ $donor->longitude }}&zoom=15"
                        height="400"
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                        aria-hidden="false"
                        tabindex="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@stop
