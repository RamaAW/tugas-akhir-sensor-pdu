<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'companyId' => 'required|string|exists:companies,id',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
        ];

        $employee = Employee::find($this->route('id'));
        if ($employee) {
            $rules['email'] = [
                'required',
                'string',
                'email',
                Rule::unique('employees')->ignore($employee->id),
            ];
        } else {
            $rules['email'] = 'required|string|email';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'companyId.required' => 'The companyId field is required.',
            'companyId.exists' => 'The selected companyId is invalid.',
            'role.required' => 'The role field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
