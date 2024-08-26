@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Dashboard')
@section('content')

	<div class="dashboard-headline">
		<h3>{{ Auth::user()->name }}!</h3>
		<span>We are glad to see you again!</span>
		<nav id="breadcrumbs" class="dark">
			<ul>
				<li>Dashboard</li>
			</ul>
		</nav>
	</div>

	<div class="fun-facts-container">
		<div class="fun-fact" data-fun-fact-color="#36bd78">
			<div class="fun-fact-text">
				<span>Total Listings</span>
				<h4>{{ $total_listings }}</h4>
			</div>
			<div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
		</div>
		<div class="fun-fact" data-fun-fact-color="#b81b7f">
			<div class="fun-fact-text">
				<span>Total Business Owners</span>
				<h4>{{ $total_business_owners }}</h4>
			</div>
			<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
		</div>
		<div class="fun-fact" data-fun-fact-color="#efa80f">
			<div class="fun-fact-text">
				<span>Total Users</span>
				<h4>{{ $total_users }}</h4>
			</div>
			<div class="fun-fact-icon"><i class="icon-line-awesome-users"></i></div>
		</div>
		<div class="fun-fact" data-fun-fact-color="#2a41e6">
			<div class="fun-fact-text">
				<span>Total Reviews</span>
				<h4>{{ $total_reviews }}</h4>
			</div>
			<div class="fun-fact-icon"><i class="icon-line-awesome-comments-o"></i></div>
		</div>
	</div>

@endsection