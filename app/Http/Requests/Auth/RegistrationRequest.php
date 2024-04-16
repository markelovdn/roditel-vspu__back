<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
            'secondName' => ['required', 'string', 'max:45'],
            'firstName' => ['required', 'string', 'max:45'],
            'patronymic' => ['required', 'string', 'max:45'],
            'email' => ['required', 'unique:users', 'max:50'],
            'phone' => ['unique:users', 'max:20'],
            'password' => ['required', 'string'],
            'roleCode' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->keys();

        $formattedErrors = [];
        foreach ($errors as $error) {
            if ($error === 'email') {
                $error = 'Данный Email уже зарегистрирован, попробуйте восстановить пароль';
            } else {
                $error = 'Данный номер телефона уже зарегистрирован';
            }
            $formattedErrors[] = $error;
        }

        throw new ValidationException($validator, response()->json([
            'message' => $formattedErrors,
        ], 422));
    }
}
