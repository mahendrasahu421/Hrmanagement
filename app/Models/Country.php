<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'countries';

    // Mass assignable fields
    protected $fillable = [
        'code',
        'name',
        'phonecode',
    ];

    // Laravel by default timestamps are true
    // Agar table me created_at aur updated_at columns hain, ye line optional hai
    public $timestamps = true;
}
