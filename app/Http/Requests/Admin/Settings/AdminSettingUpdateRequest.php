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
            'email' => 'required|email|string',
            'about' => 'required|string|max:500',
            'facebook' => 'required|string|max:30',
            'twitter' => 'required|string|max:30',
            'instagram' => 'required|string|max:30',
            'youtube' => 'required|string|max:30',
            'telegram' => 'required|string|max:30',
            'whatsapp' => 'required|string|max:30',
            'eta' => 'required|string|max:30',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
