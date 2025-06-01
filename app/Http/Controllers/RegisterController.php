<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_telp' => 'required|string|max:20',
            'user_email' => 'required|string|email|unique:pengguna,user_email',
            'user_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Pengguna::create([
            'user_name' => $request->user_name,
            'user_telp' => $request->user_telp,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'role' => 'user',
            // 'user_id' => '',
        ]);

        // $user->user_id = 'U' . $user->id;
        // $user->save();

        return redirect('/login')->with('success', 'Pendaftaran berhasil!');
    }
}
