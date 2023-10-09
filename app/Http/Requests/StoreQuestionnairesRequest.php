<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionnairesRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'answerBefore' => ['date'],
            'questions' => ['array'],
            'questions.*.text' => ['string', 'max:255'],
            'questions.*.type' => ['string', 'max:255'],
            'questions.*.options' => ['array']
        ];
    }
}
