<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buses_company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name','description','cost','number_of_buses','contact_person','phone_number','status','Created_By','Update_By'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
}
