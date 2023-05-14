<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;
class TelephoneDirectory extends Model
{

    use HasFactory;

    protected $fillable = [
    'name','email','type','phone_number','city','roles','job','id_number','Area'
   ];

   protected $casts = [
    // 'hower' => FlexibleCast::class,
    'hower' => 'json',



];


public function AreaDelegate()
{
    return $this->belongsTo(Area::class,'Area');
}

public function citeDelegate()
{
    return $this->belongsTo(City::class,'city');
}
}
