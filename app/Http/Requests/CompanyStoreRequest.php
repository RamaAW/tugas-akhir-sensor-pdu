<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'id' => 'required|string|unique:companies',
            'name' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The id field is required.',
            'id.unique' => 'The id must be unique.',
            'name.required' => 'The name field is required.',
            'address.required' => 'The address field is required.',
        ];
    }
}
