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

    public function list(Request $request)
    {
        $search = $request->search['value'] ?? null;
        $limit  = $request->length;
        $start  = $request->start;

        $query = JafQuestion::with('job');

        if ($search) {
            $query->where('question', 'like', "%$search%");
        }

        $total = $query->count();
        $records = $query->skip($start)->take($limit)->get();

        $data = [];
        foreach ($records as $key => $row) {
            $data[] = [
                'id' => $row->id,
                'DT_RowIndex' => $start + $key + 1,
                'job' => $row->job->job_title ?? '-',
                'question' => $row->question,
                'text_element' => $row->text_element,
                'options' => $row->options ? implode(', ', json_decode($row->options)) : '-',
                'order' => $row->order,
                'is_required' => $row->is_required == 'Yes'
                    ? '<span class="badge bg-success">Yes</span>'
                    : '<span class="badge bg-danger">No</span>',
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Job Questionnaire';
        $data['question'] = JafQuestion::findOrFail($id);
        $data['jobs'] = AcflJobs::where('status', 'PUBLISHED')
            ->select('id', 'job_title')
            ->get();

        return view('home.jobs.jafEdit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'job_id' => 'required',
                'question' => 'required|string',
                'text_element' => 'required|string',
                'order' => 'required|integer',
                'is_required' => 'required|in:Yes,No',
            ]);

            $question = JafQuestion::findOrFail($id);

            $question->update([
                'job_id' => $request->job_id,
                'question' => $request->question,
                'text_element' => $request->text_element,
                'order' => $request->order,
                'is_required' => $request->is_required,
                'options' => $request->options
                    ? json_encode($request->options)
                    : null,
            ]);

            return redirect()
                ->route('jaf.index')
                ->with('success', 'Question updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Something went wrong! ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $question = JafQuestion::find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        try {
            $question->delete();

            return response()->json([
                'success' => true,
                'message' => 'Question deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
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
