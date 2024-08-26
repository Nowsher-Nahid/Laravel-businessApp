@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Business Listing')
@section('content')

{{-- <div class="single-page-header" data-background-image="{{ asset('assets/images/single-job.jpg') }}"> --}}
<div class="single-page-header" data-background-image="{{ asset($listing->ft_image) }}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image"><a href="single-company-profile.html"><img src="{{ asset($listing->ft_image) }}" alt=""></a></div>
						<div class="header-details">
							<h3>{{ $listing->company }}</h3>
							<h5>Listing Information</h5>
							<ul>
								{{-- <li><a href="single-company-profile.html"><i class="icon-material-outline-business"></i> King</a></li> --}}
								@if ($listing->reviews->isNotEmpty() && $listing->reviews->first()->rating)
									<li>
										<div class="star-rating" data-rating="{{ $listing->reviews->first()->rating }}"></div>
									</li>
								@endif

								<li><i class="icon-material-outline-location-on"></i> {{ $listing->country }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@php
    $gallery_images = json_decode($listing->gallery, true);
@endphp
@if(!empty($gallery_images) && is_array($gallery_images))
    <div id="carouselExampleControls" class="container carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($gallery_images as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset($image) }}" class="d-block w-100" alt="{{ $listing->company }}" style="height: 500px;">
                </div>
            @endforeach

			{{-- <div class="carousel-item active">
			<img src="{{ asset('assets/images/slider/slider_1.png') }}" class="" alt="...">
		</div>
		<div class="carousel-item">
			<img src="{{ asset('assets/images/slider/slider_2.png') }}" class="" alt="...">
		</div>
		<div class="carousel-item">
			<img src="{{ asset('assets/images/slider/slider_3.png') }}" class="" alt="...">
		</div> --}}

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif

<div class="container margin-top-40">
	<div class="row">
		<div class="col-xl-12 col-lg-12 content-right-offset">
			<div class="single-page-section">
				<h2 class="margin-bottom-25">Listing Services</h2>
				<p>{{ $listing->services }}</p>
			</div>

			@if($listing->reviews->isNotEmpty())
				<div class="boxed-list margin-bottom-60">
					<div class="boxed-list-headline">
						<h3><i class="icon-material-outline-thumb-up"></i> Reviews</h3>
					</div>
					<ul class="boxed-list-ul">
						@foreach($listing->reviews as $review)
							<li>
								<div class="boxed-list-item">
									<div class="item-content">
										<h4>{{ $review->user->name }}</h4>
										<div class="item-details margin-top-10">
											<div class="star-rating" data-rating="{{ $review->rating }}"></div>
											<div class="detail-item"><i class="icon-material-outline-date-range"></i> {{ $review->created_at->format('F Y') }}</div>
										</div>
										<div class="item-description">
											<p>{{ $review->review }}</p>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
					<div class="centered-button margin-top-35">
						<a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
			@endif

			@if($similarListings->isNotEmpty())
				<div class="single-page-section">
					<h2 class="margin-bottom-25">Similar Listings</h2>
					<div class="listings-container grid-layout">

						@foreach ($similarListings as $listing)
							<a href="#" class="job-listing">
								<div class="job-listing-details">
									<div class="job-listing-company-logo">
										<img src="{{ asset('assets/images/company-logo-02.png') }}" alt="">
									</div>
									<div class="job-listing-description">
										<h3 class="job-listing-title">{{ $listing->company }}</h3>
									</div>
								</div>
								<div class="job-listing-footer">
									<ul>
										<li><i class="icon-material-outline-location-on"></i> {{ $listing->country }}</li>
										<li><i class="icon-feather-star"></i> {{ $listing->reviews->avg('rating') ?? 0 }}/5</li>
										<li><i class="icon-line-awesome-comments-o"></i> {{ $listing->reviews->count() }} Reviews</li>
										<li><i class="icon-material-outline-access-time"></i> {{ $listing->created_at->diffForHumans() }}</li>
									</ul>
								</div>
							</a>
						@endforeach
						
					</div>
				</div>
			@endif

		</div>
	</div>
</div>

<!--Review popup-->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
	<div class="sign-in-form">
		<ul class="popup-tabs-nav">
			<li><a href="#tab">Review Now</a></li>
		</ul>
		<div class="popup-tabs-container">
			<div class="popup-tab-content" id="tab">
				<div class="welcome-text">
					<h3>Rate & Review</h3>
				</div>
				
				<form method="post" id="apply-now-form">
					<div class="input-with-icon-left">
						<select class="input-text with-border py-0">
							<option value="">Select rating</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="input-with-icon-left">
						<textarea cols="30" rows="5" class="with-border" name="review" placeholder="Leave a review"></textarea>
					</div>
					<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Submit <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>
				
			</div>
		</div>
	</div>
</div>

@endsection