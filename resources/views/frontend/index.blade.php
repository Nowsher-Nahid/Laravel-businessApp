@extends('layouts/frontend-layout')
@section('title', 'Aim Direct | Home')
@section('content')

   <div class="intro-banner" data-background-image="{{ asset('assets/images/home-background.jpg') }}">
      <div class="container">
         <!-- Intro Headline -->
         <div class="row">
            <div class="col-md-12">
               <div class="banner-headline">
                  <h3>
                     <strong>Lorem ipsum dolor sit amet consectetur elit.</strong>
                     <br>
                     <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius voluptatum laboriosam.</span>
                  </h3>
               </div>
            </div>
         </div>
         <!-- Search Bar -->
         <div class="row">
            <div class="col-md-12">
               <form action="{{ route('business-listings.index') }}" method="get">
                  <div class="intro-banner-search-form margin-top-95">
                      <div class="intro-search-field">
                          <input id="intro-keywords" type="text" name="company" placeholder="Enter Company">
                      </div>
                      <div class="intro-search-field with-autocomplete">
                          <select class="selectpicker" name="category">
                              <option value="">Select Category</option>
                              @foreach ($all_categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->title }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="intro-search-field with-autocomplete">
                        <select class="selectpicker" name="rating">
                            <option value="">Select Rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                      <div class="intro-search-button">
                          <button type="submit" class="button ripple-effect">Search</button>
                      </div>
                  </div>
              </form>
            </div>
         </div>
         <!-- Stats -->
         <div class="row">
            <div class="col-md-12">
               <ul class="intro-stats margin-top-45 hide-under-992px">
                  <li>
                     <strong class="counter">{{ $total_listings }}</strong>
                     <span>Listings Created</span>
                  </li>
                  <li>
                     <strong class="counter">{{ $total_business_owners }}</strong>
                     <span>Business Owners</span>
                  </li>
                  <li>
                     <strong class="counter">{{ $total_users }}</strong>
                     <span>Enlisted Customers</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>

   <div class="section margin-top-65">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="section-headline centered margin-bottom-15">
                  <h3>Popular Listing Categories</h3>
               </div>
               <!-- Category Boxes Container -->
               <div class="categories-container">

                  @foreach ($categories as $category)
                     <a href="jobs-grid-layout-full-page.html" class="category-box">
                        <div class="category-box-icon">
                           <i class="icon-line-awesome-file-code-o"></i>
                        </div>
                        <div class="category-box-counter">612</div>
                        <div class="category-box-content">
                           <h3>Web & Software Dev</h3>
                        </div>
                     </a>
                  @endforeach
                  
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline margin-top-0 margin-bottom-35">
                    <h3>Trending Listings</h3>
                     @auth
								@if (App\Models\Listing::where('user_id', auth()->id())->exists() || Auth::user()->role === 0)
                           <a href="{{ route('business-listings.index') }}" class="headline-link">Browse All Listings</a>
								@endif
							@endauth
                </div>

                <!-- Listings Container -->
                <div class="listings-container compact-list-layout margin-top-35">
                    @foreach($listings as $listing)
                    <!-- Business Listing -->
                    <a href="{{ route('business-listing-details.index', $listing->id) }}" class="job-listing with-apply-button">
                        <!-- Business Listing Details -->
                        <div class="job-listing-details">
                            <!-- Logo -->
                            <div class="job-listing-company-logo">
                                <img src="{{ asset($listing->ft_image) }}" alt="">
                            </div>
                            <!-- Details -->
                            <div class="job-listing-description">
                                <h3 class="job-listing-title">{{ $listing->title }}</h3>
                                <!-- Business Listing Footer -->
                                <div class="job-listing-footer">
                                    <ul>
                                        <li><i class="icon-material-outline-business"></i> {{ $listing->company }}</li>
                                        <li><i class="icon-material-outline-location-on"></i> {{ $listing->city }}</li>
                                        <li><i class="icon-material-outline-access-time"></i> {{ $listing->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Apply Button -->
                            <span class="list-apply-button ripple-effect">See Details</span>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- Listings Container / End -->
            </div>
        </div>
    </div>
</div>


   <div class="section padding-top-65 padding-bottom-65">
      <div class="container">
         <div class="row">

            <div class="col-xl-12">
               <!-- Section Headline -->
               <div class="section-headline centered margin-top-0 margin-bottom-5">
                  <h3>How It Works?</h3>
               </div>
            </div>
            
            <div class="col-xl-4 col-md-4">
               <!-- Icon Box -->
               <div class="icon-box with-line">
                  <!-- Icon -->
                  <div class="icon-box-circle">
                     <div class="icon-box-circle-inner">
                        <i class="icon-line-awesome-hand-o-up"></i>
                        <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                     </div>
                  </div>
                  <h3>Choose a Category</h3>
                  <p>Bring to the table win-win survival strategies to ensure proactive domination going forward.</p>
               </div>
            </div>

            <div class="col-xl-4 col-md-4">
               <!-- Icon Box -->
               <div class="icon-box with-line">
                  <!-- Icon -->
                  <div class="icon-box-circle">
                     <div class="icon-box-circle-inner">
                        <i class="icon-line-awesome-search-plus"></i>
                        <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                     </div>
                  </div>
                  <h3>Find What You Want</h3>
                  <p>Efficiently unleash cross-media information without. Quickly maximize return on investment.</p>
               </div>
            </div>

            <div class="col-xl-4 col-md-4">
               <!-- Icon Box -->
               <div class="icon-box">
                  <!-- Icon -->
                  <div class="icon-box-circle">
                     <div class="icon-box-circle-inner">
                        <i class=" icon-line-awesome-trophy"></i>
                        <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                     </div>
                  </div>
                  <h3>Go Out & Explore</h3>
                  <p>Nanotechnology immersion along the information highway will close the loop on focusing solely.</p>
               </div>
            </div>

         </div>
      </div>
   </div>

@endsection