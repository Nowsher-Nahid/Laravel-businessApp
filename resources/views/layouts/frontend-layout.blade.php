<!doctype html>
<html lang="en">
   <head>
      	<title>@yield('title')</title>
      	<meta charset="utf-8">
      	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.jpg') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
      	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      	<link rel="stylesheet" href="{{ asset('assets/css/colors/blue.css') }}">
   </head>
   <body>
      <!-- Wrapper -->
      <div id="wrapper">
         <!-- Header Container
            ================================================== -->
         <header id="header-container" class="fullwidth">
            <!-- Header -->
            <div id="header">
               <div class="container">
                  <!-- Left Side Content -->
                  <div class="left-side">
                     <!-- Logo -->
                     <div id="logo">
                        <a href="index.html"><img src="{{ asset('assets/images/logo.jpg') }}" alt=""></a>
                     </div>
                     <!-- Main Navigation -->
                     <nav id="navigation">
                        <ul id="responsive">
                           <li><a href="{{ route('home.index') }}" class="current">Home</a></li>
						   	@auth
								@if (App\Models\Listing::where('user_id', auth()->id())->exists() || Auth::user()->role === 0)
									<li><a href="{{ route('business-listings.index') }}">Business Listings</a></li>
								@endif
							@endauth
                           <li><a href="{{ route('about-us') }}">About Us</a></li>
                           <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                           <li><a href="{{ route('subscription') }}">Subscription</a></li>
                        </ul>
                     </nav>
                     <div class="clearfix"></div>
                     <!-- Main Navigation / End -->
                  </div>
                  <!-- Left Side Content / End -->
                  <!-- Right Side Content / End -->

                  <div class="right-side">

					@guest
					<div class="header-widget m-d-none">
						<div class="header-notifications">
							<div class="header-notifications-trigge right-trigger margin-top-20">
								<a href="{{ route('login') }}">Login</a>
							</div>
						</div>
					</div>
					<div class="header-widget m-d-none">
						<div class="header-notifications">
							<div class="header-notifications-trigge right-trigger margin-top-20">
								<a href="{{ route('register') }}">Sign up</a>
							</div>
						</div>
					</div>
					@endguest

					@auth
						<div class="header-widget m-d-none">
							<div class="header-notifications">
								<div class="header-notifications-trigge right-trigger margin-top-20">
									<a href="{{ route('listing.create') }}">List Business</a>
								</div>
							</div>
						</div>
					@endauth

					 @auth
						<div class="header-widget">
							<!-- Messages -->
							<div class="header-notifications user-menu">
							<div class="header-notifications-trigger">
								<a href="#">
									<div class="user-avatar"><img src="{{ asset('assets/images/user-avatar-small-01.jpg') }}" alt=""></div>
								</a>
							</div>
							<!-- Dropdown -->
							<div class="header-notifications-dropdown">
								<!-- User Status -->
								<div class="user-status">
									<!-- User Name / Avatar -->
									<div class="user-details">
										<div class="user-avatar"><img src="{{ asset('assets/images/user-avatar-small-01.jpg') }}" alt=""></div>
										<div class="user-name">
											@auth
												{{ Auth::user()->name }} <span>{{ Auth::user()->email }}</span>
											@endauth
										</div>
									</div>
								</div>
								<ul class="user-menu-small-nav">
									<li class="pc-d-none"><a href="{{ route('login') }}"><i class="icon-material-outline-account-circle"></i> Login</a></li>
									<li class="pc-d-none"><a href="{{ route('register') }}"><i class="icon-feather-user-plus"></i> Sign up</a></li>

									@if (App\Models\Listing::where('user_id', auth()->id())->exists())
										@if (Auth::user()->role === 0)
											<li><a href="{{ route('dashboard.index') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
										@else
											<li><a href="{{ route('listing.index') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
										@endif
									@endif
									
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
										</form>
									</li>
								</ul>
							</div>
							</div>
						</div>
					@endauth

                     <!-- Mobile Navigation Button -->
                     <span class="mmenu-trigger">
                     <button class="hamburger hamburger--collapse" type="button">
                     <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                     </span>
                     </button>
                     </span>
                  </div>
                  <!-- Right Side Content / End -->
               </div>
            </div>
            <!-- Header / End -->
         </header>
         <div class="clearfix"></div>
         <!-- Header Container / End -->
         
        @yield('content')

        <!-- Footer -->
		<div id="footer">
			<div class="footer-top-section">
				<div class="container">
					<div class="row">
						<div class="col-xl-12">
							<div class="footer-rows-container">
								<div class="footer-rows-left">
									<div class="footer-row">
										<div class="footer-row-inner footer-logo">
											<img src="{{ asset('assets/images/logo2.jpg') }}" alt="">
										</div>
									</div>
								</div>
								<div class="footer-rows-right">
									<div class="footer-row">
										<div class="footer-row-inner">
											<ul class="footer-social-links">
												<li>
													<a href="#" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
														<i class="icon-brand-facebook-f"></i>
													</a>
												</li>
												<li>
													<a href="#" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
														<i class="icon-brand-twitter"></i>
													</a>
												</li>
												<li>
													<a href="#" title="LinkedIn" data-tippy-placement="bottom" data-tippy-theme="light">
														<i class="icon-brand-linkedin-in"></i>
													</a>
												</li>
											</ul>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer-middle-section">
				<div class="container">
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="footer-links">
								<h3>For Business Owners</h3>
								<ul>
									<li><a href="#"><span>Dashboard</span></a></li>
									<li><a href="#"><span>Create a Listing</span></a></li>
									<li><a href="#"><span>All Listings</span></a></li>
									<li><a href="#"><span>Edit Profile</span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="footer-links">
								<h3>For Customers</h3>
								<ul>
									<li><a href="#"><span>Browse Listings</span></a></li>
									<li><a href="#"><span>Browse Listings</span></a></li>
									<li><a href="#"><span>Browse Listings</span></a></li>
									<li><a href="#"><span>Browse Listings</span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="footer-links">
								<h3>Helpful Links</h3>
								<ul>
									<li><a href="{{ route('about-us') }}"><span>About Us</span></a></li>
									<li><a href="{{ route('contact-us') }}"><span>Contact Us</span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="footer-links">
								<h3>Account</h3>
								<ul>
									<li><a href="{{ route('login') }}"><span>Sign in</span></a></li>
									<li><a href="{{ route('register') }}"><span>Sign up</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom-section">
				<div class="container">
					<div class="row">
						<div class="col-xl-12">
							© 2024 <strong>Business</strong>. All Rights Reserved.
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer / End -->
      </div>
      <!-- Wrapper / End -->

   <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-migrate-3.3.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/mmenu.min.js') }}"></script>
	<script src="{{ asset('assets/js/tippy.all.min.js') }}"></script>
	<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-slider.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('assets/js/snackbar.js') }}"></script>
	<script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
	<script src="{{ asset('assets/js/counterup.min.js') }}"></script>
	<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<!-- Google API & Maps -->
	<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->
	<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
	<script src="{{ asset('assets/js/infobox.min.js') }}"></script>
	<script src="{{ asset('assets/js/markerclusterer.js') }}"></script>
	<script src="{{ asset('assets/js/maps.js') }}"></script>

	@stack('scripts')

   </body>
</html>