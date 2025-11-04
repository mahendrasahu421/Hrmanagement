<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'company_id',
        'department_id',
        'designation_name',
        'designation_code',
        'description',
        'status',
    ];
    protected $dates = ['deleted_at'];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
