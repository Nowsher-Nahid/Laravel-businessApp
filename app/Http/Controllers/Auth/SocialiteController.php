<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Carbon\Carbon;

// class SocialiteController extends Controller
// {
//     public function redirectToProvider($provider)
//     {
//         return Socialite::driver($provider)->redirect();
//     }

//     public function handleProviderCallback($provider)
//     {
//         try {
//             $socialUser = Socialite::driver($provider)->user();
//             $user = User::where('email', $socialUser->getEmail())
//                         ->orWhere($provider . '_id', $socialUser->getId())
//                         ->first();

//             if ($user) {
//                 $user->update([$provider . '_id' => $socialUser->getId()]);
//                 Auth::login($user);
//             } else {
//                 $user = User::create([
//                     'name' => $socialUser->getName(),
//                     'email' => $socialUser->getEmail(),
//                     $provider . '_id' => $socialUser->getId(),
//                     'password' => encrypt('social-login'),
//                 ]);
//                 Auth::login($user);
//             }

//             return redirect()->intended('home');
//         } catch (Exception $e) {
//             return redirect('login');
//         }
//     }
// }


class SocialiteController extends Controller {
    
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        return $this->loginOrRegister($user, 'google');
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        return $this->loginOrRegister($user, 'facebook');
    }

    private function loginOrRegister($socialUser, $provider){
        // Check if the user exists by email
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update social ID for the existing user
            if ($provider === 'google') {
                $user->google_id = $socialUser->getId();
            } elseif ($provider === 'facebook') {
                $user->facebook_id = $socialUser->getId();
            }
            $user->save();
        } else {
            // Create a new user if not exists
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(uniqid()), // Use a placeholder password for social logins
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                $provider . '_id' => $socialUser->getId(),
            ]);
        }

        Auth::login($user);

        return redirect()->intended('/');
    }
}


