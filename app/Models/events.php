<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;

class events extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'note', 'file',



    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'events_date' => 'date',

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

    public function TelephoneDirectory()
    {
        return $this->belongsTo('App\Models\TelephoneDirectory', 'Contacts' );

    }
}
