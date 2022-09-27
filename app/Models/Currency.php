<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'code','rate','created_by','update_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];




}
