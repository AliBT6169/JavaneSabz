<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendLoginMobileRequest extends FormRequest
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
        ];
    }
}
