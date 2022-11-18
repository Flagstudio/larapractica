<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;
    use EagerLoadPivotTrait;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('id')
            ->using(ColorProduct::class);
    }
}
