@extends('adminlte::page')

@section('content')
    <div class="box">
        <!-- Form Start -->
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">
                @include('flash::message')
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <div class="form-check">
                        <input type="checkbox" id="select_all" class="form-check-input">
                        <label class="form-check-label" for="select_all">Select All</label>
                    </div>
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                                   class="form-check-input permission-checkbox"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Role</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('select_all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
