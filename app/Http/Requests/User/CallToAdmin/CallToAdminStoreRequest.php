<?php

namespace App\Http\Requests\User\CallToAdmin;

use Illuminate\Foundation\Http\FormRequest;

class CallToAdminStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => ['required', 'numeric', 'digits:11', 'regex:/^(\+98|0)?9\d{9}$/'],
            'text' => 'required|string|max:500',
        ];
    }
}
