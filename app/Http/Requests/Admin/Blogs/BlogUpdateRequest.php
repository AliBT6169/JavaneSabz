<?php

namespace App\Http\Requests\Admin\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'id' => 'required|numeric|exists:blogs,id',
            'icon' => ['required', function ($attribute, $value, $fail) {
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
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:200',
            'status' => 'required|boolean',
        ];
    }
}
