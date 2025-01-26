<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public function visitor() {
        return $this->hasOne('App\Models\Member','id','visitor_id')->select('id', 'fullName');
    }
    public function member() {
        return $this->hasOne('App\Models\Member','id','member_id')->select('id', 'fullName');
    }
    
}
