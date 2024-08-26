<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller {

    public function index(){
        $total_listings = Listing::count();
        $total_reviews = Review::count();
        $total_users = User::count()-1;
        $admin_id = User::where('role', 0)->pluck('id');
        $total_business_owners = Listing::whereNotIn('user_id', $admin_id)->distinct('user_id')->count('user_id');
        return view('manage.dashboard', compact('total_listings','total_reviews','total_users','total_business_owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
