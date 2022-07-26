<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripBooking extends Model
{
    use HasFactory;

    protected $table = 'trip_booking';

    protected $fillable = [
        'id','user_id','project_id','booking_type','number_of_people','status','reservation_amount'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'user_role_id' => 'array',
    ];


    public function Project()
    {
        return $this->belongsTo('App\Models\Project','project_id','id');
    }


    public function Buses()
    {
        return $this->belongsTo('App\Models\Bus','bus_id');
    }
     
    public function Users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

   
}
