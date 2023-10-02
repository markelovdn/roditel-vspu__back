<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'second_name' => ['string'],
            'first_name' => ['string'],
            'patronymic' => ['string'],
            'email' => ['unique:users'],
            'phone' => ['unique:users'],
            'password' => ['string'],
            'role_code' => ['required', 'string'],
        ];
    }
}
