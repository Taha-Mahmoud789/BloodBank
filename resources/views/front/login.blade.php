@extends('front.master')
@section('content')
    <body class="create">
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('HomePage') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                <h2 class="text-center mb-4">تسجيل الدخول</h2> <!-- Add a heading -->
                {!! html()->form('POST', route('clientLogin'))->class('needs-validation')->open() !!}

                <div class="form-group">
                    {!! html()->email('email')
                        ->class('form-control')
                        ->placeholder('البريد الإلكترونى')
                        ->required() !!}
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! html()->password('password')
                        ->class('form-control')
                        ->placeholder('كلمة المرور')
                        ->required() !!}
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <div class="custom-control custom-checkbox">--}}
{{--                        <input type="checkbox" class="custom-control-input" id="rememberMe">--}}
{{--                        <label class="custom-control-label" for="rememberMe">تذكرني</label>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="create-btn text-center">
                    {!! html()->submit('تسجيل الدخول')->class('btn btn-create btn-block') !!} <!-- Make the button full-width -->
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>
    </body>
@stop
