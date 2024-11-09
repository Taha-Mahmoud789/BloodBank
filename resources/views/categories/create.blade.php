@extends('adminlte::page')

@section('title', 'Add a New category')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add a New category</h3>
            </div>
            <div class="box-body">
                {{-- Use Spatie HTML for form generation --}}
                {!! html()->form()->action(route('categories.store'))->method('POST')->open() !!}
                {!! html()->token() !!} <!-- CSRF Token -->

                @include('flash::message') <!-- Include flash messages for success or error -->

                {{-- category Name Input --}}
                <div class="form-group">
                    {!! html()->text('name')
                        ->class('form-control')
                        ->placeholder('Enter the name of the category') !!}

                    <!-- Display validation errors for the 'name' field -->
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                {!! html()->submit('Add')
                    ->class('btn btn-primary') !!}
                {!! html()->form()->close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
