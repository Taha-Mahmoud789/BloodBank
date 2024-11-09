@extends('adminlte::page')
@section('content')
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">User management</h3>
            <div class="card-tools">
                {{--                 Uncomment the following lines if you want to add a button to create a new user --}}
                <a href="{{ url('users/create') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> NEW User
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('flash::message')
            @if(!empty($users))
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> User Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($users as $user)
                            <tr id="removable{{$user->id}}">
                                <td>{{ $count }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge badge-success">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
                            @php $count++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $users->links() !!}
                </div>
            @else
                <div class="alert alert-info">
                    {{ __('لا توجد بيانات لعرضها') }}
                </div>
            @endif
        </div>
    </div>
@stop
