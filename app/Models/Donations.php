<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','project_id','project_type','user_id','bus_id','donor_name','amount','number_of_people','created_at'
    ];

    protected $hidden = [

        'updated_at',

    ];
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id' );
    }
    public function Project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id' );

    }

    public function bus()
    {
        return $this->belongsTo('App\Models\bus', 'bus_id' );

    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
