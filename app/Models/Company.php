<?php

namespace App\Models;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use App\Models\StateCity;
use App\Models\CountryState;
class Company extends Model
{
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

    // ✅ Casts
    protected $casts = [
        'status' => 'string', // ENUM: Active / Inactive
    ];

    // ✅ Relationships (Optional: agar aap country, state, city models ke saath join karna chahte ho)
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
