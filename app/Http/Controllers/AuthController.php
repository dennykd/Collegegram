<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|max:30|min:8',
            'password' => 'required|max:30|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->with('failed', 'Login was unsuccessfully');
    }

    public function regindex()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users|email:dns',
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:30|min:8',
            'password' => 'required_with:retype_password|max:30|min:8',
            'retype_password' => 'required_with:password|max:30|min:8|same:password'
        ]);

        $validatedData['email_verified_at'] = now();
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/')->with('success', 'Registration was successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
