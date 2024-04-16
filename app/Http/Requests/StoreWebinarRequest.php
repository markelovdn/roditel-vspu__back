<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebinarRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'date' => ['required', 'string'],
            'timeStart' => ['string'],
            'timeEnd' => ['string'],
            'logo' => ['image:jpg,jpeg,png'],
            'cost' => ['numeric'],
            'prefixSertificate' => ['required', 'string'],
            'numberSertificate' => ['required', 'numeric'],
            'videoLink' => ['string'],
            'webinarCategoryId' => ['required', 'numeric'],
        ];
    }
}
