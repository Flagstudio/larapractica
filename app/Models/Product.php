<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Searchable;

    public const MEDIA_IMAGES = 'images';

    public function colors()
    {
        return $this->belongsToMany(Color::class,);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_IMAGES);
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }
}
