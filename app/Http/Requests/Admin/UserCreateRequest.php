<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'full_name' => 'required|string|max:50|unique:users,full_name',
            'user_name' => 'required|string|max:50|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
            'cellphone' => ['required', 'numeric', 'digits:11', 'regex:/^(\+98|0)?9\d{9}$/', 'unique:users,cellphone'],
            'post_code' => 'nullable|numeric|digits:10|unique:addresses,postcode',
            'gender' => 'boolean',
            'address' => 'nullable|string',
        ];
    }
}
