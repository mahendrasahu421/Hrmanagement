<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JafQuestion;
use App\Models\AcflJobs;
class JafController extends Controller
{
    public function index()
    {
        $data['title'] = 'Create Job Questionnaire';
        $data['jobs'] = AcflJobs::where('status', 'PUBLISHED')
            ->select('id', 'job_title')
            ->get();

        return view('home.jobs.jaf', $data);
    }
    public function show()
    {
        $data['title'] = 'Job Questionnaire List';
        return view('home.jobs.jafList', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'job_id' => 'required',
                'question' => 'required|string',
                'text_element' => 'required|string',
                'order' => 'required|integer',
                'is_required' => 'required|in:Yes,No',
            ]);

            JafQuestion::create([
                'job_id' => $request->job_id,
                'question' => $request->question,
                'text_element' => $request->text_element,
                'order' => $request->order,
                'is_required' => $request->is_required,
                'options' => ($request->options) ? json_encode($request->options) : null,
            ]);

            return redirect()
                ->route('jaf.index')
                ->with('success', 'Question saved successfully!');

        } catch (\Exception $ex) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong! ' . $ex->getMessage());
        }
    }


}
