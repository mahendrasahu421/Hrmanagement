<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateCity extends Model
{
    public function jobs()
    {
        return $this->belongsToMany(JobHrms::class, 'job_locations', 'city_id', 'job_id');
    }
}
