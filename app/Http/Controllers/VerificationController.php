<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller {

    public function showVerificationForm(){
        return view('auth.verification');
    }

    public function selectVerificationMethod(Request $request){
        $method = $request->input('verification_method');
        $user = Auth::user();

        if ($method === 'email') {
            return redirect()->route('verification.email');
        } elseif ($method === 'phone') {
            return redirect()->route('verification.phone');
        }

        return back()->withErrors(['verification_method' => 'Invalid verification method selected.']);
    }

    public function sendEmailVerification(){
        $user = Auth::user();
        Mail::to($user->email)->send(new EmailVerification($user));
        return redirect()->back()->with('status', 'An email has been sent to verify your account!');
    }

    public function verifyEmailPage(){
        return view('auth.email-verify-page');
    }

    public function verifyEmail(String $id, String $token){
        // Find the user by email token or ID
        // $user = User::where('email', $request->email)->first();
        $user = User::findOrFail($id);
        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);
            return redirect()->route('home.index');
        }
        return redirect()->back()->withErrors(['email' => 'Verification failed.']);
    }



    public function showPhoneVerificationForm(){
        return view('auth.phone_verification');
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Simulate verification code check (replace with real implementation)
        $storedCode = '123456'; // This should come from the stored session or database

        if ($request->input('verification_code') === $storedCode) {
            $user->phone_verified_at = now();
            $user->save();

            return redirect()->route('home')->with('status', 'Phone number verified!');
        }

        return back()->withErrors(['verification_code' => 'Invalid verification code.']);
    }
}
