<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tours extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'id', 'name', 'DATE', 'number_of_people','Contacts'
          ,'guide_name','start_tour','end_tour','note'


    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date',
        // 'start_tour' => 'date',
        // 'end_tour' => 'date',


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
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','Contacts');
    }
    public function guide()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory','guide_name');
    }
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_tours', 'tour_id', 'city_id');

    }
}
