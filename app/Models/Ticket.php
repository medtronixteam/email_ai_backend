<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function messages()  {
        return $this->hasMany(TicketMessage::class);
    }


public function latestMessage()
{
    return $this->hasOne(TicketMessage::class)->latestOfMany(); 
}
}
