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
        ,'Financial_Type','is_has_volunteer','is_has_Donations','areas','cities','approval_Status','trip_from','trip_to',
        'update_by','created_by','tools','transact_amount'


    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'pictures' => 'array',
       ' cities'=> 'array',
        'areas'=> 'array',
        'tools'=> 'array',
        'report_date' => 'date',

    ];




    public function buses()
    {
        return $this->hasOne(Bus::class);
    }
    public function Donations()
    {
        return $this->hasOne(Donations::class,'project_id');
    }
    public function Volunteer()
    {
        return $this->hasOne(Volunteer::class,'project_id');
    }
    public function ProjectType()
    {
        return $this->belongsTo(ProjectType::class,'project_type','code');
    }

    public function Project()
    {
        return $this->belongsTo(Project::class,'id');
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


    public function TripCity()
    {
        return $this->belongsTo(ProjectCity::class,'id','project_id');
    }

    public function TripBooking()
    {
        return $this->belongsTo(TripBooking::class,'id','project_id');
    }

    public function Bus()
    {
        $id = Auth::id();
        $user = Auth::user();

        $citye =   City::where('admin_id', $id)
        ->select('id')->first();
        // if ($user->type() == 'regular_city')     return $this->belongsToMany(Bus::class,'project_bus')->where('project_bus.city_id', '=', $citye['id']);
        return $this->belongsToMany(Bus::class,'project_bus');
    }

    public function BusTrip(){
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

    public function tripto()
    {
        return $this->belongsTo('App\Models\address','trip_to');
    }

    public function tripfrom()
    {
        return $this->belongsTo('App\Models\address','trip_from');
    }


    public function distance()
    {
      return $this->distance = "0";
    }

    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}


