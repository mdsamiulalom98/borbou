<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeStyle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function familyvalue()
    {
        return $this->hasOne('App\Models\FamilyValue', 'id', 'family_value')->select('id', 'title');
    }

    public function religiousvalue()
    {
        return $this->hasOne('App\Models\ReligiousValue', 'id', 'religious_value')->select('id', 'title');
    }

    public function foodhabit()
    {
        return $this->hasOne('App\Models\FoodHabit', 'id', 'food_habit')->select('id', 'title');
    }

    public function drinkinghabit()
    {
        return $this->hasOne('App\Models\DrinkingHabit', 'id', 'drinking_habit')->select('id', 'title');
    }

    public function smokinghabit()
    {
        return $this->hasOne('App\Models\SmokeHabit', 'id', 'smoking_habit')->select('id', 'title');
    }
}
