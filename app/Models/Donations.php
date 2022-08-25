<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','project_id','project_type','user_id','bus_id','donor_name','amount','number_of_people'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id' );
    }
    public function project()
    {
        return $this->belongsTo('App\Models\project', 'project_id' );

    }

    public function bus()
    {
        return $this->belongsTo('App\Models\bus', 'bus_id' );

    }
}
