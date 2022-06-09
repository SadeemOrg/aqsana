<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'description','trip_goal','admin_id', 'from_city_id','to_city_id','buses_number','participants_number','bus_id', 'start_time','end_time','status',   'repetition','cost'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
        'bus_id' => 'array',
    ];



    public function City()
    {
        return $this->belongsTo(City::class);
    }

    public function from()
    {
        return $this->belongsTo('App\Models\City','from_city_id');
    }

    public function tocity()
    {
        return $this->belongsTo('App\Models\City','to_city_id');
    }


    public function User()
    {
        return $this->belongsTo('App\Models\User','admin_id');
    }

    public function Transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }




}
