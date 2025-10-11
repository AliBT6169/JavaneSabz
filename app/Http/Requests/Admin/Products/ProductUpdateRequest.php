<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'id' => 'required|exists:products,id',
            'image' => 'nullable|image|max:5120',
            'name' => 'required|string|max:50',
            'brand' => 'required|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'variation.*.size' => 'required|string|max:50',
            'variation.*.weight' => 'required|numeric',
            'variation.*.quantity' => 'required|numeric',
            'variation.*.off_sale' => 'numeric|nullable|min:0|max:100',
            'variation.*.price' => 'required|numeric',
            'variation.*.image.*' => 'nullable|image|max:5120',
            'variation.*.passed_image.*.id' => 'nullable|numeric|min:1',
            'variation.*.passed_image.*.image' => 'nullable|string',
        ];
    }
}
