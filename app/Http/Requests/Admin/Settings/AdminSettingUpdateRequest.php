<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingUpdateRequest extends FormRequest
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
            'address' => 'required|string|max:500',
            'phone' => ['required', 'numeric', 'digits:11', 'regex:/^(\+98|0)?9\d{9}$/', 'unique:users,cellphone'],
            'email' => 'nullable|email|string',
            'about' => 'required|string|max:500',
            'facebook' => 'nullable|string|max:30',
            'twitter' => 'nullable|string|max:30',
            'instagram' => 'nullable|string|max:30',
            'youtube' => 'nullable|string|max:30',
            'telegram' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'eta' => 'nullable|string|max:30',
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
        ];
    }
}
