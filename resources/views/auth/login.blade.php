@extends('client.layouts.app')
@include('layouts.messages')
@section('content')
<!--Page Title-->
<section class="bredcrumb">
    <div class="bg-image text-center" style="background-image: url('client/images/slider/2.jpg');">
        <h1>Login</h1>
    </div>
</section>
<!--Page Title Ends-->

<!--team section-->
<section class="our-gallery">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="col-md-12 col-xs-12">
                    <div class="col-xs-12 mt-30" style="padding-right: 0px;padding-left: 0px;">
                        <h6 class="gold-header">Dont have an account? <a href="/register">Sign Up</a></h6>
                        <div class="coupon">
                            <div class="col-xs-12">
                                <p>Are you a member already, Login here to proceed.</p>
                            </div>

                            <form name="login-form" class="col-xs-12 default-form mt-30" method="POST"
                                action="{{ route('login') }}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">

                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="Email*" required
                                                autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                email placeholder="Password*" autofocus>
                                        </div>
                                    </div>

                                </div>
                                <div class="contact-section-btn col-xs-4 no-p-l text-center">
                                    <div class="form-group no-m-b ">
                                        <button style="font-size:14px" class="btn btn-primary" type="submit"
                                            data-loading-text="Please wait...">Login Now!</button>
                                    </div>
                                </div>
                                <div class="col-xs-4">

                                    <label class="checkbox"><input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}> Remember Me</label>
                                </div>
                                @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 14px">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection