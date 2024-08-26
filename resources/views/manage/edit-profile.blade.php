@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Profile')
@section('content')

<div class="dashboard-headline">
	<h3>User Profile</h3>
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li>User Profile</li>
		</ul>
	</nav>
</div>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				<div class="headline">
					<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
				</div>
				<div class="content with-padding padding-bottom-0">
					<div class="row">
						<div class="col-auto">
							<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
								<img class="profile-pic" src="images/user-avatar-placeholder.png" alt="">
								<div class="upload-button"></div>
								<input class="file-upload" type="file" accept="image/*">
							</div>
						</div>
						<div class="col">
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Name</h5>
										<input type="text" class="with-border" name="name" value="{{ Auth::user()->name }}" required>
										@if ($errors->has('name'))
                                        	<p class="text-danger mb-0 mt-1">{{ $errors->first('name') }}</p>
                                    	@endif
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Email</h5>
										<input type="text" class="with-border" name="email" value="{{ Auth::user()->email }}" required>
										@if ($errors->has('email'))
                                        	<p class="text-danger mb-0 mt-1">{{ $errors->first('email') }}</p>
                                    	@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-12">
			<div id="test1" class="dashboard-box">
				<div class="headline">
					<h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
				</div>
				<div class="content with-padding">
					<div class="row">
						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Current Password</h5>
								<input type="password" class="with-border" name="current_password">
								@if ($errors->has('current_password'))
                                    <p class="text-danger mb-0 mt-1">{{ $errors->first('current_password') }}</p>
                                @endif
							</div>
						</div>
						<div class="col-xl-4">
							<div class="submit-field">
								<h5>New Password</h5>
								<input type="password" class="with-border" name="new_password" id="new_password">
								@if ($errors->has('new_password'))
                                    <p class="text-danger mb-0 mt-1">{{ $errors->first('new_password') }}</p>
                                @endif
							</div>
						</div>
						<div class="col-xl-4">
							<div class="submit-field">
								<h5>Repeat New Password</h5>
								<input type="password" class="with-border" name="repeat_new_password" id="repeat_new_password">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-xl-12">
			<button type="submit" class="button ripple-effect big margin-top-30">Save Changes</button>
		</div>

	</div>

</form>

@endsection

@push('scripts')

<script>
	@if (session('error'))
		Swal.fire({
			title: 'Error!',
			text: "{{ session('error') }}",
			icon: 'error',
			confirmButtonText: 'Ok'
		})
  	@endif
</script>	
	
@endpush