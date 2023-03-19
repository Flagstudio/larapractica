<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'OrdersListResource',
    type: 'integer',
    properties: [
        new Property(
            property: 'id',
            type: 'integer',
        ),
        new Property(
            property: 'total_price',
            type: 'float',
        ),
        new Property(
            property: 'status',
            type: 'integer',
            ref: '#components/schemas/OrderStatusEnum',
        ),
        new Property(
            property: 'comment',
            type: 'string',
        ),
        new Property(
            property: 'created_at',
            type: 'string',
        ),
    ],
    example: ['test' => 123]
)]
class OrdersListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id',
            'total_price',
            'status',
            'comment',
            'created_at',
        ];
    }
}
