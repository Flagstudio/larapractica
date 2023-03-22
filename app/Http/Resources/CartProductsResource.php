<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'CartProductsResource',
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
    example: ['id' => 1, 'title' => 'Название товара', 'quantity' => 1]
)]
class CartProductsResource extends JsonResource
{
    private array $cart;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'quantity' => $this->currentQuantity(),
        ];
    }

    public function withCart(array $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    private function currentQuantity(): int
    {
        return $this->cart[$this->id] ?? 0;
    }
}
