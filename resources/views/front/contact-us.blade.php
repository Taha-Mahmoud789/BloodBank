@extends('front.master')
@section('content')
    <body class="contact-us">
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('HomePage') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{ asset('front/imgs/logo.png') }}"  alt="">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>الجوال:</span> {{$settings->phone}}</li>
                                    <li><span>البريد الإلكترونى:</span> {{$settings->email}}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="#"><img src="{{ asset('front/imgs/001-facebook.svg') }}" alt=""></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src="{{ asset('front/imgs/002-twitter.svg') }}"  alt=""></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src="{{ asset('front/imgs/003-youtube.svg') }}"  alt=""></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src="{{ asset('front/imgs/004-instagram.svg') }}"  alt=""></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src="{{ asset('front/imgs/005-whatsapp.svg') }}" alt=""></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            {!! html()->form('POST', route('contact.store'))->class('needs-validation')->open() !!}

                            {!! html()->text('name')
                                ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                                ->placeholder('الإسم')
                                ->required() !!}
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {!! html()->email('email')
                                ->class('form-control' . ($errors->has('email') ? ' is-invalid' : ''))
                                ->placeholder('البريد الإلكترونى')
                                ->required() !!}
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {!! html()->text('phone')
                                ->class('form-control' . ($errors->has('phone') ? ' is-invalid' : ''))
                                ->placeholder('رقم الهاتف')
                                ->required() !!}
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {!! html()->text('subject')
                                ->class('form-control' . ($errors->has('subject') ? ' is-invalid' : ''))
                                ->placeholder('عنوان الرسالة')
                                ->required() !!}
                            @error('subject')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {!! html()->textarea('message', null)
                                ->class('form-control' . ($errors->has('message') ? ' is-invalid' : ''))
                                ->placeholder('نص الرسالة')
                                ->rows(3)
                                ->required() !!}
                            @error('message')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="create-btn">
                                {!! html()->submit('ارسال')->class('btn btn-create') !!}
                            </div>

                            {!! html()->form()->close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
