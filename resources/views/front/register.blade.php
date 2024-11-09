@extends('front.master')
@section('content')
    <body class="create">

    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('HomePage') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                {!! html()->form('POST', route('clientRegister'))->class('needs-validation')->open() !!}

                {!! html()->text('name')->class('form-control')->placeholder('الإسم')->required() !!}
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->email('email')->class('form-control')->placeholder('البريد الإلكترونى')->required() !!}
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->text('d_o_b')->class('form-control')->placeholder('تاريخ الميلاد')->attributes(['onfocus' => "(this.type='date')"])->required() !!}
                @error('d_o_b')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                @inject('bloodTypes', 'App\Models\BloodType')
                {!! html()->select('blood_type_id', $bloodTypes->pluck('name', 'id')->toArray())
                    ->class('form-control')
                    ->id('blood_types')
                    ->placeholder('فصيلة الدم')
                    ->required() !!}
                @error('blood_type_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                @inject('governorates', 'App\Models\Governorate')
                {!! html()->select('governorate', $governorates->pluck('name', 'id')->toArray())
                  ->class('form-control')
                  ->id('governorates')
                  ->placeholder('المحافظة') !!}
                @error('governorate')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->select('city_id', [])
                  ->class('form-control')
                  ->id('cities')
                  ->placeholder('المدينة') !!}
                @error('city_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->text('phone')->class('form-control')->placeholder('رقم الهاتف')->required() !!}
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->password('password')->class('form-control')->placeholder('كلمة المرور')->required() !!}
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                {!! html()->password('password_confirmation')->class('form-control')->placeholder('تأكيد كلمة المرور')->required() !!}
                @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="create-btn">
                    {!! html()->submit('إنشاء')->class('btn btn-create') !!}
                </div>

                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#governorates").change(function (e) {
                    e.preventDefault();
                    // Get governorate ID
                    const governorate_id = $(this).val(); // Use 'this' to reference the changed element
                    if (governorate_id) {
                        $.ajax({
                            url: "{{ url('/api/cities') }}?governorate_id=" + governorate_id, // Correctly generate the URL
                            type: 'GET',
                            success: function (data) {
                                // Check if the message indicates success and if cities data exists
                                if (data.message === "success" && data.data && data.data.data.length > 0) {
                                    $("#cities").empty(); // Clear previous options
                                    $("#cities").append('<option value="">اختر مدينة</option>'); // Default option
                                    $.each(data.data.data, function (index, city) {
                                        // Append city options to the dropdown
                                        $("#cities").append('<option value="' + city.id + '">' + city.name + '</option>');
                                    });
                                } else {
                                    // Handle case when there are no cities found
                                    $("#cities").empty().append('<option value="">لا توجد مدن</option>');
                                }
                            },
                            error: function (jqXhr, textStatus, errorMessage) {
                                alert("خطأ: " + errorMessage);
                            }
                        });
                    } else {
                        $("#cities").empty().append('<option value="">اختر مدينة</option>');
                    }
                });
            });
        </script>
    @endpush
@stop
