<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Lakukan validasi data yang dikirimkan
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'namalengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update informasi profil pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->namalengkap = $request->namalengkap;
        $user->alamat = $request->alamat;
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->hasFile('avatar')) {
            // Hapus avatar sebelumnya jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Upload dan simpan gambar profil baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
