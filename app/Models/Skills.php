<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $table = 'skills';

    protected $fillable = ['name', 'slug', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

}
