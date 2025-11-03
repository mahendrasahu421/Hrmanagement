<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leave_types';

    protected $fillable = [
        'name',
        'description',
        'days',
        'status',
    ];

    /**
     * Scope for only active leave types.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
