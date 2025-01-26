<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $guard = 'member';
    protected $guarded = [];

    public function basicinfo()
    {
        return $this->hasOne(BasicInfo::class, 'member_id')->orderBy('id', 'ASC');
    }
    public function careerinfo()
    {
        return $this->hasOne(EducationCareer::class, 'member_id')->orderBy('id', 'ASC');
    }
    public function educationinfo()
    {
        return $this->hasOne(EducationValue::class, 'member_id')->latest();
    }
    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'memberhobbies')->withTimestamps();
    }
    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'membersports')->withTimestamps();
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'memberlanguages')->withTimestamps();
    }

    public function memberimage()
    {
        return $this->hasOne(Memberimage::class, 'member_id')->latest();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
