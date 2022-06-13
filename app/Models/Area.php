<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'id','name','admin_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function City()
    {
        return $this->hasMany(City::class);
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User','admin_id');
    }

}
