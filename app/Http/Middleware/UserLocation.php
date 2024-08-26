<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;

class UserLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        //  // Get the user's IP address
        //  $ip = $request->ip();

        //  // Get the location data
        //  $location = Location::get($ip);
 
        //  // Set default location data in case the location is not available
        //  $country = $location ? $location->countryName : 'Unknown';
        //  $countryCode = $location ? $location->countryCode : 'Unknown';
 
        //  // Share location data with all views
        //  View::share('userCountry', $country);
        //  View::share('userCountryCode', $countryCode);

        // return $next($request);
    }
}
