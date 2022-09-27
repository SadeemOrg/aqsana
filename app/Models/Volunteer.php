<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $table = 'volunteer';
    protected $fillable = ['project_id','user_id'];


    public function Project()
    {
        return $this->belongsTo('App\Models\Project','project_id','id');
    }
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id' );
    }
}
