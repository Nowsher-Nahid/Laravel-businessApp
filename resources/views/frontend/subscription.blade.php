@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Subscription')
@section('content')

<div class="single-page-header" data-background-image="{{ asset('assets/images/single-job.jpg') }}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-details">
							<h1 class="text-center my-4" style="font-size: 60px; font-weight: bold;">Subscription Plans</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container margin-top-40 margin-bottom-40">
    <div class="row">
    
        <div class="col-xl-12">
            <div class="pricing-plans-container margin-top-20">
                <div class="pricing-plan">
                    <h3>Basic Plan</h3>
                    <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                    <div class="pricing-plan-label billed-monthly-label"><strong>$19</strong>/ monthly</div>
                    <div class="pricing-plan-label billed-yearly-label"><strong>$205</strong>/ yearly</div>
                    <div class="pricing-plan-features">
                        <strong>Features of Basic Plan</strong>
                        <ul>
                            <li>1 Listing</li>
                            <li>30 Days Visibility</li>
                            <li>Highlighted in Search Results</li>
                        </ul>
                    </div>
                    <a href="pages-checkout-page.html" class="button full-width margin-top-20">Buy Now</a>
                </div>
                <div class="pricing-plan recommended">
                    <div class="recommended-badge">Recommended</div>
                    <h3>Standard Plan</h3>
                    <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                    <div class="pricing-plan-label billed-monthly-label"><strong>$49</strong>/ monthly</div>
                    <div class="pricing-plan-label billed-yearly-label"><strong>$529</strong>/ yearly</div>
                    <div class="pricing-plan-features">
                        <strong>Features of Standard Plan</strong>
                        <ul>
                            <li>5 Listings</li>
                            <li>60 Days Visibility</li>
                            <li>Highlighted in Search Results</li>
                        </ul>
                    </div>
                    <a href="pages-checkout-page.html" class="button full-width margin-top-20">Buy Now</a>
                </div>
                <div class="pricing-plan">
                    <h3>Extended Plan</h3>
                    <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                    <div class="pricing-plan-label billed-monthly-label"><strong>$99</strong>/ monthly</div>
                    <div class="pricing-plan-label billed-yearly-label"><strong>$1069</strong>/ yearly</div>
                    <div class="pricing-plan-features">
                        <strong>Features of Extended Plan</strong>
                        <ul>
                            <li>Unlimited Listings Listing</li>
                            <li>90 Days Visibility</li>
                            <li>Highlighted in Search Results</li>
                        </ul>
                    </div>
                    <a href="pages-checkout-page.html" class="button full-width margin-top-20">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection