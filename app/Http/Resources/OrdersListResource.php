<?php

namespace App\Http\Resources;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'OrdersListResource',
    required: ['id', 'total_price', 'status', 'created_at'],
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
    example: ['id' => 1, 'total_price' => 10.0, 'status' => OrderStatusEnum::new, 'comment' => '', 'created_at' => '2023-01-01 12:00:00']
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
