<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'values'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



}
