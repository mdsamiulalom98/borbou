<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function maritalstatus()
    {
        return $this->hasOne('App\Models\MaritalStatus', 'id', 'marital_status')->select('id', 'title');
    }
    public function religion()
    {
        return $this->hasOne('App\Models\Religion', 'id', 'religion_id')->select('id', 'title');
    }

    public function nationality()
    {
        return $this->hasOne('App\Models\Country', 'id', 'nationality_id')->select('id', 'title');
    }
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id')->select('id', 'title');
    }
    public function recidency()
    {
        return $this->hasOne('App\Models\Country', 'id', 'residency_id')->select('id', 'title');
    }


    public function division()
    {
        return $this->hasOne('App\Models\Location', 'id', 'division_id')->select('id', 'title');
    }

    public function district()
    {
        return $this->hasOne('App\Models\Location', 'id', 'district_id')->select('id', 'title');
    }

    public function upazila()
    {
        return $this->hasOne('App\Models\Location', 'id', 'upazila_id')->select('id', 'title');
    }

    public function pcomplexion()
    {
        return $this->hasOne('App\Models\Complexion', 'id', 'complexion')->select('id', 'title');
    }
}
