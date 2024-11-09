@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Create Role</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="permissions">Permissions</label>
                <div>
                    <div class="form-check">
                        <input type="checkbox" id="select_all" class="form-check-input">
                        <label class="form-check-label" for="select_all">Select All</label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                   id="permission_{{ $permission->name }}" class="form-check-input permission-checkbox">
                            <label class="form-check-label"
                                   for="permission_{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Role</button>
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
