<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','message'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    protected $casts = [

        'id' => 'string'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','sender_id');
    }
    public function myid()
    {
        return $this->id;
    }
}
