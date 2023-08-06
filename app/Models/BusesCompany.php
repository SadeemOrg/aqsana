<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusesCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name','description','cost','number_of_buses','contact_person','phone_number','status','created_by','update_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    public function Bus()
    {
        return $this->hasMany(Bus::class,'company_id');
    }






    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function Updateby()
    {
        return $this->belongsTo('App\Models\User','update_by');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
