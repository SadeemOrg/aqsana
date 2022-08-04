<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'id', 'project_name', 'project_describe', 'purpose',
        'is_reported','report_status','report_title','report_description','report_contents','report_image','report_pictures','report_video_link',
         'project_type', 'Project_Status', 'start_date', 'end_date',
        'Budjet', 'admin_id', 'approval', 'reason_of_reject'
        ,'Financial_Type','is_has_volunteer','is_has_Donations','areas','cities','approval_Status',
        'created_by','update_by'


    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'pictures' => 'array',
       ' cities'=> 'array',
        'areas'=> 'array',

    ];


    public function buses()
    {
        return $this->hasOne(Bus::class);
    }
    public function Alhisalat()
    {
        return $this->hasOne(Alhisalat::class);
    }
    public function ProjectType()
    {
        return $this->belongsTo(ProjectType::class,'project_type','code');
    }

    public function newsTypes()
    {
        return $this->belongsTo(newsType::class,'');
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class);
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
