<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'id' => 'required|exists:users,id',
            'full_name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email',
            'cellphone' => ['required', 'numeric', 'digits:11', 'regex:/^(\+98|0)?9\d{9}$/'],
            'post_code' => 'nullable|numeric|digits:10',
            'gender' => 'boolean',
            'address' => 'nullable|string',
        ];
    }
}
