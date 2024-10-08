<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get all employee
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('companies')->get();
        return response()->json($employees->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->name,
                'username' => $employee->username,
                'companyId' => $employee->companyId,
                'companyName' => $employee->companyName,
                'role' => $employee->role,
            ];
        }));
    }

    /**
     * Get a specific employee
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!empty($employee)) {
            return response()->json($employee);
        } else {
            return response()->json([
                "message" => "Employee Not Found"
            ], 404);
        }
    }

    /**
     * Store a new employee
     *
     * @param  \App\Http\Requests\EmployeeStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->validated());
            return response()->json(["message" => "Employee Added."], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $data = $request->except('password');
            if ($request->filled('password')) {
                $data['password'] = $request->input('password');
            }
            $employee->update($data);
            return response()->json(["message" => "Employee updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "Employee not found."], 404);
        }
    }

    /**
     * Delete a employee
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json(["message" => "Employee with ID $id has been successfully deleted."], 200);
        } else {
            return response()->json(["message" => "Employee not found."], 404);
        }
    }
}
