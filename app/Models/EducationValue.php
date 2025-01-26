<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function education()
    {
        return $this->hasOne('App\Models\Degree', 'id', 'education_id')->latest()->select('id', 'title', 'parent_id');
    }
    public function degree()
    {
        return $this->hasOne('App\Models\Degree', 'id', 'degree_id')->latest()->select('id', 'title', 'parent_id');
    }
}
