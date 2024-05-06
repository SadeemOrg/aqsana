<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\NewsObserver;
use App\Observers\ProjectObserver;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;
    protected $observers = [
        News::class => [NewsObserver::class]


    ];
    protected $fillable = [

        'id','title','description','image','type','pictures','created_by','update_by','created_at','status'

    ];

    protected $casts = [
    	'pictures' => 'array',
        'new_date' => 'date',
        'main_type' => 'array',
    ];


    protected $hidden = [
        'updated_at',

    ];

    public function newsTypes()
    {
        return $this->belongsTo('App\Models\newsType','type');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }
    public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(130)
        ->height(130);
}

public function registerMediaCollections(): void
{
    $this->addMediaCollection('main')->singleFile();
    $this->addMediaCollection('my_multi_collection');
}

}
