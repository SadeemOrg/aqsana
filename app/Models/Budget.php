<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Budget extends Model
{

    protected $dates = ['deleted_at'];
    use HasFactory ,SoftDeletes;
    public function Sector()
    {
        return $this->hasOne(Sector::class,'id','sector_id');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
