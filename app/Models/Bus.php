<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','bus_number','bus_Compane','name_driver','number_person_on_bus','status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];




 public function projects()
    {
        return $this->belongsToMany(project::class);
    }



}
