@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Edit Sub-category')
@section('content')

	<div class="dashboard-headline">
		<h3>Edit a Sub-category</h3>
		<nav id="breadcrumbs" class="dark">
			<ul>
				<li><a href="{{ route('sub_category.index') }}">Sub-category List</a></li>
				<li>Edit Sub-category</li>
			</ul>
		</nav>
	</div>

	<form action="{{ route('sub_category.update', $sub_category->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row edit-sub-category">
			<div class="col-xl-6">
				<div class="dashboard-box margin-top-0">
					<div class="headline">
						<h3><i class="icon-feather-folder-plus"></i> Sub-category Form</h3>
					</div>
                    <div class="content with-padding padding-bottom-10">
                        <div class="submit-field">
                            <h5>Category</h5>
                            <select class="with-border" data-size="7" name="category_id" required>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ $category->id == $sub_category->category_id ? 'selected' : '' }}>
										{{ $category->title }}
									</option>
                            	@endforeach
                            </select>
							@if ($errors->has('category_id'))
								<p class="text-danger mb-0 mt-1">Category field is required</p>
							@endif
                        </div>
                        <div class="submit-field">
                            <h5>Sub-Category</h5>
                            <input type="text" class="with-border" name="title" value="{{ $sub_category->title }}" required>
							@if ($errors->has('title'))
								<p class="text-danger mb-0 mt-1">{{ $errors->first('title') }}</p>
							@endif
                        </div>
                    </div>
				</div>
			</div>

			<div class="col-xl-12">
				<button class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Update Sub-category</button>
			</div>

		</div>
	</form>

@endsection