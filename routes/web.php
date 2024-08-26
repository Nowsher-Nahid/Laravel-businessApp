<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\BusinessOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VerificationController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Middleware\UserLocation;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/verify', [VerificationController::class, 'showVerificationForm']);
Route::post('/verify/select', [VerificationController::class, 'selectVerificationMethod'])->name('verification.select');
Route::get('/verify/email', [VerificationController::class, 'sendEmailVerification'])->name('verification.email');
Route::get('/verify-email/{id}/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');
Route::get('/email-send-message', [VerificationController::class, 'verifyEmailPage']);


// Route::get('/verify/phone', [VerificationController::class, 'showPhoneVerificationForm'])->name('verification.phone');
// Route::post('/verify/phone', [VerificationController::class, 'verifyPhone'])->name('verification.phone.submit');


// Socialite routes
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);


// Frontend routes
// Route::middleware(UserLocation::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/business-listings', [BusinessController::class, 'index'])->name('business-listings.index');
    Route::get('/business-listing-details/{id}', [BusinessController::class, 'listingDetails'])->name('business-listing-details.index');
// });
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::get('/subscription', [HomeController::class, 'subscription'])->name('subscription');



Route::prefix('manage')->middleware('auth')->group(function (){
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('manage')->middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Category
    Route::get('/category-list', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Sub-category
    Route::get('/sub-category-list', [SubCategoryController::class, 'index'])->name('sub_category.index');
    Route::get('/add-sub-category', [SubCategoryController::class, 'create'])->name('sub_category.create');
    Route::post('/add-sub-category', [SubCategoryController::class, 'store'])->name('sub_category.store');
    Route::get('/edit-sub-category/{id}', [SubCategoryController::class, 'edit'])->name('sub_category.edit');
    Route::post('/update-sub-category/{id}', [SubCategoryController::class, 'update'])->name('sub_category.update');
    Route::delete('/delete-sub-category/{id}', [SubCategoryController::class, 'destroy'])->name('sub_category.destroy');
    // Business listing
    Route::get('/add-listing', [ListingController::class, 'create'])->name('listing.create');
    Route::post('/add-listing', [ListingController::class, 'store'])->name('listing.store');
    Route::get('/listing-list', [ListingController::class, 'index'])->name('listing.index');
    Route::get('/edit-listing/{id}', [ListingController::class, 'edit'])->name('listing.edit');
    Route::post('/update-listing/{id}', [ListingController::class, 'update'])->name('listing.update');
    Route::delete('/delete-listing/{id}', [ListingController::class, 'destroy'])->name('listing.destroy');
    Route::get('/fetch-states', [ListingController::class, 'fetchStates'])->name('fetchStates');
    Route::get('/fetch-cities', [ListingController::class, 'fetchCities'])->name('fetchCities');
    Route::get('/fetch-sub-categories', [ListingController::class, 'fetchSubCategories'])->name('fetchSubCategories');
    // Business Owner
    Route::get('/owner-list', [BusinessOwnerController::class, 'index'])->name('owner.index');
    // Route::get('/add-owner', [BusinessOwnerController::class, 'create'])->name('owner.create');
    // Route::post('/add-owner', [BusinessOwnerController::class, 'store'])->name('owner.store');
    // Route::get('/edit-owner', [BusinessOwnerController::class, 'edit'])->name('owner.edit');
    // Route::post('/edit-owner', [BusinessOwnerController::class, 'update'])->name('owner.update');
    Route::delete('/delete-owner/{id}', [BusinessOwnerController::class, 'destroy'])->name('owner.destroy');
    // Customer
    Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer.index');
    // Route::get('/add-customer', [CustomerController::class, 'create'])->name('customer.create');
    // Route::post('/add-customer', [CustomerController::class, 'store'])->name('customer.store');
    // Route::get('/edit-customer', [CustomerController::class, 'edit'])->name('customer.edit');
    // Route::post('/edit-customer', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});


require __DIR__.'/auth.php';
