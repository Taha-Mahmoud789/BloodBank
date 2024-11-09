@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit Post</h1>
@stop

@inject('categories', 'App\Models\Categorie')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit the Post</h3>
            </div>
            <div class="box-body">
                {{-- Open the form --}}
                <form action="{{ route('posts.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Display validation errors if they exist --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Title Input --}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title', $model->title) }}" class="form-control" placeholder="Enter the title">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Content Input --}}
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" class="form-control" placeholder="Enter the content">{{ old('content', $model->content) }}</textarea>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail Image</label>
                        <div>
                            <img src="{{ asset('storage/'.$model->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" width="200">
                        </div>
                        <input type="file" name="thumbnail" class="form-control file_upload_preview">
                        @error('thumbnail')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category Selection --}}
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Choose a category</option>
                            @foreach($categories->pluck('name', 'id') as $id => $name)
                                <option value="{{ $id }}" {{ $id == old('category_id', $model->category_id) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Publish Date --}}
                    <div class="form-group">
                        <label for="publish_date">Publish Date</label>
                        <input type="date" name="publish_date" value="{{ old('publish_date', $model->publish_date) }}" class="form-control">
                        @error('publish_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection
