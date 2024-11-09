@extends('adminlte::page')
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add City</h3>
            </div>
            <div class="box-body">
                {!! Html::form()->action(route('cities.store'))->method('POST')->open() !!}
                {!! Html::token() !!} <!-- CSRF Token -->

                @include('flash::message') <!-- Include flash messages for success or error -->
                    <div class="form-group">
                        <label for="name">City Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter city name" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="governorate_id">Governorate</label>
                        <select name="governorate_id" class="form-control" required>
                            <option value="">Select Governorate</option>
                            @foreach($governorates as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                {!! Html::submit('Add')->class('btn btn-primary') !!}
                {!! Html::form()->close() !!}
            </div>
        </div>
    </section>
@endsection
