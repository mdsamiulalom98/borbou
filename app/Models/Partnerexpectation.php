<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnerexpectation extends Model
{
    use HasFactory;
    public function maritalstatus()
    {
        return $this->hasOne('App\Models\MaritalStatus', 'id', 'marital_status')->select('id', 'title');
    }
    public function religion()
    {
        return $this->hasOne('App\Models\Religion', 'id', 'religion_id')->select('id', 'title');
    }
    public function degree()
    {
        return $this->hasOne('App\Models\Degree', 'id', 'degree_id')->select('id', 'title');
    }
    public function working()
    {
        return $this->hasOne('App\Models\Working', 'id', 'working_id')->select('id', 'title');
    }

    public function nationality()
    {
        return $this->hasOne('App\Models\Country', 'id', 'nationality_id')->select('id', 'title');
    }
    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id')->select('id', 'title');
    }
    public function profession()
    {
        return $this->hasOne('App\Models\Profession', 'id', 'profession_id')->select('id', 'title');
    }
    public function residency()
    {
        return $this->hasOne('App\Models\Country', 'id', 'residency_id')->select('id', 'title');
    }
    
    public function district()
    {
        return $this->hasOne('App\Models\Location', 'id', 'district_id')->select('id', 'title');
    }
}
