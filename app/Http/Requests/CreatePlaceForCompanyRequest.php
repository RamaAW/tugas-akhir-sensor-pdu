<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlaceForCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|string|unique:places',
            'name' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The id field is required.',
            'id.unique' => 'The id must be unique.',
            'name.required' => 'The name field is required.',
            'address.required' => 'The address field is required.',
            'latitude.required' => 'The latitude field is required.',
            'latitude.numeric' => 'The latitude must be a number.',
            'longitude.required' => 'The longitude field is required.',
            'longitude.numeric' => 'The longitude must be a number.',
        ];
    }
}
