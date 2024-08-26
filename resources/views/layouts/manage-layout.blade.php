<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.jpg') }}">
	{{-- Datatable css --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
	{{-- fontawesome css --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
	{{-- Bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	{{-- System css  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors/blue.css') }}">
	
</head>
<body class="gray">

<div id="wrapper">
	<header id="header-container" class="fullwidth dashboard-header not-sticky">
		<div id="header">
			<div class="container">
			<div class="left-side">
				<div id="logo">
					<a href="index.html"><img src="{{ asset('assets/images/logo.jpg') }}" alt=""></a>
				</div>
				<nav id="navigation">
					<ul id="responsive">
						<li><a href="{{ route('home.index') }}" class="current" target="_blank">Home</a></li>
						@if (App\Models\Listing::where('user_id', auth()->id())->exists() || Auth::user()->role === 0)
							<li><a href="{{ route('business-listings.index') }}" target="_blank">Business Listings</a></li>
						@endif
                        <li><a href="{{ route('about-us') }}" target="_blank">About Us</a></li>
						<li><a href="{{ route('contact-us') }}" target="_blank">Contact Us</a></li>
                        <li><a href="{{ route('subscription') }}" target="_blank">Subscription</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
			</div>
			
			<div class="right-side">
				<div class="header-widget">
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
						<a href="#">
							<div class="user-avatar"><img src="{{ asset('assets/images/user-avatar-small-01.jpg') }}" alt=""></div>
						</a>
						</div>
						<div class="header-notifications-dropdown">
						<div class="user-status">
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
							<li><a href="{{ route('profile.edit') }}"><i class="icon-material-outline-dashboard"></i> Edit Profile</a></li>
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
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
			</div>
			</div>
		</div>
	</header>

	<div class="clearfix"></div>

	<div class="dashboard-container">
		<div class="dashboard-sidebar">
			<div class="dashboard-sidebar-inner" data-simplebar>
				<div class="dashboard-nav-container">
					<a href="#" class="dashboard-responsive-nav-trigger">
						<span class="hamburger hamburger--collapse" >
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</span>
						<span class="trigger-title">Dashboard Navigation</span>
					</a>
					<div class="dashboard-nav">
						<div class="dashboard-nav-inner">
							<ul>

								@if (Auth::user()->role === 0)
									<li class="{{ Route::is('dashboard.index') ? 'active' : '' }}"><a href="{{ route('dashboard.index') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
									<li class="{{ Route::is('category.*') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-assignment"></i> Category</a>
										<ul>
											<li><a href="{{ route('category.create') }}">Add Category</a></li>
											<li><a href="{{ route('category.index') }}">Category List</a></li>
										</ul>	
									</li>
									<li class="{{ Route::is('sub_category.*') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-layers"></i> Sub-category</a>
										<ul>
											<li><a href="{{ route('sub_category.create') }}">Add Sub-category</a></li>
											<li><a href="{{ route('sub_category.index') }}">Sub-category List</a></li>
										</ul>	
									</li>
								@endif

								<li class="{{ Route::is('listing.*') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-business-center"></i> Business</a>
									<ul>
										<li><a href="{{ route('listing.create') }}">Add Listing</a></li>
										@if (App\Models\Listing::where('user_id', auth()->id())->exists() || Auth::user()->role === 0)
											<li><a href="{{ route('listing.index') }}">Listings List</a></li>
										@endif
									</ul>	
								</li>

								@if (Auth::user()->role === 0)
									<li class="{{ Route::is('owner.index') ? 'active' : '' }}">
										<a href="{{ route('owner.index') }}"><i class="icon-material-outline-person-pin"></i> Owner List</a>
									<li>
									<li class="{{ Route::is('customer.index') ? 'active' : '' }}">
										<a href="{{ route('customer.index') }}"><i class="icon-material-outline-account-circle"></i> Customer List</a>
									<li>
									{{-- <li class="{{ Route::is('owner.*') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-business-center"></i> Business Owners</a>
										<ul>
											<li><a href="{{ route('owner.create') }}">Add Owner</a></li>
											<li><a href="{{ route('owner.index') }}">Owner List</a></li>
										</ul>	
									</li>
									<li class="{{ Route::is('customer.*') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-business-center"></i> Customers</a>
										<ul>
											<li><a href="{{ route('customer.create') }}">Add Customer</a></li>
											<li><a href="{{ route('customer.index') }}">Customers List</a></li>
										</ul>	
									</li> --}}
								@endif

								<li class="{{ Route::is('profile.edit') ? 'active' : '' }}"><a href="{{ route('profile.edit') }}"><i class="icon-material-outline-settings"></i> Edit Profile</a></li>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
								</li>
							</ul>
							<form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="dashboard-content-container" data-simplebar>
			<div class="dashboard-content-inner" >

				@yield('content')

				<div class="dashboard-footer-spacer"></div>
				<div class="small-footer margin-top-15">
					<div class="small-footer-copyrights">
						© 2024 <strong>AimDirect</strong>. All Rights Reserved.
					</div>
					<ul class="footer-social-links">
						<li>
							<a href="#" title="Facebook" data-tippy-placement="top">
								<i class="icon-brand-facebook-f"></i>
							</a>
						</li>
						<li>
							<a href="#" title="Twitter" data-tippy-placement="top">
								<i class="icon-brand-twitter"></i>
							</a>
						</li>
						<li>
							<a href="#" title="LinkedIn" data-tippy-placement="top">
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

<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	@if (session('success'))
		Swal.fire({
			title: 'Success!',
			text: "{{ session('success') }}",
			icon: 'success',
			confirmButtonText: 'Ok'
		})
  	@endif
</script>
@stack('scripts')

</body>
</html>