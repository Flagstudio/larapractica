<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'StoreOrderRequest',
    required: ['total_price'],
    properties: [
        new Property(
            property: 'total_price',
            type: 'float',
        ),
        new Property(
            property: 'comment',
            type: 'string',
        ),
    ],
    example: ['total_price' => 10.0, 'comment' => '']
)]
class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_price' => 'required|numeric|unsigned',
            'comment' => 'nullable|string|max:255',
        ];
    }
}
