@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Add Business Owner')
@section('content')

	<div class="dashboard-headline">
		<h3>Add a Business Owner</h3>
		<nav id="breadcrumbs" class="dark">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Dashboard</a></li>
				<li>Add Business Owner</li>
			</ul>
		</nav>
	</div>

	<form action="">
		@csrf
		<div class="row">
			<div class="col-xl-6">
				<div class="dashboard-box margin-top-0">
					<div class="headline">
						<h3><i class="icon-feather-folder-plus"></i> Business Owner Form</h3>
					</div>
                    <div class="content with-padding padding-bottom-10">
                        <div class="submit-field">
                            <h5>Name</h5>
                            <input type="text" class="with-border" name="title" name="name" required>
                        </div>
                        <div class="submit-field">
                            <h5>Email</h5>
                            <input type="email" class="with-border" name="title" name="email" required>
                        </div>
                        <div class="submit-field">
                            <h5>Phone Number</h5>
                            <input type="text" class="with-border" name="title" name="phone" required>
                        </div>
                        <div class="submit-field">
                            <h5>Password</h5>
                            <input type="password" class="with-border" name="title" name="password" required>
                        </div>
                    </div>
				</div>
			</div>

			<div class="col-xl-12">
				<a href="#" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Save Owner</a>
			</div>

		</div>
	</form>

@endsection