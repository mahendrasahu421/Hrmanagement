<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leave_types';

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

    /**
     * Scope for only active leave types.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function designations()
{
    return $this->belongsToMany(Designation::class, 'leave_mappings', 'leave_type_id', 'designation_id');
}

}
