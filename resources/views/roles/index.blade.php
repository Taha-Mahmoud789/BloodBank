@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">All Roles</h1>

        <!-- Display Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @if($role->permissions->isEmpty())
                                <span class="badge badge-danger">No Permissions</span>
                            @else
                                <ul class="list-inline mb-0">
                                    @foreach($role->permissions as $permission)
                                        <li class="list-inline-item">
                                            <span class="badge badge-secondary">{{ $permission->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group-vertical" role="group" aria-label="Actions">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group-vertical" role="group" aria-label="Actions">
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
