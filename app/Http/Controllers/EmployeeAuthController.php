<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class EmployeeAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'patId'    => 'required',
            'password' => 'required',
        ]);

        $loginInput = $request->patId;
        $password   = $request->password;
        $remember   = $request->has('remember_me');

        $credentials = [
            ['patId' => $loginInput],
            ['employee_email' => $loginInput],
            ['employee_mobile' => $loginInput],
        ];

        foreach ($credentials as $field) {
            if (Auth::guard('employee')->attempt(
                array_merge($field, ['password' => $password]),
                $remember
            )) {

                $employee = Auth::guard('employee')->user();

                if ($remember) {
                    Cookie::queue(Cookie::make('employee_login_id', $loginInput, 60 * 24 * 30));
                    Cookie::queue(Cookie::make('employee_password', encrypt($password), 60 * 24 * 30));
                } else {
                    Cookie::queue(Cookie::forget('employee_login_id'));
                    Cookie::queue(Cookie::forget('employee_password'));
                }

                return redirect()->route('employee.dashboard')
                    ->with('success', 'Welcome back, ' . $employee->employee_name . '!');
            }
        }

        return back()->with('error', 'Invalid credentials')->withInput();
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

        return redirect('/employee/login')->with('success', 'Logged out successfully.');
    }
}
