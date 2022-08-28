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
        'name',
        'email',
        'password',
        'user_role',
        'phone',
        'city_id',
        'birth_date'

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
    ];

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


    public function type()
    {
        return $this->user_role;
    }
}
