<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'second_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'email' => ['required', 'unique:users'],
            'phone' => ['unique:users'],
            'password' => ['required', 'string'],
            'role_id' => ['required'],
        ];
    }
}
