<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shift_name',
        'shift_code',
        'start_time',
        'end_time',
        'break_duration',
        'total_working_hours',
        'status'
    ];
}
