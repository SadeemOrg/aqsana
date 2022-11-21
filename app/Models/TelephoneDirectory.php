<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelephoneDirectory extends Model
{

    use HasFactory;

    protected $fillable = [
    'name','email','type','phone_number','city','roles','jop','id_number'
   ];
}
