<?php

namespace App\Http\Controllers\AdminHR;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\CountryState;
use NunoMaduro\Collision\Adapters\Phpunit\State;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['role'] = Auth::user()->name;
        $data['title'] = $data['role'] . ' ' . 'Dashboard';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.dashboard.index', $data);
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

    public function getDepartments($category_id)
    {
        $departments = Department::where('category_id', $category_id)
            ->select('id', 'department_name')
            ->get();

        return response()->json($departments);
    }
    public function getDesignation($department_id)
    {
        $departments = Designation::where('department_id', $department_id)
            ->select('id', 'designation_name')
            ->get();

        return response()->json($departments);
    }
    public function getState($country_id)
    {
        try {
            $states = \App\Models\CountryState::where('country_id', $country_id)
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();

            if ($states->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($states);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
    public function getcity($state_id)
    {
        try {
            $states = \App\Models\StateCity::where('state_id', $state_id)
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();

            if ($states->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($states);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }


}
