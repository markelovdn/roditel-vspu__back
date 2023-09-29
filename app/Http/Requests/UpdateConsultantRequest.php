<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric'],
            'photo' => ['required', 'image:jpg,jpeg,png'],
            'description' => ['required', 'string'],
            'specialization_id' => ['required', 'numeric'],
            'profession_id' => ['required', 'numeric'],
        ];
    }
}
