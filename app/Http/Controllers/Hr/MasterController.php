<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Company List';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('hr.masters.company',$data);
    }
	
	public function branch()
    {
        $data['title'] = 'Branch List';
        return view('hr.masters.branch',$data);
    }
	public function department()
    {
        $data['title'] = 'Department List';
        return view('hr.masters.department',$data);
    }
	public function designation()
    {
        $data['title'] = 'Designation List';
        return view('hr.masters.designation',$data);
    }
	public function employee()
    {
        $data['title'] = 'Employee List';
        return view('hr.masters.employee',$data);
    }
	
	public function shift()
    {
        $data['title'] = 'Shift List';
        return view('hr.masters.shift',$data);
    }
	public function leavetype()
    {
        $data['title'] = 'Leave List';
        return view('hr.masters.leavetype',$data);
    }
	public function holiday()
    {
        $data['title'] = 'Holiday List';
        return view('hr.masters.holiday',$data);
    }
	public function policyhr()
    {
        $data['title'] = 'Policy List';
        return view('hr.masters.policyhr',$data);
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
}
