@extends('adminlte::page')
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
            </div>
            <div class="box-body">
                {!! Html::form()->action(route('categories.update', $model->id))->open() !!}
                @csrf
                @method('PUT')
                @include('flash::message')

                <div class="form-group">
                    {!! Html::label('name', 'Name of the category') !!}
                    {!! Html::text('name', $model->name)->class('form-control')->placeholder('Enter the name of the category') !!}

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
