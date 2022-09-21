<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Alhisalat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'address_id','city_id','number_alhisala',
        'status', 'update_by','created_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // protected $casts = [
    //     'start_time' => 'date',
    //     'end_time' => 'date',
    //     'bus_id' => 'array',

    // ];
    public function Alhisalat()
    {
        return $this->belongsTo(Alhisalat::class,'id');
    }

    public function City()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\address','address_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','giver');
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
