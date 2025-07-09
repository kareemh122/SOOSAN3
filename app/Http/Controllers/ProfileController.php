<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($user->image_url && Storage::disk('public')->exists($user->image_url)) {
                Storage::disk('public')->delete($user->image_url);
            }

            // Store new image
            $image = $request->file('profile_image');
            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile_images', $imageName, 'public');
            $validatedData['image_url'] = $imagePath;
        }

        // Fill user with validated data
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
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

    /**
     * Update the user's password securely.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        // Check current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        // Prevent using the same password
        if (Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'The new password must be different from the current password.'])->withInput();
        }

        // Update password
        $user->password = $request->input('password');
        $user->save();

        return back()->with('status', 'password-updated');
    }

    /**
     * AJAX endpoint to check if the given password matches the authenticated user's password.
     */
    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = $request->user();
        if (\Hash::check($request->input('password'), $user->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false, 'message' => 'Incorrect password'], 200);
        }
    }

    /**
     * Remove the user's profile image.
     */
    public function removeImage(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Delete image file if it exists
        if ($user->image_url && Storage::disk('public')->exists($user->image_url)) {
            Storage::disk('public')->delete($user->image_url);
        }
        
        // Remove image URL from database
        $user->image_url = null;
        $user->save();
        
        return Redirect::route('profile.edit')->with('status', 'image-removed');
    }
}
