<?php

namespace App\Http\Requests;

use App\Data\AddToCartData;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Spatie\LaravelData\WithData;

#[Schema(
    title: 'AddProductToCartRequest',
    required: ['product_id', 'quantity'],
    properties: [
        new Property(
            property: 'product_id',
            description: 'ID товара',
            type: 'integer',
        ),
        new Property(
            property: 'quantity',
            description: 'Количество',
            type: 'integer',
        ),
    ],
    example: ['product_id' => 1, 'quantity' => 1],
)]
class AddProductToCartRequest extends FormRequest
{
    use WithData;

    protected $dataClass = AddToCartData::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products',
            'quantity' => 'required|integer',
        ];
    }
}
