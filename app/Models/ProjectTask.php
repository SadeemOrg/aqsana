<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','user_role_id','project_id','name','description','status','start_time','end_time','recipient','giver'
    ];




    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'user_role_id' => 'array',
        'trip_id' => 'array',
        'start_time' => 'date',
        'end_time' => 'date'
    ];

    public function Admin()
    {
        return $this->belongsTo('App\Models\User','admin_id','id');
    }


    public function Recipient()
    {
        return $this->belongsTo('App\Models\User','recipient','id');
    }


    public function Giver()
    {
        return $this->belongsTo('App\Models\User','giver','id');
    }

    public function Projects()
    {
        return $this->belongsTo('App\Models\project','project_id');
    }

}
