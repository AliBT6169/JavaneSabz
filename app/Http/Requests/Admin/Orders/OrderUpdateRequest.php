<?php

namespace App\Http\Requests\Admin\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'id' => 'required|numeric|exists:orders,id',
            'user' => 'required|numeric|exists:users,id',
            'coupon_amount' => 'required|numeric',
            'delivery_methode' => 'required|string|max:15',
            'status' => 'required|numeric|between:-1,4',
            'address' => 'required|string|max:500',
            'postal_code' => 'numeric|required|digits:10',
            'city' => 'numeric|required|exists:cities,id',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric|exists:product_variations,id',
            'items.*.order_quantity' => 'required|numeric',
        ];
    }
}
