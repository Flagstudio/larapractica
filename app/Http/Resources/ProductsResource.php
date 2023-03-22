<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: '',
    required: ['id', 'title', 'quantity'],
    properties: [
        new Property(
            property: 'id',
            description: 'ID товара',
            type: 'integer',
        ),
        new Property(
            property: 'title',
            description: 'Название товара',
            type: 'string',
        ),
        new Property(
            property: 'quantity',
            description: 'Количество в корзине',
            type: 'integer',
        ),
    ],
    example: ['product_id' => 1, 'title' => 'Название товара', 'quantity' => 3],
)]
class ProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'quantity' => $this->quantity,
        ];
    }
}
