<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login', ['title' => 'Login Page']);
    }

    public function login(Request $request)
    {
        $user = User::where('user_email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->user_password)) {
            // session([
            //     'user_id' => $user->user_id,
            //     'user_name' => $user->user_name,
            //     'role' => $user->role
            // ]);

            Auth::login($user); 
            $request->session()->regenerate(); 

            if ($user->role === 'superadmin' || $user->role === 'admin') {
                return redirect('/admin')->with('success', 'Login berhasil sebagai ' . ucfirst($user->role));
            } else {
                return redirect('/')->with('success', 'Login berhasil sebagai User');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
