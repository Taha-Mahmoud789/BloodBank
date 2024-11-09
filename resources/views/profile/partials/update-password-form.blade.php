<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ __('Update Password') }}</h3>
    </div>
    <div class="card-body">
        <p>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="update_password_current_password">{{ __('Current Password') }}</label>
                <input type="password" id="update_password_current_password" name="current_password"
                       class="form-control" autocomplete="current-password" placeholder="{{ __('Current Password') }}">
                @error('current_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="update_password_password">{{ __('New Password') }}</label>
                <input type="password" id="update_password_password" name="password" class="form-control"
                       autocomplete="new-password" placeholder="{{ __('New Password') }}">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                       class="form-control" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <p class="text-success mt-2">
                    {{ __('Saved successfully.') }}
                </p>
            @endif
        </form>
    </div>
</div>
