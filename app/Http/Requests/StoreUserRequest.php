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
            'secondname' => ['required', 'string', 'max:45'],
            'firstname' => ['required', 'string', 'max:45'],
            'patronymic' => ['required', 'string', 'max:45'],
            'email' => ['required', 'unique:users', 'max:50'],
            'phone' => ['unique:users', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role_id' => ['required'],
        ];
    }
}
