<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcflJobs extends Model
{
    use SoftDeletes;
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
        'test_skills' => 'array',
        'city_ids' => 'array',
        'qualifications' => 'array',
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
        return $this->belongsTo(CountryState::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(StateCity::class, 'city_id');
    }

    public function skills()
    {
        return JobSkill::whereIn('id', $this->test_skills ?? [])->pluck('name')->toArray();
    }

    public function getCityIdsAttribute($value)
    {
        // Fix double encoded JSON: "\"[\"1\"]\""
        while (is_string($value)) {
            $decoded = json_decode($value, true);

            if ($decoded === null) {
                break;
            }

            $value = $decoded;
        }

        return is_array($value) ? $value : [];
    }
}
