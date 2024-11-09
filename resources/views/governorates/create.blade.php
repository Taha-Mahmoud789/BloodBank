@extends('adminlte::page')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add a new governorate</h3>
            </div>
            <div class="box-body">
                {!! Html::form()->action(route('governorates.store'))->method('POST')->open() !!}
                {!! Html::token() !!} <!-- CSRF Token -->

                @include('flash::message') <!-- Include flash messages for success or error -->

                <div class="form-group">
                    {!! Html::label('name', 'Name of the governorate') !!}
                    {!! Html::text('name')->class('form-control')->placeholder('Enter the name of the governorate') !!}

                    <!-- Display validation errors for the 'name' field -->
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {!! Html::submit('Add')->class('btn btn-primary') !!}
                {!! Html::form()->close() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
