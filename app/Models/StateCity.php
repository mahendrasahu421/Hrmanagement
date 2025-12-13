<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateCity extends Model
{
    public function jobs()
    {
        return $this->belongsToMany(AcflJobs::class, 'job_locations', 'city_id', 'job_id');
    }

    public function AcflJobs()
    {
        return $this->hasMany(AcflJobs::class, ' city_ids');
    }

}
