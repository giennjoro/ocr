<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<title>Double Quick</title>

	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('client/fonts/flaticon.css') }}" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!--favicon-->
	<link rel="shortcut icon" href="{{ asset('client/images/favicon/favicon.ico') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />


</head>

<body>
	<div class="boxed_wrapper">
		<div class=" text-center crypto-top-strip crypto-bgcolor">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class=" crypto-userinfo">
							<li><i class="fa fa-envelope-o"></i> info@doublequick.com</li>
							<li><i class="fa fa-phone"></i> +254 743 849900</li>
							@auth
							<li class="d-none d-md-block" style="float:right"><a href="/user-dashboard"
									style="color: white"><i class="fa fa-user"></i>
									{{ (explode(' ', Auth::user()->name))[0] }}</a></li>
							@endauth
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Menu -->
		<div class="mainmenu-area ">
			<div class="container">
				<div class="row">
					<div class="col-md-3 ">
						<div class="main-logo">
							{{-- <h2 style="padding-top:20px">Double Quick</h2> --}}
							<img src="{{ asset('logo.png') }}" alt="DoubleQuick Logo">
						</div>

					</div>
					<div class="col-md-7 menu-column">
						<nav class="main-menu">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse"
									data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse clearfix">
								<ul class="navigation clearfix">
									<li class="{{isActiveRoute('landing')}}"><a href="/"> Home</a></li>
									<li class="{{isActiveRoute('about')}}"><a href="/about-us"> About</a></li>
									@if(Auth::check())
									<li><a href="{{ Auth::user()->is_admin? '/login': '/user-dashboard' }}"><i
												class="fa fa-dashboard"></i> Dashboard</a></li>
									<li class="{{isActiveRoute('login')}}">
										<a href="{{ route('logout') }}" onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
											<i class="fa fa-reply icon"></i>
											{{ __('Logout') }}
										</a>
									</li>
									@else
									<li class="{{isActiveRoute('login')}}"><a href="/login"><i class="fa fa-user"></i>
											Login</a></li>
									<li class="{{isActiveRoute('register')}}"><a href="/register"><i
												class="fa fa-plus"></i> Signup</a></li>
									@endif
									<li class="{{isActiveRoute('contact')}}"><a href="/contact-us"> Contact</a></li>
									<li class="{{isActiveRoute('plans')}}"><a href="/plans">Pricing</a></li>
								</ul>

								<ul class="mobile-menu clearfix">
									<li class="{{isActiveRoute('landing')}}"><a href="/"><i class="fa fa-home"></i>
											Home</a></li>
									<li class="{{isActiveRoute('about')}}"><a href="/about-us"><i
												class="fa fa-info"></i> About</a></li>
									@if(Auth::check())
									<li><a href="{{ Auth::user()->is_admin? '/login': '/user-dashboard' }}"><i
												class="fa fa-dashboard"></i> Dashboard</a></li>
									<li class="{{isActiveRoute('login')}}">
										<a href="{{ route('logout') }}" onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
											<i class="fa fa-reply icon"></i>
											{{ __('Logout') }}
										</a>
									</li>
									@else
									<li class="{{isActiveRoute('login')}}"><a href="/login"><i class="fa fa-user"></i>
											Login</a></li>
									<li class="{{isActiveRoute('register')}}"><a href="/register"><i
												class="fa fa-plus"></i> Signup</a></li>
									@endif
									<li class="{{isActiveRoute('contact')}}"><a href="/contact-us"><i
												class="fa fa-phone"></i> Contact</a></li>
									<li class="{{isActiveRoute('plans')}}"><a href="/plans"><i class="fa fa-money"></i>
											Pricing</a></li>
									@auth
									@if (Auth::user()->subscription_expiry >= now()->format('Y-m-d H:i:s'))
									<li><a href="/all-matches"><i class="fa fa-soccer-ball-o"></i> View vip tips</a>
									</li>
									@else
									<li><a href="/plans"><i class="fa fa-money"></i> Subscribe</a></li>
									@endif

									@endauth
									@guest
									<li><a href="/plans"><i class="fa fa-trophy"></i> Join Vip Now</a></li>
									@endguest
								</ul>
							</div>
						</nav>
					</div>
					<div class="col-md-2">
						<div class="right-area">
							<div class="link_btn float_right">
								@auth
								@if (Auth::user()->subscription_expiry >= now()->format('Y-m-d H:i:s'))
								<a href="/#tips" class="thm-btn">
									VIP Tips
								</a>
								@else
								<a href="/plans" class="thm-btn">
									Subscribe
								</a>
								@endif

								@endauth
								@guest
								<a href="/login" class="thm-btn">Join Vip Now</a>
								@endguest
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		{{-- Logout Form --}}
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>

		@yield('content')

		<footer class="footer footer-classic">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="footer-text">
							<h3>About us</h3>
							<p>
								Double Quick is an online service provider of precise football predictions and data
								analysis. We provide clear access to the predictions data in a friendly and
								easy-to-understand way, giving the possibility to read the information even if the users
								are beginners.
							</p>
							<div class="social-icons">
								<a href="#" class="btn btn-social btn-social-o twitter">
									<i class="fa fa-twitter"></i>
								</a>
								{{-- <a href="#" class="btn btn-social btn-social-o linkedin">
									<i class="fa fa-linkedin"></i>
								</a> --}}
								<a href="#" class="btn btn-social btn-social-o facebook">
									<i class="fa fa-facebook-f"></i>
								</a>
								{{-- <a href="#" class="btn btn-social btn-social-o skype">
									<i class="fa fa-skype"></i>
								</a>
								<a href="#" class="btn btn-social btn-social-o pinterest">
									<i class="fa fa-pinterest-p"></i>
								</a> --}}
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="links">
							<h3>Links</h3>
							<ul class="">
								<li><a href="/">Home</a></li>
								<li><a href="/about-us">About Us</a></li>
								<li><a href="/plans">VIP Platform</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-2">
						<div class="links">
							<h3>Links</h3>
							<ul class="">
								<li><a href="/login">Login</a></li>
								<li><a href="/register">Signup</a></li>
								<li><a href="/contact-us">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<div class="sidebar-wrapper">
							<div class="single-sidebar">
								<div class="wedgit-title">
									<div>
										<img src="{{ asset('mpesa.png') }}" alt="Mpesa-logo">
										<img src="{{ asset('pp.png') }}" alt="Paypal-logo">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- COPY RIGHT -->
				<div class="copyright">
					<hr>
					<div class="row justify-content-center">
						<div class="col-sm-7">
							<div class="copyRight_text text-center">
								<p>Copyright &copy {{ date('Y') }}Copyright <a href="#">DoubleQuick | Best Tips.</a> All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="copyRight_text text-center">
								<p>Developed By <a target="_blank" href="https://www.24seven.co.ke">24seven
										Developers.</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Scroll Top Button -->
		<button class="scroll-top tran3s color2_bg">
			<span class="fa fa-angle-up"></span>
		</button>
		<!-- pre loader  -->
		<div class="preloader"></div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
		</script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
		</script>
		<!-- jQuery js -->
		<script src="{{ asset('client/js/jquery.js') }}"></script>
		<!-- bootstrap js -->
		<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
		<!-- jQuery ui js -->
		<script src="{{ asset('client/js/jquery-ui.js') }}"></script>
		<!-- owl carousel js -->
		<script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>

		<!-- mixit up -->
		<script src="{{ asset('client/js/wow.js') }}"></script>
		<script src="{{ asset('client/js/jquery.mixitup.min.js') }}"></script>
		<script src="{{ asset('client/js/jquery.fitvids.js') }}"></script>
		<script src="{{ asset('client/js/bootstrap-select.min.js') }}"></script>

		<!-- revolution slider js -->
		<script src="{{ asset('client/assets/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset('client/assets/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.actions.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.carousel.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.kenburn.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.migration.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.parallax.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}">
		</script>
		<script src="{{ asset('client/assets/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

		<!-- fancy box -->
		<script src="{{ asset('client/js/jquery.fancybox.pack.js') }}"></script>
		<script src="{{ asset('client/js/jquery.polyglot.language.switcher.js') }}"></script>
		<script src="{{ asset('client/js/nouislider.js') }}"></script>
		<script src="{{ asset('client/js/jquery.bootstrap-touchspin.js') }}"></script>
		<script src="{{ asset('client/js/SmoothScroll.js') }}"></script>
		<script src="{{ asset('client/js/jquery.appear.js') }}"></script>
		<script src="{{ asset('client/js/jquery.flexslider.js') }}"></script>
		<script src="{{ asset('client/js/custom.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		@include('layouts.messages')
	</div>

</body>

</html>