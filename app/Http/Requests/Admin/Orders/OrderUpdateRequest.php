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
            'coupon_amount' => 'required|numeric',
            'status' => 'required|numeric|between:-1,4',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric|exists:product_variations,id',
            'items.*.order_quantity' => 'required|numeric',
            'items.*.order_item_id' => 'required|numeric',
        ];
    }
}
