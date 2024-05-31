<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'message' => 'required|string',
            'wellId' => 'required|string|exists:wells,id',
            'seen' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'message.required' => 'The message field is required.',
            'wellId.required' => 'The wellId field is required.',
            'wellId.exists' => 'The selected wellId is invalid.',
            'seen.boolean' => 'The seen field must be true or false.',
        ];
    }
}
