<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'resume',
        'name',
        'email',
        'dob',
        'gender',
        'marital_status',
        'state',
        'city',
        'phone',
        'tenth_percent',
        'tenth_year',
        'twelfth_percent',
        'twelfth_year',
        'ug_percent',
        'ug_year',
        'qualification',
        'degree',
        'institute',
        'experience_years',
        'last_company',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
}
