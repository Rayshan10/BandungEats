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
        $user = $request->user();

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Ganti Password (opsional)
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            $request->validate([

                'current_password' => [
                    'required',
                    'current_password',
                ],

                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                ],

            ]);

            $validated['password'] = Hash::make(
                $request->password
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')
                    ->delete($user->profile_photo);
            }

            $validated['profile_photo'] =

                $request
                    ->file('profile_photo')
                    ->store('profile-photos','public');
        }

        unset($validated['current_password']);

        $user->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui.',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'photo' => $user->profile_photo
                        ? asset('storage/'.$user->profile_photo)
                        : asset('assets/img/default-profile.png'),
                ]
            ]);
        }

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}