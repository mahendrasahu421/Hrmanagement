<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember_me');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->with('error', 'Invalid credentials.');
        }

        $user = Auth::user();

        // Admin & HR go to the same home/dashboard
        if (in_array($user->role_id, [2, 3])) { // 2=Admin, 3=HR
            return redirect()->route('home')->with('success', 'Login successful. Welcome, ' . $user->name . '!');
        }

        // Other roles (optional)
        switch ($user->role_id) {
            case 1: // Super Admin
                return redirect('/super-admin/dashboard')->with('success', 'Welcome, ' . $user->name);
            case 4: // Employee
                return redirect('/employee/dashboard')->with('success', 'Welcome, ' . $user->name);
            default:
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'User type not recognized.']);
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate(); // Session destroy
        $request->session()->regenerateToken(); // CSRF token regenerate

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
