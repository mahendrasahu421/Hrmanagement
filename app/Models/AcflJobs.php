<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcflJobs extends Model
{
    protected $table = 'acfl_jobs';
    protected $fillable = [
        'branch_id',
        'job_title',
        'designation_id',
        'test_skills',
        'positions',
        'job_type_id',
        'ctc_from',
        'ctc_to',
        'min_exp',
        'max_exp',
        'state_id',
        'city_ids',
        'job_description',
        'qualifications',
        'keywords',
        'interview_date',
        'status',
    ];


    // Agar aap JSON columns ko automatically array me chahte ho
    protected $casts = [
        'city_ids' => 'array',
        'qualifications' => 'array',
        'interview_date' => 'date',
    ];

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobCategory::class, 'job_type_id');
    }

    public function state()
    {
        return $this->belongsTo(CountryState::class, 'state_id');
    }
}
