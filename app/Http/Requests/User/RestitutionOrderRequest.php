<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RestitutionOrderRequest extends FormRequest
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
            'order_id' => 'numeric|required|exists:orders,id',
            'description' => 'required|string|max:300',
        ];
    }
}
