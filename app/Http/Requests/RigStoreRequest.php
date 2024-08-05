<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RigStoreRequest extends FormRequest
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
            'rigName' => 'required|string',
            'rigType' => 'required|string',
            'rigPower' => 'required|string',
            'rigActivity' => 'required|string',
            'wellId' => 'required|exists:wells,id',
            'isActive' => 'sometimes|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'rigName.required' => 'The rigName field is required.',
            'rigType.required' => 'The rigType field is required.',
            'rigPower.required' => 'The rigPower field is required.',
            'rigActivity.required' => 'The rigActivity field is required.',
            'wellId.required' => 'The wellId field is required.',
            'wellId.exists' => 'The selected wellId is invalid.',
            'isActive.boolean' => 'The isActive field must be true or false.',
        ];
    }
}
