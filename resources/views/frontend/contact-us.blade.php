@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Contact Us')
@section('content')

<div class="single-page-header" data-background-image="{{ asset('assets/images/single-job.jpg') }}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-details">
							<h1 class="text-center my-4" style="font-size: 60px; font-weight: bold;">Contact Us</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container  margin-top-40 margin-bottom-40">
	<div class="row">

		<div class="col-xl-12">
			<div class="contact-location-info margin-bottom-50">
				<div class="contact-address">
					<ul>
						<li class="contact-address-headline">Our Office</li>
						<li>425 Berry Street, CA 93584</li>
						<li>Phone (123) 123-456</li>
						<li><a href="#">mail@example.com</a></li>
						<li>
							<div class="freelancer-socials">
								<ul>
									<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
									<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
									<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
									<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
								
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div id="single-job-map-container">
					<div id="singleListingMap" data-latitude="37.777842" data-longitude="-122.391805" data-map-icon="im im-icon-Hamburger"></div>
					<a href="#" id="streetView">Street View</a>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection