<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leave_types';

    // Mass assignment ke liye fields
    protected $fillable = [
        'company_id',
        'leave_name',
        'leave_code',
        'total_leaves',
        'carry_forward',
        'encashable',
        'applicable_for',
        'leave_category',
        'status',
        'description',
    ];
}
