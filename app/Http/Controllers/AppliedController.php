<?php

namespace App\Http\Controllers;
use App\Models\JobApplication;
use App\Models\CountryState;
use App\Models\Skills;
use App\Models\StateCity;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AppliedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Recruitment / Jobs / Applied Candidate';
        $data['imageUrl'] = "https://picsum.photos/200/200?random=" . rand(1, 1000);
        return view('home.jobs.applied-condidate.index', $data);
    }



    public function usersDetails($id)
    {
        $employee = JobApplication::with(
            'designation',
            'gender',
            'maritalStatus'
        )->findOrFail($id);

        $skillNames = [];
    if (!empty($employee->skills)) {
        $skillNames = Skills::whereIn('id', $employee->skills)
            ->pluck('name')
            ->toArray();
    }

        return response()->json([
            'employee_name' => ucfirst($employee->first_name) . ' ' . ucfirst($employee->last_name),
            'email' => $employee->email,
            'mobile' => $employee->phone,
            'aadhaar' => $employee->aadhaar_number,
            'dob' => Carbon::parse($employee->dob)->format('d-m-Y'),
            'gender' => $employee->gender->name ?? 'N/A',
            'marital_status' => $employee->maritalStatus->name ?? 'N/A',

            'state' => CountryState::whereId($employee->state_id)->value('name') ?? 'N/A',
            'city' => StateCity::whereId($employee->city_id)->value('name') ?? 'N/A',
            // educations
            'tenth_percent' => $employee->tenth_percent . "%",
            'tenth_year' => $employee->tenth_year,
            'twelfth_percent' => $employee->twelfth_percent . "%",
            'twelfth_year' => $employee->twelfth_year,
            'ug_percent' => $employee->ug_percent . "%",
            'ug_year' => $employee->ug_year,
            'qualification' => $employee->qualification,
            'degree' => $employee->degree,
            'institute' => $employee->institute,
            'final_year' => $employee->final_year,

            'experience_years' => $employee->experience_years,
            'experience_details' => $employee->experience_details,

            'skills' => !empty($skillNames) ? implode(', ', $skillNames) : 'N/A',
            'answers' => $employee->answers ?? [],

            'designation' => $employee->designation->name ?? 'N/A',
            'status' => ucfirst($employee->status),
            'resume' => asset('storage/' . $employee->resume),
            'applied_at' => $employee->created_at->format('d-m-Y'),
        ]);
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

    public function list(Request $request)
    {
        try {
            $search = $request->input('search.value');
            $limit = $request->input('length', 10);
            $start = $request->input('start', 0);
            $query = JobApplication::where('status', 'applied');
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            }
            $totalRecords = $query->count();
            $candidates = $query
                ->orderBy('created_at', 'desc')
                ->skip($start)
                ->take($limit)
                ->get();
            $rows = [];
            foreach ($candidates as $index => $candidate) {
                $gender = match ($candidate->gender_id) {
                    1 => 'Male',
                    2 => 'Female',
                    3 => 'Other',
                    default => 'N/A'
                };
                $stateName = optional(CountryState::find($candidate->state_id))->name ?? 'N/A';
                $cityName = optional(StateCity::find($candidate->city_id))->name ?? 'N/A';
                $rows[] = [
                    'DT_RowIndex' => $start + $index + 1,
                    'first_name' => sprintf(
                        '%s<br>
     <button class="badge bg-primary view-details" data-id="%d">
        View Details
     </button>',
                        e(ucfirst($candidate->first_name) . ' ' . ucfirst($candidate->last_name)),
                        $candidate->id
                    ),


                    'email' => $candidate->email,
                    'phone' => $candidate->phone,
                    'gender' => $gender,
                    'state' => $stateName,
                    'city' => $cityName,
                    'action' => '<a href="' . route('employee.onboarding', $candidate->employee_id) . '" class="btn btn-sm btn-primary">Onboarding</a>',
                ];
            }
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $rows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
