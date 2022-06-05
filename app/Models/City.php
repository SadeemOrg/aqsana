<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;


    public function User()
    {
        return $this->hasMany('App\Models\User', 'city_id' );
    }

    public function Area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }
}
