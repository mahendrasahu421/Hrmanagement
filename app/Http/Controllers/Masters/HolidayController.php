<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $data['title'] = 'Holiday';
        $data['titleRoute'] = 'Settings / Masters / Holiday';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);

        return view('home.holiday.index', $data);
    }

    public function list(Request $request)
    {
        try {
            $search = $request->input('search')['value'] ?? null;
            $limit  = $request->input('length', 10);
            $start  = $request->input('start', 0);

            $query = Holiday::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('holiday_name', 'like', "%$search%")
                        ->orWhere('holiday_remark', 'like', "%$search%");
                });
            }

            $totalRecord = $query->count();
            $holidays = $query->skip($start)->take($limit)->get();

            $rows = [];
            foreach ($holidays as $index => $holiday) {
                $rows[] = [
                    'id' => $holiday->id,
                    'DT_RowIndex' => $start + $index + 1,
                    'holiday_name' => $holiday->holiday_name,
                    'holiday_date' => date('d M Y', strtotime($holiday->holiday_date)),
                    'holiday_remark' => $holiday->holiday_remark,
                    'status' => $holiday->status == 1
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>',
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
                'message' => 'Error fetching holiday list',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $data['title'] = "Master / Organisation / Holiday - Create";
        return view('home.holiday.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_name'  => 'required|string|max:255',
            'holiday_date'  => 'required|date',
            'holiday_remark' => 'nullable|string',
            'status'        => 'required|in:0,1',
        ]);

        Holiday::create([
            'holiday_name'   => $request->holiday_name,
            'holiday_date'   => $request->holiday_date,
            'holiday_remark' => $request->holiday_remark,
            'status'         => $request->status,
        ]);

        return redirect()->route('settings.holiday')
            ->with('success', 'Holiday created successfully');
    }

    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);

        $data['title'] = "Master / Organisation / Holiday - Edit";
        $data['holiday'] = $holiday;

        return view('home.holiday.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'holiday_name'  => 'required|string|max:255',
            'holiday_date'  => 'required|date',
            'holiday_remark' => 'nullable|string',
            'status'        => 'required|in:0,1',
        ]);

        $holiday = Holiday::findOrFail($id);

        $holiday->update([
            'holiday_name'   => $request->holiday_name,
            'holiday_date'   => $request->holiday_date,
            'holiday_remark' => $request->holiday_remark,
            'status'         => $request->status,
        ]);

        return redirect()->route('settings.holiday')
            ->with('success', 'Holiday updated successfully');
    }

    public function destroy($id)
    {
        $holiday = Holiday::find($id);

        if (!$holiday) {
            return response()->json(['success' => false, 'message' => 'Holiday not found']);
        }

        try {
            $holiday->delete();
            return response()->json(['success' => true, 'message' => 'Holiday deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
