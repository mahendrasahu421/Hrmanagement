<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StateCity;
use App\Models\CountryState;
class Branch extends Model
{
    protected $fillable = [
        'company_id',
        'branch_name',
        'branch_code',
        'branch_owner_name',
        'contact_number',
        'email',
        'address_1',
        'gst_number',
        'address_2',
        'country',
        'state',
        'city',
        'pincode',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function countryData()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function stateData()
    {
        return $this->belongsTo(CountryState::class, 'state', 'id');
    }

    public function cityData()
    {
        return $this->belongsTo(StateCity::class, 'city', 'id');
    }


}
