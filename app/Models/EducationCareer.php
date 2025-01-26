<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCareer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function working()
    {
        return $this->hasOne('App\Models\Working', 'id', 'working_id')->select('id', 'title');
    }

    public function profession()
    {
        return $this->hasOne('App\Models\Profession', 'id', 'profession_id')->select('id', 'title');
    }
}
