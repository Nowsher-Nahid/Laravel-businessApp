@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Edit Listing')
@section('content')

		<div class="dashboard-headline">
			<h3>Edit a Listing</h3>
			<nav id="breadcrumbs" class="dark">
				<ul>
					<li><a href="{{ route('listing.index') }}">Business Listings</a></li>
					<li>Edit Listing</li>
				</ul>
			</nav>
		</div>
		<form action="{{ route('listing.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row edit-listing">
			<div class="col-xl-12">
				<div class="dashboard-box margin-top-0">
					<div class="headline">
						<h3><i class="icon-feather-folder-plus"></i> Listing Form</h3>
					</div>
					<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Country</h5>
									<select class="with-border country" name="country" required>
										<option value="{{ $country_id->id }}">{{ $listing->country }}</option>
										@foreach ($countries as $country)
											@if ($country->id !== $country_id->id)
												<option value="{{ $country->id }}">{{ $country->name }}</option>
											@endif
										@endforeach
									</select>
									@if ($errors->has('country'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('country') }}</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>State</h5>
									<select class="with-border state" name="state" required>
										<option value="{{ $state_id->id }}">{{ $listing->state }}</option>
										@foreach ($states as $state)
											@if ($state->name !== $listing->state)
												<option value="{{ $state->id }}">{{ $state->name }}</option>
											@endif
										@endforeach
									</select>
									@if ($errors->has('state'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('state') }}</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>City</h5>
									<select class="with-border city" name="city" required>
										<option value="{{ $listing->city }}">{{ $listing->city }}</option>
										@foreach ($cities as $city)
											@if ($city->city !== $listing->city)
												<option value="{{ $city->city }}">{{ $city->city }}</option>
											@endif
										@endforeach
									</select>
									@if ($errors->has('city'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('city') }}</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Location</h5>
									<div class="input-with-icon">
										<div id="autocomplete-container">
											<input id="autocomplete-input" class="with-border" type="text" name="location" value="{{ $listing->location }}" required>
										</div>
										<i class="icon-material-outline-location-on"></i>
									</div>
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Category</h5>
									<select class="with-border category" name="category_id" required>
										<option value="{{ $listing->category_id }}">{{ $listing->category->title }}</option>
										@foreach ($categories as $category)
											@if ($category->id !== $listing->category_id)
												<option value="{{ $category->id }}">{{ $category->title }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Sub-category</h5>
									<select class="with-border sub-category" name="sub_category_id" required>
										<option value="{{ $listing->sub_category_id }}">{{ $listing->subCategory->title }}</option>
										@foreach ($sub_categories as $sub_category)
											@if ($sub_category->id !== $listing->sub_category_id)
												<option value="{{ $sub_category->id }}">{{ $sub_category->title }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Company Name</h5>
									<input type="text" class="with-border" name="company" value="{{ $listing->company }}" required>
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Phone Number</h5>
									<input type="text" class="with-border" name="phone" value="{{ $listing->phone }}" required>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Services</h5>
									<textarea cols="30" rows="5" class="with-border" name="services" required>{{ $listing->services }}</textarea>
								</div>
							</div>
							<div class="col-xl-12 d-flex">
    							<div class="content p-0 with-padding submit-field">
            						<h5>Business Gallery Images</h5>
            						<div class="uploadButtonGallery">
            							<input class="uploadButton-input-gallery" name="gallery[]" type="file" accept="image/*" id="upload-gallery" multiple/>
            							<label class="uploadButton-button-gallery ripple-effect" for="upload-gallery">Upload Images</label>
            							<span class="uploadButton-file-name-gallery">Upload gallery images</span>
            						</div>
            					</div>
								<div>
									@php
										$gallery_images = $listing->gallery;
										if($gallery_images){
											$get_gallery_images = json_decode($listing->gallery);
										}
									@endphp
									@if ($gallery_images)
										@foreach ($get_gallery_images as $image)
											<img src="{{ asset($image) }}" alt="{{ $listing->title }}" width="120" class="ms-3">
										@endforeach
									@endif
								</div>
        					</div>
							<div class="col-xl-12 d-flex">
    							<div class="content p-0 with-padding submit-field">
            						<h5>Business Logo</h5>
            						<div class="uploadButton">
            							<input class="uploadButton-input" name="ft_image" type="file" accept="image/*" id="upload"/>
            							<label class="uploadButton-button ripple-effect" for="upload">Upload Image</label>
            							<span class="uploadButton-file-name">Upload business logo</span>
            						</div>
            					</div>
								<div>
									@if ($listing->ft_image)
										<img src="{{ asset($listing->ft_image) }}" alt="{{ $listing->title }}" width="80" class="ms-3">
									@endif
								</div>
        					</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				<button type="submit" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Update Listing</button>
			</div>
		</div>
	</form>

@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$('.country').change(function() {
				var countryID = $(this).val();
				if (countryID) {
					$.ajax({
						url: '{{ route("fetchStates") }}',
						type: 'GET',
						data: { country_id: countryID },
						success: function(data) {
							$('.state').html(data);
						}
					});
				}
			});
			$('.state').change(function() {
				var stateID = $(this).val();
				if (stateID) {
					$.ajax({
						url: '{{ route("fetchCities") }}',
						type: 'GET',
						data: { state_id: stateID },
						success: function(data) {
							$('.city').html(data);
						}
					});
				}
			});
			$('.category').change(function() {
				var category_id = $(this).val();
				if (category_id) {
					$.ajax({
						url: '{{ route("fetchSubCategories") }}',
						type: 'GET',
						data: { category_id: category_id },
						success: function(data) {
							$('.sub-category').html(data);
						}
					});
				}
			});
		});
	</script>
@endpush