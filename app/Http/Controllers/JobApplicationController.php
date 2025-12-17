<?php

namespace App\Http\Controllers;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'name' => 'required|string',
            'email' => 'required|email',
            'dob' => 'required|date',
            'gender' => 'required',
            'marital_status' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        // Resume upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')
                ->store('resumes', 'public');
        }

        JobApplication::create([
            'resume' => $resumePath,
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'state' => $request->state,
            'city' => $request->city,
            'phone' => $request->phone,

            'tenth_percent' => $request->tenth_percent,
            'tenth_year' => $request->tenth_year,
            'twelfth_percent' => $request->twelfth_percent,
            'twelfth_year' => $request->twelfth_year,
            'ug_percent' => $request->ug_percent,
            'ug_year' => $request->ug_year,
            'qualification' => $request->qualification,
            'degree' => $request->degree,
            'institute' => $request->institute,

            'experience_years' => $request->experience_years,
            'last_company' => $request->last_company,

            // Job Questions
            'answers' => $request->answers, // auto JSON
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
