<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';
    protected $primaryKey = 'id';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'modification_date';

    protected $fillable = [
        'holiday_name',
        'holiday_date',
        'holiday_remark',
        'status'
    ];

    protected $casts = [
        'holiday_date'     => 'date',
        'creation_date'    => 'datetime',
        'modification_date' => 'datetime'
    ];
}
