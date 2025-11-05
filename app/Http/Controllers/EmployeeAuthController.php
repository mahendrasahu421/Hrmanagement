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
            // Step 1: Validate form input
            $request->validate([
                'patId' => 'required',
                'password' => 'required',
            ]);

            $credentials = [
                'patId' => $request->patId,
                'password' => $request->password,
            ];

            $remember = $request->has('remember_me');

            // Step 2: Attempt login using custom guard
            if (Auth::guard('employee')->attempt($credentials, $remember)) {
                $user = Auth::guard('employee')->user();

                return redirect()
                    ->route('employee.dashboard')
                    ->with('success', 'Welcome back, ' . $user->employee_name . '!');
            }

            // Step 3: Wrong credentials
            return back()
                ->with('error', 'The provided Patient ID or password is incorrect.')
                ->withInput();

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Step 4: Validation errors (missing fields)
            $message = collect($e->errors())->flatten()->first(); // first validation error message

            return back()
                ->with('error', $message ?? 'Please fill all required fields correctly.')
                ->withInput();

        } catch (\Exception $e) {
            // Step 5: Any unexpected error
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
