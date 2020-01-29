@extends('admin.layouts.plain')
@section('content')
<form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <h1>{{ __('Reset Password') }}</h1>
        <div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

            
        </div>
        <div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="Password">
        </div>
        <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        </div>
        <div>
            <button type="submit" class="btn btn-default submit">
                {{ __('Reset Password') }}
            </button>
        </div>

        <div class="clearfix"></div>

        <div class="separator">
            <p class="change_link">
                <a class="reset_pass" href="/login">
                {{-- <a class="reset_pass" href="#signup"> --}}
                    Login Instead?
                </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
                @include('admin.include.plain_footer')
            </div>
        </div>
    </form>
@endsection