@extends('admin.layouts.plain')
@section('content')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1>{{ __('Reset Password') }}</h1>
        <div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div>
            <button type="submit" class="btn btn-default submit">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>

        <div class="clearfix"></div>

        <div class="separator">
            <p class="change_link">Have Credentials ?
                <a href="/login" class="to_register"> Log in </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
                @include('admin.include.plain_footer')
            </div>
        </div>
    </form>
@endsection