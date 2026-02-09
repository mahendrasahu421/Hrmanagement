<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'resume',
        'candidate_image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'aadhaar_number',
        'dob',
        'gender_id',
        'marital_status_id',
        'state_id',
        'city_id',
        'skills',
        'tenth_percent',
        'tenth_year',
        'twelfth_percent',
        'twelfth_year',
        'ug_percent',
        'ug_year',
        'qualification',
        'degree',
        'institute',
        'final_year',
        'experience_years',
        'experience_details',
        'answers',
        'status'
    ];

    protected $casts = [
        'skills' => 'array',
        'answers' => 'array',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function state()
    {
        return $this->belongsTo(CountryState::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(StateCity::class, 'city_id');
    }
    public function getSkillNamesAttribute()
    {
        if (empty($this->skills)) {
            return [];
        }

        return Skills::whereIn('id', $this->skills)->pluck('name')->toArray();
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function job()
    {
        return $this->belongsTo(AcflJobs::class, 'job_id');
    }
    public function interviewSchedules()
    {
        return $this->hasMany(InterviewSchedule::class);
    }
}
