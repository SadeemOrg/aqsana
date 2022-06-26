<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name','company_id','bus_number','number_person_on_bus',
        'travel_from','travel_to','current_location','driver','phone_number','status',
        'Created_By','Update_By'
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



 public function projects()
    {
        return $this->belongsToMany(project::class);
    }

    public function company()
    {
        return $this->belongsTo(buses_company::class,'company_id');
    }


}
