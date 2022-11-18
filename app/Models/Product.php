<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    public const SORTABLE = [
        'id',
    ];

    public const FILTERABLE = [
        'colors',
        'category',
        'price',
    ];

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class)
            ->withPivot('id')
            ->using(ColorProduct::class);
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'colors' => $this->colors
                ->pluck('id')
                ->toArray(),
            'category' => $this->category_id,
            'price' => $this->price,
        ];
    }

    public function shouldBeSearchable()
    {
        return $this->has('colors');
    }
}
