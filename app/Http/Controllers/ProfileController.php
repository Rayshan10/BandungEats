<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit-profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // max 2MB
        ];

        // Add password validation only if password is being updated
        if ($request->filled('current_password')) {
            $rules += [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }

        $validated = $request->validate($rules);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle password update
        if ($request->filled('current_password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle profile photo
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}