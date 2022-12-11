<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ColorProduct extends Pivot implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $with = [
        'media',
    ];

    public const MEDIA_IMAGES = 'images';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_IMAGES);
    }
}
