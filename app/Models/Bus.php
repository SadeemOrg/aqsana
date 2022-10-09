<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'company_id', 'bus_number', 'number_person_on_bus', 'project_id',
        'travel_from', 'travel_to', 'current_location', 'driver', 'phone_number', 'status',
         'created_by', 'update_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    // protected $casts = [


    // ];

    public function TripBookings()
    {
        return $this->hasMany(TripBooking::class,'bus_id');

        // return $this->belongsToMany(Project::class);
    }
    public function Users()
    {
        return $this->hasMany(User::class,'id');

        // return $this->belongsToMany(Project::class);
    }


    public function Project()
    {
        return $this->belongsToMany(Project::class,'project_bus')->withTimestamps();

        // return $this->belongsToMany(Project::class);
    }

    public function company()
    {
        return $this->belongsTo(BusesCompany::class, 'company_id');
    }

    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function Updateby()
    {
        return $this->belongsTo('App\Models\User','update_by');
    }
    public function travelto()
    {
        return $this->belongsTo('App\Models\address','travel_to');
    }

    public function travelfrom()
    {
        return $this->belongsTo('App\Models\address','travel_from');
    }

    public function currentlocation()
    {
        return $this->belongsTo('App\Models\address','current_location');
    }

}
