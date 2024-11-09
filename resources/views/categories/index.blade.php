@extends('adminlte::page')
@section('title', 'categories Management')

@section('content_header')
    <h1>categories</h1>
@stop

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="box-header mb-3">
                    <a href="{{ route('categories.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add category
                    </a>
                </div>
                @include('flash::message')

                {{-- Display cities table --}}
                @if($records->count())
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th>#</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{ $record->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $record->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('categories.edit', $record->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('categories.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this governorate?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $records->links() !!}
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <strong>No Data Found</strong>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
