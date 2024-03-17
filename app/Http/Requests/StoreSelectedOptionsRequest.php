<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSelectedOptionsRequest extends FormRequest
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
            'selected' => ['array'],
            'selected.*.questionId' => ['required', 'numeric'],
            'selected.*.optionId' => ['required', 'numeric'],
            'other' => ['array'],
            'other.*.questionId' => ['required', 'numeric'],
            'other.*.text' => ['required', 'string'],
        ];
    }
}
