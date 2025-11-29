<?php

namespace App\Http\Requests\Admin\Equipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentUpdateRequest extends FormRequest
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
            'id' => 'required|exists:equipments',
            'name' => ['required', 'string', 'max:50', Rule::unique('equipments')->ignore($this->request->get('id'))],
            'slug' => ['required', 'string', 'max:50', Rule::unique('equipments')->ignore($this->request->get('id'))],
            'icon' => 'nullable|image',
            'description' => 'nullable|string',
        ];
    }
}
