@extends('adminlte::page')

@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="card-title">Add New User</h3>
        </div>

        <!-- Form start -->
        {!! html()->form('POST', route('users.store'))->id('myForm')->open() !!}
        @csrf
        @include('flash::message')
        <div class="card-body">
            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                {!! html()->text('name')
                    ->class('form-control')
                    ->id('name')
                    ->value(old('name'))
                    ->placeholder('Enter Name') !!}
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                {!! html()->email('email')
                    ->class('form-control')
                    ->id('email')
                    ->value(old('email'))
                    ->placeholder('Enter Email') !!}
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                {!! html()->password('password')
                    ->class('form-control')
                    ->id('password')
                    ->placeholder('Enter Password') !!}
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                {!! html()->password('password_confirmation')
                    ->class('form-control')
                    ->id('password_confirmation')
                    ->placeholder('Re-enter the password') !!}
            </div>

            <!-- Roles Field -->
            <div class="form-group">
                <label for="roles_list">User Roles</label>
                <div id="roles_list">
                    <div class="form-check">
                        <input type="checkbox" id="select_all_roles" class="form-check-input">
                        <label class="form-check-label" for="select_all_roles">Select All</label>
                    </div>
                    <!-- Individual Role Checkboxes -->
                    @foreach($roles as $id => $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles_list[]" value="{{ $id }}" id="role_{{ $id }}"
                                   class="form-check-input role-checkbox"
                                {{ in_array($id, old('roles_list', $model->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $id }}">{{ $role }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Card footer -->
        <div class="card-footer">
            {!! html()->submit('Save')->class('btn btn-primary') !!}
        </div>

        {!! html()->form()->close() !!}
    </div>
@endsection

@section('js')
    <script>
        // JavaScript for "Select All" functionality
        document.getElementById('select_all_roles').addEventListener('change', function () {
            const roleCheckboxes = document.querySelectorAll('.role-checkbox');
            roleCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Update "Select All" based on individual checkbox changes
        document.querySelectorAll('.role-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                document.getElementById('select_all_roles').checked = [...document.querySelectorAll('.role-checkbox')].every(cb => cb.checked);
            });
        });
    </script>
@endsection
