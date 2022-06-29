<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','admin_id','describtion','created_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function City()
    {
        return $this->hasMany(City::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','admin_id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\User','admin_id');
    }

    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }


}
