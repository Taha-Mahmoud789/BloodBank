@extends('adminlte::page')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add New Post</h3>
            </div>
            <div class="box-body">
                {!! Html::form()->action(route('posts.store'))->method('POST')->attribute('enctype', 'multipart/form-data')->open() !!}
                {!! Html::token() !!} <!-- CSRF Token -->

                @include('flash::message') <!-- Include flash messages for success or error -->

                <div class="form-group">
                    {!! Html::label('Title', 'العنوان') !!}
                    {!! Html::text('title')->class('form-control')->placeholder('Enter Title')->value(old('title')) !!}
                    <!-- Display validation errors for the 'title' field inline -->
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Html::label('Content', 'المحتوى') !!}
                    {!! Html::textarea('content')->class('form-control')->placeholder('Enter Content')->value(old('content')) !!}
                    <!-- Display validation errors for the 'content' field inline -->
                    @error('content')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Html::label('Upload Image', 'اختر صورة') !!}
                    {!! Html::file('thumbnail')->class('form-control') !!}
                    <!-- Display validation errors for the 'thumbnail' field inline -->
                    @error('thumbnail')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Html::label('Select Category', 'اختر القسم') !!}
                    {!! Html::select('category_id', $categories)->class('form-control') !!}
                    <!-- Display validation errors for the 'category_id' field inline -->
                    @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Html::label('publish_date', 'تاريخ النشر') !!}
                    {!! Html::date('publish_date', \Carbon\Carbon::now()->format('Y-m-d'))->class('form-control') !!}
                    <!-- Display validation errors for the 'publish_date' field inline -->
                    @error('publish_date')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Html::submit('حفظ')->class('btn btn-primary') !!}
                </div>

                {!! Html::form()->close() !!} <!-- Close the form -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
