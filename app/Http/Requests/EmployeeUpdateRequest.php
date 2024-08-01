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
            'password' => 'nullable|string|min:8',
        ];

        $employee = Employee::find($this->route('id'));
        if ($employee) {
            $rules['username'] = [
                'required',
                'string',
                'unique:employees,username,' . $employee->id,
            ];
        } else {
            $rules['username'] = 'required|string|unique:employees,username';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'companyId.required' => 'The companyId field is required.',
            'companyId.exists' => 'The selected companyId is invalid.',
            'role.required' => 'The role field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
