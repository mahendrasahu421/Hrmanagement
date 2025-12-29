<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveReason extends Model
{
    protected $table = 'leave_reasons';

    protected $fillable = [
        'leave_type_id',
        'reason',
        'status',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }
}
