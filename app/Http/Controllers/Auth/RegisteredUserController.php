<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse{
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'phone' => ['required', 'string', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'email_verified_at' => null,
    //         'phone_verified_at' => null,
    //     ]);

    //     event(new Registered($user));
    //     Auth::login($user);
    //     return redirect(route('verification.page', absolute: false));
    // }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
            'phone_verified_at' => null,
        ]);

        Auth::login($user);
        Mail::to($user->email)->send(new EmailVerification($user));
        return redirect('/email-send-message');

        // $user->sendEmailVerificationNotification();
        // return redirect()->route('verification.notice');
    }

    // Add this method to RegisteredUserController
    // public function verifyPhone(Request $request)
    // {
    //     $request->validate([
    //         'code' => ['required', 'string', 'size:6'],
    //     ]);

    //     $code = $request->input('code');
    //     if ($code == session('verification_code')) {
    //         $user = User::find(session('user_id'));
    //         $user->phone_verified_at = now();
    //         $user->save();
    //         Session::forget(['verification_code', 'user_id']);
    //         return redirect()->route('dashboard')->with('status', 'Phone verified!');
    //     } else {
    //         return redirect()->back()->withErrors(['code' => 'Invalid verification code']);
    //     }
    // }

    
}
