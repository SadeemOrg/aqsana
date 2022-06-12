<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','area_id','name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function User()
    {
        return $this->hasMany('App\Models\User', 'city_id' );
    }

    public function Alhisalat()
    {
        return $this->hasMany('App\Models\Alhisalat', 'city_id' );
    }


    public function Area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }
}
