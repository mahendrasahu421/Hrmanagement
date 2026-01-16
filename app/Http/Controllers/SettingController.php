<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Email Templates';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.setting.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Email Templates';
        $data['compneyDetails'] = Company::select('company_name', 'company_logo', 'address')
            ->where('status', 'Active')
            ->get();
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.setting.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_key' => 'required|string|unique:email_templates,template_key',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            EmailTemplate::create([
                'template_key' => $request->template_key,
                'subject' => $request->subject,
                'body' => $request->body
            ]);
            DB::commit();
            return redirect()
                ->route('settings.email-templates')
                ->with('success', 'Email Template Saved Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);
            $query = EmailTemplate::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('template_key', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            }

            $totalRecord = $query->count();
            $templates = $query->skip($start)->take($limit)->get();
            $rows = [];
            foreach ($templates as $index => $template) {
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'template_key' => $template->template_key ?? '--',
                    'subject' => $template->subject ?? '--',
                    'created_at' => $template->created_at->format('d-M-Y'),
                    'id' => $template->id,
                ];
            }

            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecord,
                'recordsFiltered' => $totalRecord,
                'data' => $rows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while fetching email templates.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }


    public function edit($id)
    {
        $data['title'] = 'Edit Email Template';
        $data['template'] = EmailTemplate::findOrFail($id);
        $data['compneyDetails'] = Company::select('company_name', 'company_logo', 'address')
            ->where('status', 'Active')
            ->get();
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.setting.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $template = EmailTemplate::findOrFail($id);

        $request->validate([
            'template_key' => 'required|string|unique:email_templates,template_key,' . $template->id,
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $template->update([
                'template_key' => $request->template_key,
                'subject' => $request->subject,
                'body' => $request->body
            ]);

            DB::commit();

            return redirect()
                ->route('settings.email-templates')
                ->with('success', 'Email Template Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }


    public function destroy($id)
    {
        $template = EmailTemplate::find($id);

        if (!$template) {
            return response()->json(['success' => false, 'message' => 'Email Template not found.']);
        }

        try {
            $template->delete();
            return response()->json(['success' => true, 'message' => 'Email Template deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
    }

    public function preview($id)
    {
        $data['compneyDetails'] = Company::select('company_name', 'company_logo', 'address')
            ->where('status', 'Active')
            ->get();
        $data['template'] = EmailTemplate::findOrFail($id);
        $data['title'] = 'Email Preview';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.setting.preview', $data);
    }
}
