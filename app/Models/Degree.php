<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function educationcat()
    {
        return $this->hasOne('App\Models\Degree', 'id', 'parent_id')->select('id', 'title');
    }
    public function degrees()
    {
        return $this->hasMany(Degree::class, 'parent_id');
    }
    public function subdegrees()
    {
        return $this->hasMany(Degree::class, 'parent_id')->with('degrees');
    }
}
