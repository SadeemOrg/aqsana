<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almuahada extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'city','phone',
        ];
}