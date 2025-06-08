<?php

namespace App\Http\Requests\Admin;

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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'name' => 'required|string|max:50',
            'brand' => 'required|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'description' => 'required|string',
            'variation.*.value' => 'required|string|max:50',
            'variation.*.weight' => 'required|numeric',
            'variation.*.quantity' => 'required|numeric|min:1',
            'variation.*.off_sale' => 'string|nullable',
            'variation.*.price' => 'required|numeric',
            'variation.*.image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
