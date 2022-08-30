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
        return $this->belongsTo('App\Models\project','project_id','id');
    }
}
