@extends('adminlte::page')
{{--@inject('governorate', 'App\Models\Governorate')--}}
@section('content')
    <!-- Main content -->
{{--    @dd($governorate)--}}
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Governorate</h3>
            </div>
            <div class="box-body">
                {!! Html::form()->action(route('governorates.update', $governorate->id))->open() !!}
                @csrf
                @method('PUT')
                @include('flash::message')

                <div class="form-group">
                    {!! Html::label('name', 'Name of the governorate') !!}
                    {!! Html::text('name', $governorate->name)->class('form-control')->placeholder('Enter the name of the governorate') !!}

                    <!-- Display validation errors for the 'name' field -->
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {!! Html::submit('Update')->class('btn btn-primary') !!}
                {!! Html::form()->close() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
