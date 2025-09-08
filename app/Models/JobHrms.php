<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHrms extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'skills',
        'positions',
        'job_type',
        'ctc_from',
        'ctc_to',
        'min_experience',
        'max_experience',
        'locations',
        'description',
        'keywords',
        'status'
    ];

    protected $casts = [
        'skills' => 'array',
        'locations' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}
