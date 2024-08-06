<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployeeToCompanyRequest;
use App\Http\Requests\AddPlaceToCompanyRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CreatePlaceForCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

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
        try {
            $company = Company::findOrFail($id);
            return response()->json($company);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "Company not found."
            ], 404);
        }
    }

    public function getCompaniesForEmployee(Request $request)
    {
        $employee = $request->user(); // Mengambil pengguna yang sedang login
        $companies = Company::where('id', $employee->companyId)->get(); // Menyesuaikan dengan ID perusahaan karyawan

        return response()->json($companies);
    }

    public function store(CompanyRequest $request)
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
     * Create a new place for the company.
     *
     * @param  \App\Http\Requests\CreatePlaceForCompanyRequest  $request
     * @param  string  $companyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPlace(CreatePlaceForCompanyRequest $request, $companyId)
    {
        try {
            $company = Company::findOrFail($companyId);

            // Create a new place associated with this company
            $placeData = $request->validated();
            $place = new Place($placeData);
            $company->places()->save($place);

            return response()->json(["message" => "Place created for company."], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Company not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(["message" => "Failed to create place for company."], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyRequest $request, $id)
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
