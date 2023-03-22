<?php

namespace App\Http\Requests;

use App\Data\RemoveFromCartData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class RemoveProductFromCartRequest extends FormRequest
{
    use WithData;

    protected $dataClass = RemoveFromCartData::class;
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
        ];
    }
}
