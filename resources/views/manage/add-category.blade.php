@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Add Category')
@section('content')

	<div class="dashboard-headline">
		<h3>Add a Category</h3>
		<nav id="breadcrumbs" class="dark">
			<ul>
				<li><a href="{{ route('category.index') }}">Category List</a></li>
				<li>Add Category</li>
			</ul>
		</nav>
	</div>

	<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-xl-6">
				<div class="dashboard-box margin-top-0">
					<div class="headline">
						<h3><i class="icon-feather-folder-plus"></i> Category Form</h3>
					</div>
					<div class="content with-padding pb-0">
						<div class="submit-field">
							<h5>Category Title</h5>
							<input type="text" class="with-border" name="title" required>
							@if ($errors->has('title'))
								<p class="text-danger mb-0 mt-1">{{ $errors->first('title') }}</p>
							@endif
						</div>
					</div>
					<div class="content pt-0 with-padding submit-field">
						<h5>Category Image</h5>
						<div class="uploadButton">
							<input class="uploadButton-input" name="image" type="file" accept="image/*" id="upload">
							<label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
							<span class="uploadButton-file-name">Upload category image</span>
							@if ($errors->has('image'))
								<p class="text-danger mb-0 mt-1">{{ $errors->first('image') }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-12">
				<button type="submit" class="button ripple-effect big"><i class="icon-feather-plus"></i> Save Category</button>
			</div>

		</div>
	</form>

@endsection