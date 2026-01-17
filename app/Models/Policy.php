<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use HasFactory, SoftDeletes; // <-- Enables soft deletes

    protected $table = 'policies';

    protected $fillable = [
        'policy_title',
        'policy_code',
        'department_id',
        'effective_from',
        'expiry_date',
        'policy_document',
        'status',
        'description',
    ];

    protected $dates = [
        'effective_from',
        'expiry_date',
        'deleted_at',
    ];

    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
