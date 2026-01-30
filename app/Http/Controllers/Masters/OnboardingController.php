<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    public function index($slug, $id)
    {
        $data['title'] = 'Employee / Onboarding';
        $candidate = JobApplication::with([
            'gender',
            'maritalStatus',
            'job',
            'state',
            'city',
        ])->findOrFail($id);
        $generatedSlug = Str::slug(
            $candidate->first_name . ' ' . $candidate->last_name
        );
        if ($generatedSlug !== $slug) {
            abort(404);
        }
        $data['candidate'] = $candidate;
        return view('home.jobs.onboarding', $data);
    }
}
