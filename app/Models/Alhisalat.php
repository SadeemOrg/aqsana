<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alhisalat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'city_id','description','amount_total', 'status','lat','lon','information_location','start_time', 'end_time','recipient','giver'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
        'bus_id' => 'array',
    ];


}
