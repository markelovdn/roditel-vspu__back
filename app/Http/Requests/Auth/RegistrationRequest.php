<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'second_name' => ['required', 'string', 'max:45'],
            'first_name' => ['required', 'string', 'max:45'],
            'patronymic' => ['required', 'string', 'max:45'],
            'email' => ['required', 'unique:users', 'max:50'],
            'phone' => ['unique:users', 'max:20'],
            'password' => ['required', 'string'],
            'role_id' => ['required'],
        ];
    }
}
