<?php

namespace App\Http\Requests\Admin\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user' => 'required|numeric|exists:users,id',
            'coupon_amount' => 'required|numeric',
            'status' => 'required|numeric|between:-1,4',
            'address' => 'required|string|max:500',
            'delivery_methode' => 'required|boolean',
            'postal_code' => 'numeric|required|digits:10',
            'city' => 'numeric|required|exists:cities,id',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric|exists:product_variations,id',
            'items.*.order_quantity' => 'required|numeric',
        ];
    }
}
