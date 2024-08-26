<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function edit(Request $request): View{
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
        return view('manage.edit-profile');
    }

    // public function update(ProfileUpdateRequest $request): RedirectResponse{
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();
    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request){
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8',
        ]);

        // Update name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('image')) {
            $profilePicture = $request->file('image');
            $profilePictureName = time() . '_' . $profilePicture->getClientOriginalName();
            $profilePicture->move(public_path('assets/images/profile-pictures'), $profilePictureName);
            $profilePicturePath = 'assets/images/profile-pictures/' . $profilePictureName;
            $user->image = $profilePicturePath;
        }

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password') && $request->filled('repeat_new_password')) {
            if($request->input('new_password') === $request->input('repeat_new_password')){
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = Hash::make($request->input('new_password'));
                } else {
                    return redirect()->back()->with('error', 'Current password does not match.');
                }
            }else{
                return redirect()->back()->with('error', 'New password does not match with repeat password.');
            }
        }

        // Save the updated user information
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
