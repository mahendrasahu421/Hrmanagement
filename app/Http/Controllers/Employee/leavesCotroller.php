<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class leavesCotroller extends Controller
{
    public function index(){
        $data['title'] = 'Leaves';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('employee.leaves.index',$data);
    }
}
