<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checkin_time',
        'checkout_time'
    ];

    // Agar chaaho, user relationship bhi bana sakte ho
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
