<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
class Campaign extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
  

    public function tracking()
    {
        return $this->hasMany(Tracking::class,'campaign_id','id');
    }
 
}
