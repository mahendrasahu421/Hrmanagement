<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country; // corrected namespace

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['countries'] = Country::all();
        $data['title'] = 'Masters/Organisation/Branch';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.branch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Masters/Organisation/Branch';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        $data['countries'] = Country::all();
         $data['title'] = 'Masters/Organisation/Branch/Create';
        return view('home.branch.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'address' => 'nullable|string',
        ]);

        \App\Models\Branch::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = \App\Models\Branch::findOrFail($id);
        $countries = Country::all();
        return view('admin.branch.edit', compact('branch', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $branch = \App\Models\Branch::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'address' => 'nullable|string',
        ]);

        $branch->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = \App\Models\Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
