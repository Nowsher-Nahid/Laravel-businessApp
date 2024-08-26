@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Business Listings')
@section('content')

<div class="margin-top-90"></div>

{{-- <div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Location</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input id="autocomplete-input" type="text" placeholder="Location">
						</div>
						<i class="icon-material-outline-location-on"></i>
					</div>
				</div>
				
				<!-- Category -->
				<div class="sidebar-widget">
					<h3>Category</h3>
					<select class="selectpicker default" data-selected-text-format="count" data-size="7" title="All Categories">
						@foreach ($categories as $category)
							<option value="{{ $category->id }}">{{ $category->title }}</option>
						@endforeach
					</select>
				</div>

				<!-- Sub Category -->
				<div class="sidebar-widget">
					<h3>Sub-category</h3>
					<select class="selectpicker default" data-selected-text-format="count" data-size="7" title="All Sub-categories" >
						@foreach ($sub_categories as $sub_category)
							<option value="{{ $sub_category->id }}">{{ $sub_category->title }}</option>
						@endforeach
					</select>
				</div>
				
				<!-- Ratings -->
				<div class="sidebar-widget">
					<h3>Rating</h3>
					<div class="switches-list">
						@for ($i = 1; $i <= 5; $i++)
                            <div class="switch-container">
                                <label class="switch"><input type="checkbox" value="{{ $i }}"><span class="switch-button"></span> {{ $i }}</label>
                            </div>
                        @endfor
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h2 class="page-title">Business Listings</h2>
			<div class="listings-container grid-layout margin-top-35">
				
				<a href="" class="job-listing">
                    <div class="job-listing-details">
                        <div class="job-listing-company-logo">
                            <img src="{{ asset('assets/images/company-logo-01.png') }}" alt="">
                        </div>
                        <div class="job-listing-description">
                            <h4 class="job-listing-company">Company</h4>
                            <h3 class="job-listing-title">Listing Title</h3>
                        </div>
                    </div>
                    <div class="job-listing-footer">
                        <ul>
                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                            <li><i class="icon-feather-star"></i> 4.5/5</li>
                            <li><i class="icon-line-awesome-comments-o"></i> 17 Reviews</li>
                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                        </ul>
                    </div>
                </a>
                <a href="" class="job-listing">
                    <div class="job-listing-details">
                        <div class="job-listing-company-logo">
                            <img src="{{ asset('assets/images/company-logo-01.png') }}" alt="">
                        </div>
                        <div class="job-listing-description">
                            <h4 class="job-listing-company">Company</h4>
                            <h3 class="job-listing-title">Listing Title</h3>
                        </div>
                    </div>
                    <div class="job-listing-footer">
                        <ul>
                            <li><i class="icon-material-outline-location-on"></i> San Francisco</li>
                            <li><i class="icon-feather-star"></i> 4.5/5</li>
                            <li><i class="icon-line-awesome-comments-o"></i> 17 Reviews</li>
                            <li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
                        </ul>
                    </div>
                </a>

			</div>

			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="pagination-container margin-top-30 margin-bottom-60">
						<nav class="pagination">
							<ul>
								<li class="pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li><a href="#" class="current-page">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li class="pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

		</div>
	</div>
</div> --}}


{{-- New ---------------------  --}}
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="sidebar-container">
                <form id="filterForm" method="GET" action="{{ route('business-listings.index') }}">
                    <!-- Location -->
                    <div class="sidebar-widget">
                        <h3>Location</h3>
                        <div class="input-with-icon">
                            <div id="autocomplete-container">
                                <input id="autocomplete-input" type="text" placeholder="Location" name="location" value="{{ request('location') }}">
                            </div>
                            <i class="icon-material-outline-location-on"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="sidebar-widget">
                        <h3>Category</h3>
                        <select class="selectpicker default" name="category" data-selected-text-format="count" data-size="7" title="All Categories">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Category -->
                    <div class="sidebar-widget">
                        <h3>Sub-category</h3>
                        <select class="selectpicker default" name="sub_category" data-selected-text-format="count" data-size="7" title="All Sub-categories">
                            @foreach ($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}" {{ request('sub_category') == $sub_category->id ? 'selected' : '' }}>{{ $sub_category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ratings -->
                    <div class="sidebar-widget">
                        <h3>Rating</h3>
                        <div class="switches-list">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="switch-container">
                                    <label class="switch">
                                        <input type="checkbox" name="ratings[]" value="{{ $i }}" {{ is_array(request('ratings')) && in_array($i, request('ratings')) ? 'checked' : '' }}>
                                        <span class="switch-button"></span> {{ $i }}
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 content-left-offset">
            <h2 class="page-title">Business Listings</h2>
            <div class="listings-container grid-layout margin-top-35">
                @forelse($listings as $listing)
                    <a href="{{ route('business-listing-details.index', $listing->id) }}" class="job-listing">
                        <div class="job-listing-details">
                            <div class="job-listing-company-logo">
                                <img src="{{ asset($listing->ft_image) }}" alt="{{ $listing->company }}">
                            </div>
                            <div class="job-listing-description">
                                <h4 class="job-listing-company">{{ $listing->company }}</h4>
                                <h3 class="job-listing-title">{{ $listing->title }}</h3>
                            </div>
                        </div>
                        <div class="job-listing-footer">
                            <ul>
                                <li><i class="icon-material-outline-location-on"></i> {{ $listing->location }}</li>
                                <li><i class="icon-feather-star"></i> {{ $listing->reviews->avg('rating') ?? 'No Rating' }}/5</li>
                                <li><i class="icon-line-awesome-comments-o"></i> {{ $listing->reviews->count() }} Reviews</li>
                                <li><i class="icon-material-outline-access-time"></i> {{ $listing->created_at->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </a>
                @empty
                    <p>No listings found.</p>
                @endforelse
            </div>

            <div class="clearfix"></div>

            <!-- Pagination -->
            <div class="row">
				<div class="col-md-12">
					<div class="pagination-container margin-top-30 margin-bottom-60">
						{{ $listings->appends(request()->query())->links('pagination::bootstrap-4') }}
					</div>
				</div>
			</div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			// Trigger form submit on change of any filter
			$('#filterForm select, #filterForm input[type="checkbox"]').on('change', function() {
				$('#filterForm').submit();
			});

			// Optional: Auto-submit on location change if desired
			$('#autocomplete-input').on('change', function() {
				$('#filterForm').submit();
			});
		});
	</script>
@endpush