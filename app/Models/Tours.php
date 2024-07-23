<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'DATE', 'number_of_people','Contacts'
          ,'guide_name','start_tour','end_tour','note'


    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date',
        // 'start_tour' => 'date',
        // 'end_tour' => 'date',


    ];
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','Contacts');
    }
    public function guide()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','guide_name');
    }
}
