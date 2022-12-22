<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_address','description','phone_number_address','status','address_id','type'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',

    ];
    protected $casts = [
        'current_location' => 'array'
    ];

    public function myid()
    {
        return $this->id;
    }
    // public function create()
    // {
    //     return $this->belongsTo('App\Models\User','created_by');
    // }

}
