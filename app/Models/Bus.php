<?php

namespace App\Models;

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
    protected $casts = [
        'travel_from' => 'array',
        'travel_to' => 'array',
        'current_location' => 'array',

    ];



    public function project()
    {
        return $this->belongsToMany(project::class);
    }

    public function company()
    {
        return $this->belongsTo(busescompany::class, 'company_id');
    }

    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function Updateby()
    {
        return $this->belongsTo('App\Models\User','update_by');
    }
}
