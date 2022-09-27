<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'describtion','type','created_by','update_by','code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function Project()
    {
        return $this->hasMany(Project::class);
    }
}
