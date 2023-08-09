<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Transaction extends Model implements HasMedia
{

    use \Awobaz\Compoships\Compoships;
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'id','main_type','type','description', 'ref_id','transact_amount',
         'Currency','equivelant_amount','voucher','transaction_date',
         'reason_of_reject','approval','sector','transaction_status','is_delete','transaction_type','name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        // 'Payment_type_details' => FlexibleCast::class,
        'Payment_type_details' => 'json',
        'transaction_date' => 'date',
        'Date' => 'date',

    ];

    protected $dates = [
        'transaction_date' => 'date',
        'Date' => 'date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('file')
            ->width(130)
            ->height(130);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('my_multi_collection');
    }

    public function Trip()
    {
        return $this->belongsTo('App\Models\Project','ref_id');
    }


    public function Alhisalat()
    {
     return $this->belongsTo('App\Models\Alhisalat','ref_id');


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
    public function Sectors()
    {
        return $this->belongsTo('App\Models\Sector','sector');
    }
    public function Currenc()
    {
        return $this->belongsTo('App\Models\Currency','Currency');
    }

    public function TelephoneDirectory()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','name');
    }
    public function BusesCompany()
    {
        return $this->belongsTo('App\Models\BusesCompany','name');
    }

    // public function ActionEvents()
    // {
    //     return $this->hasMany('App\Models\ActionEvents','actionable_id');
    // }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

    // public function getCountryName() {
    //     return Currency::where('id', $this->id)->first()->name;
    // }

    // public function ref()
    // {

    //     if ($user->type() == 'regular_city')     return $this->belongsToMany(Bus::class,'project_bus')->where('project_bus.city_id', '=', $citye['id']);
    //     return $this->belongsToMany(Bus::class,'project_bus');
    // }

    public function isdelete()
    {
        return $this->is_delete;
    }

}
