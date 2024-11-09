@extends('adminlte::page')

@section('content')
    <div class="box">
        <!-- Form Start -->
        <form action="{{ route('users.update', $model->id) }}" method="POST" id="myForm" role="form">
            @csrf
            @method('PUT')

            <div class="box-body">
                @include('flash::message')
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $model->name) }}">
                </div>

                <div class="form-group">
                    <label for="email">الايميل</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ old('email', $model->email) }}">
                </div>
                <div class="form-group">
                    <label for="roles_list">رتب المستخدمين</label>
                    <div id="roles_list">
                        <div class="form-check">
                            <input type="checkbox" id="select_all_roles" class="form-check-input">
                            <label class="form-check-label" for="select_all_roles">Select All</label>
                        </div>
                        <!-- Individual Role Checkboxes -->
                        @foreach($roles as $id => $role)
                            <div class="form-check">
                                <input type="checkbox" name="roles_list[]" value="{{ $id }}" id="role_{{ $id }}" class="form-check-input role-checkbox"
                                    {{ in_array($id, old('roles_list', $model->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $id }}">{{ $role }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
    <script>
        // JavaScript for "Select All" functionality
        document.getElementById('select_all_roles').addEventListener('change', function() {
            const roleCheckboxes = document.querySelectorAll('.role-checkbox');
            roleCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Update "Select All" based on individual checkbox changes
        document.querySelectorAll('.role-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = [...document.querySelectorAll('.role-checkbox')].every(cb => cb.checked);
                document.getElementById('select_all_roles').checked = allChecked;
            });
        });
    </script>
@endsection


