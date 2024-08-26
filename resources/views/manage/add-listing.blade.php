@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Add Listing')
@section('content')

		<div class="dashboard-headline">
			<h3>Add a Listing</h3>
			<nav id="breadcrumbs" class="dark">
				<ul>
					@if (App\Models\Listing::where('user_id', auth()->id())->exists() || Auth::user()->role === 0)
						<li><a href="{{ route('listing.index') }}">Listing List</a></li>
					@endif
					<li>Add Listing</li>
				</ul>
			</nav>
		</div>
	<form action="{{ route('listing.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row add-listing">
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
										<option value="">Select Country</option>
										@foreach ($countries as $country)
											<option value="{{ $country->id }}">{{ $country->name }}</option>
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
										<option value="">Select State</option>
										<option value="" disabled>No Country Selected</option>
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
										<option value="">Select City</option>
										<option value="" disabled>No State Selected</option>
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
											<input id="autocomplete-input" class="with-border" type="text" placeholder="Type Address" name="location" required>
										</div>
										<i class="icon-material-outline-location-on"></i>
									</div>
									@if ($errors->has('location'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('location') }}</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Category</h5>
									<select class="with-border category" name="category_id" required>
										<option value="">Select Category</option>
										@foreach ($categories as $category)
											<option value="{{ $category->id }}">{{ $category->title }}</option>
										@endforeach
									</select>
									@if ($errors->has('category_id'))
										<p class="text-danger mb-0 mt-1">Category field is required.</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Sub-category</h5>
									<select class="with-border sub-category" name="sub_category_id" required>
										<option value="">Select Sub-category</option>
									</select>
									@if ($errors->has('sub_category_id'))
										<p class="text-danger mb-0 mt-1">Sub-category field is required.</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Company Name</h5>
									<input type="text" class="with-border" name="company" required>
									@if ($errors->has('company'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('company') }}</p>
									@endif
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>Phone Number</h5>
									<input type="text" class="with-border" name="phone" required>
									@if ($errors->has('phone'))
										<p class="text-danger mb-0 mt-1">{{ $errors->first('phone') }}</p>
									@endif
								</div>
							</div>
							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Services</h5>
									<textarea cols="30" rows="5" class="with-border" name="services"></textarea>
								</div>
							</div>
							<div class="col-xl-12">
    							<div class="content p-0 with-padding submit-field">
            						<h5>Business Gallery Images</h5>
            						<div class="uploadButtonGallery">
            							<input class="uploadButton-input-gallery" name="gallery[]" type="file" accept="image/*" id="upload-gallery" multiple/>
            							<label class="uploadButton-button-gallery ripple-effect" for="upload-gallery">Upload Images</label>
            							<span class="uploadButton-file-name-gallery">Upload gallery images</span>
            						</div>
            					</div>
        					</div>
							<div class="col-xl-12">
    							<div class="content p-0 with-padding submit-field">
            						<h5>Business Logo</h5>
            						<div class="uploadButton">
            							<input class="uploadButton-input" name="ft_image" type="file" accept="image/*" id="upload"/>
            							<label class="uploadButton-button ripple-effect" for="upload">Upload Image</label>
            							<span class="uploadButton-file-name">Upload business logo</span>
            						</div>
            					</div>
        					</div>
        					
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				<button type="submit" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Save Listing</button>
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