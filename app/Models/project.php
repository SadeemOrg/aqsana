<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','project_name', 'project_describe','Project_Status','map', 'projec_day','projec_start','projec_end','city_id','approval','reason_of_reject','admin_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'projec_day' => 'date',

        'city_id' => 'array',
        'map' => 'array',

    ];


    public function buses()
    {
        return $this->belongsToMany(Bus::class);
    }

}
