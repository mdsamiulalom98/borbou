<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberhobby extends Model
{
    use HasFactory;

    public function hobby()
    {
        return $this->hasOne('App\Models\Hobby', 'id', 'hobby_id')->select('id', 'title');
    }
}
