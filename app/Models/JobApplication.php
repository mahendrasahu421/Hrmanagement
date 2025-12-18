<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'resume',
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
}
