<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AuthModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function PageLogin()
    {
        return view('Login');
    }

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = AuthModel::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika berhasil, simpan data user ke dalam session
            Auth::login($user);

            return redirect('dashboard')->with('success', 'Login Berhasil');
        } else {
            // return redirect()->back()->with('error', 'Username atau Password salah');
            return redirect()->back()->withErrors(['login' => 'Username atau Password salah'])->withInput();
        }
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}