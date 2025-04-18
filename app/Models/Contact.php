<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function campaign()
{
    return $this->belongsTo(Campaign::class);
}
public function group()
{
    return $this->belongsTo(Group::class);
}

}
