<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ __('Profile Information') }}</h3>
    </div>
    <div class="card-body">
        <p>{{ __("Update your account's profile information and email address.") }}</p>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-link p-0">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success mt-2">
                    {{ __('Saved.') }}
                </p>
            @endif
        </form>
    </div>
</div>
