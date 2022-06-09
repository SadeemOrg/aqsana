<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','project_name', 'project_number','project_goal','projec_type', 'projec_start','projec_end','area_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'projec_start' => 'date',
        'projec_end' => 'date',
        'area_id' => 'array',
    ];

}
