<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'project_name', 'project_describe', 'purpose',
        'is_reported','report_title','report_description','report_text','report_image','pictures',
         'type', 'Project_Status', 'start_date', 'end_date',
        'Budjet', 'admin_id', 'approval', 'reason_of_reject'
        ,'created_by','update_by'


    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'pictures' => 'array',

    ];


    public function buses()
    {
        return $this->hasOne(Bus::class);
    }
    public function ProjectType()
    {
        return $this->belongsTo(ProjectType::class,'type','code');
    }

    public function newsTypes()
    {
        return $this->belongsTo(newsType::class,'');
    }


    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function Updateby()
    {
        return $this->belongsTo('App\Models\User','update_by');
    }
}
