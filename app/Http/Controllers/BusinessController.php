<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
use App\Models\SubCategory;

class BusinessController extends Controller {

    public function index(Request $request)
{
    // Check if the request has any filter, otherwise apply the default country filter
    if ($request->filled('location') || $request->filled('category') || $request->filled('sub_category') || $request->filled('ratings') || $request->filled('title')) {
        $query = Listing::query(); // Start with a blank query
    } else {
        $userCountry = 'Armenia'; // Static user country
        $query = Listing::where('country', $userCountry); // Apply default country filter
    }

    // Apply filters based on the request input
    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('sub_category')) {
        $query->where('sub_category_id', $request->sub_category);
    }

    if ($request->filled('rating')) {
        $rating = $request->input('rating');
        $query->whereHas('reviews', function ($q) use ($rating) {
            $q->where('rating', $rating);
        });
    }

    if ($request->filled('ratings')) {
        // Assuming 'rating' is a column in the listings table or related model
        $query->whereHas('reviews', function ($q) use ($request) {
            $q->whereIn('rating', $request->ratings);
        });
    }

    if ($request->filled('company')) {
        $query->where('company', 'like', '%' . $request->company . '%');
    }

    // Get the filtered listings
    $listings = $query->paginate(1);

    // Append current query parameters to pagination links
    $listings->appends($request->except('page'));

    // Return to the view with filtered listings
    return view('frontend.business-listings', [
        'listings' => $listings,
        'categories' => Category::all(),
        'sub_categories' => SubCategory::all(),
    ]);
}


    public function listingDetails($id){
        $listing = Listing::with('reviews')->findOrFail($id);

        // Get the category ID of the current listing
        $categoryId = $listing->category_id;

        // Get the top 2 latest listings in the same category, excluding the current listing
        $similarListings = Listing::where('category_id', $categoryId)
                ->where('id', '<>', $id) // Exclude the current listing
                ->orderBy('created_at', 'desc') // Order by creation date, latest first
                ->take(2) // Limit to 2 listings
                ->get();

        return view('frontend.business-listing-details', compact('listing','similarListings'));
    }

}
