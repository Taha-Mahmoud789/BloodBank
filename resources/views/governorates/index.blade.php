@extends('adminlte::page')
@section('content')
    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Governorates</h3>

            </div>
            <div class="box-body">
                <div class="box-header with-border">
                    <form method="GET" action="" class="form-inline mb-3">
                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <input type="text" name="name" value="{{ request()->input('name') }}"
                                        placeholder="Governorate_name" class="form-control" style="width: 100%;">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        <i class="fa fa-search"></i> search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-header mb-3">
                    <a href="{{ route('governorates.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add governorate
                    </a>
                </div>
                @include('flash::message')
                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead style="background-color: #3C8DBC; color: #ffffff;">
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>name</th>
                                    <th class="text-center" style="width: 15%;">Edit</th>
                                    <th class="text-center" style="width: 15%;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr id="removable{{ $record->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('governorates.edit', $record->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('governorates.destroy', $record->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this governorate?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper text-center">
                            {{ $records->links() }}
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
