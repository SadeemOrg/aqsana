<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_address','description','phone_number_address','status','address_id','type','number','current_location','city_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    protected $casts = [
        'current_location' => 'array'
    ];

    public function myid()
    {
        return $this->id;
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

    public function Area()
    {
        return $this->belongsTo(Area::class);
    }
    public function City()
    {
        return $this->belongsTo(City::class,'city_id');
    }


}
