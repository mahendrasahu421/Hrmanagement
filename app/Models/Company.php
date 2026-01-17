<?php

namespace App\Models;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use App\Models\StateCity;
use App\Models\CountryState;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
     use SoftDeletes;
     protected $fillable = [
        'company_name',
        'company_code',
        'contact_no',
        'email',
        'gst_no',
        'website',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'status'
    ];
protected $dates = ['deleted_at']; 
    protected $casts = [
        'status' => 'string',
    ];

    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function stateDetail()
    {
        return $this->belongsTo(CountryState::class, 'country_states', 'id');
    }

    public function cityDetail()
    {
        return $this->belongsTo(StateCity::class, 'state_cities', 'id');
    }
}
