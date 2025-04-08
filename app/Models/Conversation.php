<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_one_id',
        'member_two_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function member_one()
    {
        return $this->hasOne(Member::class, 'id', 'member_one_id')->select('id', 'fullName', 'phoneNumber', 'image');
    }
    public function member_two()
    {
        return $this->hasOne(Member::class, 'id', 'member_two_id')->select('id', 'fullName', 'phoneNumber', 'image');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
    public function lastMessageSender()
    {
        return $this->hasOne(Message::class)->latest()->select('sender_id');
    }

}
