<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;

    protected $fillable = [
        'id','main_type','type','description', 'ref_id','transact_amount',
         'Currency','equivelant_amount','voucher','transaction_date',
         'reason_of_reject','approval'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'transaction_date' => 'date',

    ];

    public function Trip()
    {
        return $this->belongsTo('App\Models\Project','ref_id');
    }


    public function Alhisalat()
    {
     return $this->belongsTo('App\Models\Alhisalat','ref_id','id');


    }

    public function Donations()
    {
        return $this->belongsTo('App\Models\Donations','ref_id','id');
    }

    public function QawafilAlaqsa()
    {
        return $this->belongsTo('App\Models\QawafilAlaqsa','ref_id');
    }

    public function Project()
    {
        return $this->belongsTo('App\Models\Project','ref_id');
    }

    public function Currenc()
    {
        return $this->belongsTo('App\Models\Currency','Currency');
    }

    // public function getCountryName() {
    //     return Currency::where('id', $this->id)->first()->name;
    // }

    // public function ref()
    // {

    //     if ($user->type() == 'regular_city')     return $this->belongsToMany(Bus::class,'project_bus')->where('project_bus.city_id', '=', $citye['id']);
    //     return $this->belongsToMany(Bus::class,'project_bus');
    // }

}
