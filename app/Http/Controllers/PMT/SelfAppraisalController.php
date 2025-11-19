<?php

namespace App\Http\Controllers\PMT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelfAppraisalController extends Controller
{
    public function index(){
        $data['title'] = 'Self Appraisal';
        return view('employee.selfappraisal.index',$data);
    }
    public function competencies(){
        $data['title'] = 'competencies';
        return view('employee.selfappraisal.competencies',$data);
    }
}
