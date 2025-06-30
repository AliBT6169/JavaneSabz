<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:50|unique:products,name',
            'brand' => 'required|exists:brands,id',
            'category' => 'required|exists:Categories,id',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'variation.*.size' => 'required|string|max:50',
            'variation.*.weight' => 'required|numeric',
            'variation.*.quantity' => 'required|numeric|min:1',
            'variation.*.off_sale' => 'numeric|nullable|min:0|max:100',
            'variation.*.price' => 'required|numeric',
            'variation.*.image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
