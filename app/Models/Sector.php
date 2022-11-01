<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    public function Budget()
    {
        return $this->hasMany(Budget::class,'sector_id');
    }
}
