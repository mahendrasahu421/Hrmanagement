<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    public $timestamps = false; // since you use custom creation_date/modification_date

    protected $fillable = [
        'patId',
        'employee_name',
        'employee_email',
        'employee_mobile',
        'employee_password',
    ];

    protected $hidden = [
        'employee_password',
    ];

    // tell Laravel to use employee_password instead of "password"
    public function getAuthPassword()
    {
        return $this->employee_password;
    }
}
