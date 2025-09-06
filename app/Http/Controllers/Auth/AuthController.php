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
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Success message set
            $successMessage = 'Login successful. Welcome, ' . $user->name . '!';

            // Role / type ke hisaab se redirect
            switch ($user->user_type) {
                case 'super-admin':
                    return redirect('/super-admin/dashboard')->with('success', $successMessage);
                case 'admin':
                    return redirect('/admin/dashboard')->with('success', $successMessage);
                case 'hr':
                    return redirect('/hr/dashboard')->with('success', $successMessage);
                case 'employee':
                    return redirect('/employee/dashboard')->with('success', $successMessage);
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['email' => 'User type not recognized']);
            }
        }

        return back()->with('error', 'Invalid credentials.');
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
        echo "working";
        Auth::logout();
        $request->session()->invalidate(); // Session destroy
        $request->session()->regenerateToken(); // CSRF token regenerate

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
