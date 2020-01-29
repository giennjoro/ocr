@extends('client.layouts.app')
@include('layouts.messages')
@section('content')
<!--Page Title-->
<section class="bredcrumb">
    <div class="bg-image text-center" style="background-image: url('client/images/slider/2.jpg');">
        <h1>Sign Up</h1>
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
                        <h6 class="gold-header">already have an account? <a href="/login">Log in</a></h6>
                        <div class="coupon">
                            <div class="col-xs-12">
                                <p>Enter details below to create an account with us and be able to enjoy double quick premium tips.</p>
                            </div>

                            <form name="login-form" class="col-xs-12 default-form mt-30" method="POST"
                                action="{{ route('register') }}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">

                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Full Name*" required
                                                autocomplete="name" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email Address" name="email" value="{{ old('email') }}"
                                                required autocomplete="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">
                                            <input id="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Phone Number" name="phone" value="{{ old('phone') }}"
                                                required autocomplete="phone">
                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password" required
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">

                                        <div class="form-group style-two">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>

                                </div>
                                <div class="contact-section-btn col-xs-4 no-p-l text-center">
                                    <div class="form-group no-m-b ">
                                        <button style="font-size:14px" class="btn btn-primary" type="submit"
                                            data-loading-text="Please wait...">Register Now!</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
