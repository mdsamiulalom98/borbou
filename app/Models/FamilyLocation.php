<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyLocation extends Model
{
    use HasFactory;
    protected $guarded = [];


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

    public function presentdivision()
    {
        return $this->hasOne('App\Models\Location', 'id', 'present_division')->select('id', 'title');
    }

    public function presentdistrict()
    {
        return $this->hasOne('App\Models\Location', 'id', 'present_district')->select('id', 'title');
    }

    public function presentupazila()
    {
        return $this->hasOne('App\Models\Location', 'id', 'present_upazila')->select('id', 'title');
    }
    public function nationality()
    {
        return $this->hasOne('App\Models\Country', 'id', 'nationality_id')->select('id', 'title');
    }
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id')->select('id', 'title');
    }
}
