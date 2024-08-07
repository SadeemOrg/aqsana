<?php

namespace App\Models;

use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory   , SoftDeletes;

    protected $table = 'projects';

    protected $observers = [
        Project::class => [ProjectObserver::class],


    ];


    protected $fillable = [
        'id', 'project_name', 'project_describe', 'purpose',
        'is_reported','report_status','report_title','report_description','report_contents','report_image','report_pictures','report_video_link',
         'project_type', 'Project_Status', 'start_date', 'end_date',
        'Budjet', 'admin_id', 'approval', 'reason_of_reject'
        ,'Financial_Type','is_has_volunteer','is_has_Donations','areas','cities','approval_Status','trip_from','trip_to',
        'update_by','created_by','tools','transact_amount','newbus','test'


    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'newbus'
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
        return $this->hasMany(Transaction::class,'ref_id','id');
    }

    public function Area()
    {
        return $this->belongsToMany(Area::class,'project_area')->withTimestamps();
    }
    public function CityProject()
    {
        return $this->belongsTo(City::class, 'city');
    }


    public function TripCity()
    {
        return $this->belongsTo(ProjectCity::class,'id','project_id');
    }

    public function TripBooking()
    {
        return $this->hasMany(TripBooking::class);
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','admin_id');
    }
    public function Bus()
    {
        $id = Auth::id();
        $user = Auth::user();

        $citye =   City::where('admin_id', $id)
        ->select('id')->first();
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
        return $this->belongsTo('App\Models\address','trip_to')->where('type', '1');
    }

    public function tripfrom()
    {
        return $this->belongsTo('App\Models\address','trip_from')->where('type', '1');

    }


    public function distance()
    {
      return $this->distance = "0";
    }
    public function Sectors()
    {
        return $this->belongsTo('App\Models\Sector','sector');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}


