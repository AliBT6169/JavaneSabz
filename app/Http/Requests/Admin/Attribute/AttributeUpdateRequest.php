<?php

namespace App\Http\Requests\Admin\Attribute;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeUpdateRequest extends FormRequest
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
            'id' => 'required|numeric|exists:attributes,id',
            'name' => ['required', 'string', 'max:50', Rule::unique('attributes')->ignore($this->request->get('id'))],
            'image' => ['required', function ($attribute, $value, $fail) {
                if (is_string($value))
                    return;
                if (request()->hasFile($attribute)) {
                    $file = request()->file($attribute);
                    if (!$file->isValid() || !str_starts_with($file->getMimeType(), 'image')) {
                        $fail('فایل ارسالی باید تصویر باشد');
                    }
                } else {
                    $fail('فیلد تصویر باید شامل تصویر باشد');
                }
            }, 'max:2048'],
            'description' => 'required|string|max:500',
            'is_active' => 'required|boolean',
            'brand.*' => 'numeric|nullable',
            'category.*' => 'numeric|nullable',
            'product.*' => 'numeric|nullable',
            'product_variation.*' => 'numeric',
            'passed_brand.*' => 'numeric|nullable',
            'passed_category.*' => 'numeric|nullable',
            'passed_product.*' => 'numeric|nullable',
            'passed_product_variation.*' => 'numeric',
        ];
    }
}
