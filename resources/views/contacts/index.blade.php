@extends('adminlte::page')
@section('content')

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Messages</h3>
            </div>
            <div class="box-body">
                @include('flash::message')
                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">subject</th>
                                <th class="text-center">message</th>
                                <th class="text-center">Client Name</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
{{--                                @dd($records);--}}
                                <tr id="removable{{ $record->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $record->subject }}</td>
                                    <td class="text-center">{{ $record->message }}</td>
                                    <td class="text-center">{{ optional($record->client)->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('contacts.destroy', $record->id) }}" method="POST"
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
                        <div class="pagination-wrapper" style=" display: flex;
                                justify-content: center;
                                margin-top: 20px;">
                            {{ $records->links() }}
                        </div>

                    </div>
                @else
                    <p class='text-center h3'>لا توجد رسائل !!</p>
                @endif
            </div>
        </div>
    </section>
@endsection
