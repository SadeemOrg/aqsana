<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;
class TelephoneDirectory extends Model
{

    use HasFactory;

    protected $fillable = [
    'name','email','type','phone_number','city','roles','jop','id_number'
   ];

   protected $casts = [
    // 'hower' => FlexibleCast::class,
    'hower' => 'json',



];
}
