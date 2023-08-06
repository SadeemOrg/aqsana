<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCity extends Model
{
    use HasFactory;

    protected $table = 'project_city';
    protected $fillable = [
        'project_id',
        'city_id'
    ];


    public function City()
    {
        return $this->belongsTo('App\Models\City','city_id','id');
    }

    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }



}
