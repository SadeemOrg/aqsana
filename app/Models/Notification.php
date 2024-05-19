<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','message','sender_id','notification_type','status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    protected $casts = [

        'id' => 'string',
        'data'=>"array"
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','sender_id');
    }
    public function myid()
    {
        return $this->id;
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
