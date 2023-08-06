<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_number',
        'name',
        'email',
        'password',
        'user_role',
        'role',
        'phone',
        'photo',
        'birth_date',
        'city',
        'job',
        'start_work_date',
        'martial_status',
        "user_number",
        'bank_name',
        'bank_branch',
        'account_number',
        'bank_number',
        'device_key'


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'start_work_date' => 'date',
        'role' => 'array',

    ];

    public function Bus()
    {
        return $this->belongsToMany('App\Models\Bus','user_id');
    }

    public function City()
    {
        return $this->hasOne('App\Models\City','admin_id');
    }

    public function Role()
    {
        return $this->belongsTo('App\Models\Role','user_role','code_role');
    }

    public function Area()
    {
        return $this->hasOne('App\Models\Area','admin_id');
    }

    public function Alhisalat()
    {
        return $this->hasMany('App\Models\Alhisalat','giver');
    }


    public function Donations()
    {
        return $this->hasMany('App\Models\Donations','user_id');
    }


    public function Volunteer()
    {
        return $this->hasMany('App\Models\Volunteer','user_id');
    }

    public function TripBooking()
    {
        return $this->hasMany('App\Models\TripBooking','user_id');
    }



    public function type()
    {
        return $this->user_role;
    }
    public function userrole()
    {
        return $this->role;
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
