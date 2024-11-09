@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('settings.update', $model->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('flash::message')

                    <div class="form-group">
                        <label for="fb_link">رابط فيس بوك</label>
                        <input type="text" name="fb_link" class="form-control"
                               value="{{ old('fb_link', $model->fb_link) }}">

                        <label for="tw_link">رابط تويتر</label>
                        <input type="text" name="tw_link" class="form-control"
                               value="{{ old('tw_link', $model->tw_link) }}">

                        <label for="yt_link">رابط يوتيوب</label>
                        <input type="text" name="yt_link" class="form-control"
                               value="{{ old('yt_link', $model->yt_link) }}">

                        <label for="ins_link">رابط انستجرام</label>
                        <input type="text" name="ins_link" class="form-control"
                               value="{{ old('ins_link', $model->ins_link) }}">

                        <label for="phone">الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $model->phone) }}">

                        <label for="email">الإيميل</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email', $model->email) }}">

                        <label for="about_app">عن التطبيق</label>
                        <textarea name="about_app"
                                  class="form-control">{{ old('about_app', $model->about_app) }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">تعديل</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
