<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request){
        // Get the user's IP address
        $ip = $request->ip();

        // Get the location data
        // $location = Location::get($ip);
        $location = Location::get($ip);

        // Set default location data in case the location is not available
        // $userCountry = $location ? $location->countryName : 'Unknown';
        $userCountryCode = $location ? $location->countryCode : 'Unknown';

        $userCountry = 'Armenia';

        $listings = Listing::where('country', $userCountry)
                    ->with('reviews')
                    ->get()
                    ->sortByDesc(function($listing) {
                        return $listing->averageRating();
                    })
                    ->take(5);

        $latestCategoriesWithMaxRatings = Review::select('listings.category_id', DB::raw('AVG(reviews.rating) as avg_rating'))
                    ->join('listings', 'reviews.listing_id', '=', 'listings.id')
                    ->groupBy('listings.category_id')
                    ->orderByDesc('avg_rating')
                    ->latest('reviews.created_at')
                    ->take(8)
                    ->pluck('listings.category_id');
    
        // Get the category details
        $categories = Category::whereIn('id', $latestCategoriesWithMaxRatings)->get();

        $total_listings = Listing::count();
        $total_users = User::count()-1;
        $admin_id = User::where('role', 0)->pluck('id');
        $total_business_owners = Listing::whereNotIn('user_id', $admin_id)->distinct('user_id')->count('user_id');

        $all_categories = Category::all();
        return view('frontend.index', compact('listings','categories','total_listings','total_users','total_business_owners','all_categories'));
    }

    public function aboutUs(){
        return view('frontend.about-us');
    }

    public function contactUs(){
        return view('frontend.contact-us');
    }

    public function subscription(){
        return view('frontend.subscription');
    }

}
