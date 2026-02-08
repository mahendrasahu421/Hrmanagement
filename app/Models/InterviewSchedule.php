<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model
{
    protected $fillable = [
        'job_application_id',
        'round',
        'mode',
        'date',
        'time',
        'venue',
        'description',
        'status',
        'comments',
    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
