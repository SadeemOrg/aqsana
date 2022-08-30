<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'id', 'project_name', 'project_describe', 'purpose',
        'is_reported','report_status','report_title','report_description','report_contents','report_image','report_pictures','report_video_link',
         'project_type', 'Project_Status', 'start_date', 'end_date',
        'Budjet', 'admin_id', 'approval', 'reason_of_reject'
        ,'Financial_Type','is_has_volunteer','is_has_Donations','areas','cities','approval_Status',
        'update_by','created_by'


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
        'report_date' => 'date',

    ];


    public function buses()
    {
        return $this->hasOne(Bus::class);
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

    public function Area()
    {
        return $this->belongsToMany(Area::class,'project_area')->withTimestamps();
    }
    public function City()
    {
        return $this->belongsToMany(City::class,'project_city')->withTimestamps();
    }
    public function Bus()
    {
        $id = Auth::id();
        $user = Auth::user();

        $citye =   City::where('admin_id', $id)
        ->select('id')->first();
        if ($user->type() == 'regular_city')     return $this->belongsToMany(Bus::class,'project_bus')->where('project_bus.city_id', '=', $citye['id']);
        return $this->belongsToMany(Bus::class,'project_bus');
    }

    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function Updateby()
    {
        return $this->belongsTo('App\Models\User','update_by');
    }

    public function scopeTrip($query)
    {
        return $query->where('project_type', 2);
    }
}
