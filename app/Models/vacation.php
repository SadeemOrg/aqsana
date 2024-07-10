<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacation extends Model
{
    use HasFactory;
    protected $casts = [
        'date'=>'date',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }
}
