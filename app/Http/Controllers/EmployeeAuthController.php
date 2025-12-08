<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        try {
            $request->validate([
                'patId'    => 'required',
                'password' => 'required',
            ]);

            $loginInput = $request->patId;
            $password   = $request->password;
            $remember   = $request->has('remember_me');

            if (Auth::guard('employee')->attempt([
                'patId' => $loginInput,
                'password' => $password
            ], $remember)) {

                $user = Auth::guard('employee')->user();
                return redirect()->route('employee.dashboard')
                    ->with('success', 'Welcome back, ' . $user->employee_name . '!');
            }

            if (Auth::guard('employee')->attempt([
                'employee_email' => $loginInput,
                'password' => $password
            ], $remember)) {

                $user = Auth::guard('employee')->user();
                return redirect()->route('employee.dashboard')
                    ->with('success', 'Welcome back, ' . $user->employee_name . '!');
            }

            if (Auth::guard('employee')->attempt([
                'employee_mobile' => $loginInput,
                'password' => $password
            ], $remember)) {

                $user = Auth::guard('employee')->user();
                return redirect()->route('employee.dashboard')
                    ->with('success', 'Welcome back, ' . $user->employee_name . '!');
            }

            return back()
                ->with('error', 'Invalid Pat ID / Email / Mobile or password.')
                ->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $message = collect($e->errors())->flatten()->first();

            return back()
                ->with('error', $message ?? 'Please fill all required fields correctly.')
                ->withInput();
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Something went wrong while logging in. Please try again.')
                ->withInput();
        }
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
