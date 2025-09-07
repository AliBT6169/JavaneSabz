<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendVerifyCodeRequest extends FormRequest
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
            'mobile' => ['required', 'numeric', 'digits:11', 'regex:/^(\+98|0)?9\d{9}$/'],
            'code' => 'numeric|required|digits:5',
            'name' => 'string|max:20|unique:users,name',
            'full_name' => 'string|max:60|unique:users,full_name',
        ];
    }
}
