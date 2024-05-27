<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WellUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'placeId' => 'required|string|exists:places,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'address.required' => 'The address field is required.',
            'latitude.required' => 'The latitude field is required.',
            'latitude.numeric' => 'The latitude must be a number.',
            'longitude.required' => 'The longitude field is required.',
            'longitude.numeric' => 'The longitude must be a number.',
            'placeId.required' => 'The placeId field is required.',
            'placeId.exists' => 'The selected placeId is invalid.',
        ];
    }
}
