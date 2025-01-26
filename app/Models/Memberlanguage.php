<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberlanguage extends Model
{
    use HasFactory;

    public function language()
    {
        return $this->hasOne('App\Models\Language', 'id', 'language_id')->select('id', 'title');
    }
}
