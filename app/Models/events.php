<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'note', 'file',



    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'events_date' => 'date',

    ];
}
