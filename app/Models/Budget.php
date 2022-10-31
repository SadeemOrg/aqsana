<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    public function Sector()
    {
        return $this->hasOne(Sector::class,'id','sector_id');
    }
}
