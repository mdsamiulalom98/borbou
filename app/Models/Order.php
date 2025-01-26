<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderdetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
    public function member()
    {
        return $this->belongsTo(OrderDetails::class, 'id', 'order_id')->select('id','order_id','member_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'order_id');
    }
    public function visitor()
    {
        return $this->belongsTo(Visitor::class,'visitor_id');
    }
}
