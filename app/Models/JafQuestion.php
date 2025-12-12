<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JafQuestion extends Model
{
    use HasFactory;

    protected $table = 'jaf_questions';

    protected $fillable = [
        'job_id',
        'question',
        'text_element',
        'order',
        'is_required',
        'options',
    ];


    public function job()
    {
        return $this->belongsTo(AcflJobs::class);
    }
}
