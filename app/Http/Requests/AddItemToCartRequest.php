<?php

namespace App\Http\Requests;

use App\Data\AddToCartData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class AddItemToCartRequest extends FormRequest
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
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ];
    }
}
