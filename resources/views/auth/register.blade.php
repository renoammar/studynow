@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; width:100%;">
    <div class="card shadow" style="width: 500px; border-radius: 12px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">{{ __('Register') }}</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" 
                        class="form-control" name="password_confirmation" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-dark">{{ __('Register') }}</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}">{{ __('Already have an account? Login') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
