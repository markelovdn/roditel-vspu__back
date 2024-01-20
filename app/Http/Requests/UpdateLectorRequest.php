<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLectorRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'department' => ['nullable', 'string'],
        ];

        if ($this->hasFile('photo')) {
            $rules['photo'] = ['image:jpg,jpeg,png'];
        }

        return $rules;
    }
}
