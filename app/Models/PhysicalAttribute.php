<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bodytype()
    {
        return $this->hasOne('App\Models\BodyType', 'id', 'body_type')->select('id', 'title');
    }

    public function pcomplexion()
    {
        return $this->hasOne('App\Models\Complexion', 'id', 'complexion')->select('id', 'title');
    }

    public function bloodgroup()
    {
        return $this->hasOne('App\Models\BloodGroup', 'id', 'blood_group')->select('id', 'title');
    }

    public function eyecolor()
    {
        return $this->hasOne('App\Models\EyeColor', 'id', 'eye_color')->select('id', 'title');
    }

    public function hairtype()
    {
        return $this->hasOne('App\Models\HairType', 'id', 'hair_type')->select('id', 'title');
    }

    public function haircolor()
    {
        return $this->hasOne('App\Models\HairColor', 'id', 'hair_color')->select('id', 'title');
    }


}
