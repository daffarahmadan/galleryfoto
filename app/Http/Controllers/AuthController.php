<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function album()
    {
        return $this->hasMany(Album::class, 'userid'); // Sesuaikan kunci luar di sini
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    
    public function loginIndex() {
        return view("Auth.login");
    }

    public function registerIndex() {
        return view("Auth.register");
    }

    public function register(Request $request) {
        $userRequest = $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'namalengkap'=>'required',
            'alamat'=>'required',
            'password'=>'required'
        ],[
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required'=>'Email harus diisi',
            'namalengkap.required'=>'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'password.required'=>'Password harus diisi'
        ]);
        
        User::create([
            'name'=> $request->name,
            'username'=> $request->username,
            'namalengkap'=> $request->namalengkap,
            'alamat'=> $request->alamat,
            'email'=> $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->route('dashboard')->with('success','Berhasil Register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success','Login sukses');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','Berhasil Logout');
    }


}

