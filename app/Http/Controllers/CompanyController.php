<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * Get all companies
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return response()->json($company);
    }

    /**
     * Get a specific company
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if (!empty($company)) {
            return response()->json($company);
        } else {
            return response()->json([
                "message" => "Company Not Found"
            ], 404);
        }
    }

    /**
     * Store a new Company
     *
     * @param  \App\Http\Requests\CompanyStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyStoreRequest $request)
    {
        try {
            $company = Company::create($request->validated());
            return response()->json(["message" => "Company Added."], 201);
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
     * @param  \App\Http\Requests\CompanyUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->update($request->validated());
            return response()->json(["message" => "Company updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "Company not found."], 404);
        }
    }


    /**
     * Delete a company
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);

            $relatedPlacesCount = $company->places()->where('companyId', $id)->count();

            $relatedEmployeesCount = $company->employees()->where('companyId', $id)->count();


            if ($relatedPlacesCount > 0) {
                return response()->json(['message' => 'Cannot delete this company because there are places related to this Company.'], 409);
            }

            if ($relatedEmployeesCount > 0) {
                return response()->json(['message' => 'Cannot delete this company because there are employees related to this Company.'], 409);
            }

            $company->delete();
            return response()->json(['message' => "Company with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Company not found.'], 404);
        }
    }
}
