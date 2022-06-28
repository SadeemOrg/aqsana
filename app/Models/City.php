<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','area_id','name','created_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function User()
    {
        return $this->hasMany('App\Models\User', 'city_id' );
    }

    public function Alhisalat()
    {
        return $this->hasMany('App\Models\Alhisalat', 'city_id' );
    }


    public function Area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }

    public function create()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function Areaadmin()
    {
        $id = Auth::id();
        $user = DB::table('areas')->where('admin_id', $id)->select('id')->first();
        return $user->id;
    }
}


