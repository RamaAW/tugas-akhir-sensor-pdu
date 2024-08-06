<?php

namespace App\Http\Controllers;

use App\Http\Requests\WellRequest;
use App\Http\Requests\WellStoreRequest;
use App\Http\Requests\WellUpdateRequest;
use App\Models\Company;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\Well;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class WellController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get all wells
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wells = Well::with('places.companies')->get();
        return response()->json($wells->map(function ($well) {
            return [
                'id' => $well->id,
                'name' => $well->name,
                'address' => $well->address,
                'latitude' => $well->latitude,
                'longitude' => $well->longitude,
                'placeId' => $well->placeId,
                'placeName' => $well->placeName,
                'companyId' => $well->companyId,
                'companyName' => $well->companyName,
            ];
        }));
    }

    /**
     * Get a specific well
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $well = Well::find($id);
        if (!empty($well)) {
            return response()->json($well);
        } else {
            return response()->json([
                "message" => "Well Not Found"
            ], 404);
        }
    }

    public function showByCompanyId($companyId)
    {
        $company = Company::find($companyId);

        if (is_null($company)) {
            return response()->json([
                "message" => "Company Not Found"
            ], 404);
        }
        // Retrieve all places associated with the company (without filtering by specific placeId)
        $places = Place::where('companyId', $companyId)->get();

        // Prepare an empty array to store all wells from all places
        $allWells = [];

        // Iterate through each place and fetch its associated wells
        foreach ($places as $place) {
            $placeWells = Well::where('placeId', $place->id)->get();
            $allWells = array_merge($allWells, $placeWells->toArray()); // Merge wells from each place into the main array
        }

        return response()->json($allWells);
    }

    /**
     * Get a specific record by Well Id
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showByPlaceId($companyId, $placeId = null)
    {
        $company = Company::find($companyId);
        if (is_null($company)) {
            return response()->json([
                "message" => "Company Not Found"
            ], 404);
        }

        $places = $company->places()->with('wells'); // Eager load wells
        if ($placeId) {
            $place = $places->where('id', $placeId)->first();
            if (is_null($place)) {
                return response()->json([
                    "message" => "Place Not Found"
                ], 404);
            }
        } else {
            $place = $places->first();
        }

        if (empty($place)) {
            return response()->json([
                "message" => "No places found for this company"
            ], 404);
        }

        $wells = $place->wells;

        if (empty($wells)) {
            return response()->json([
                "message" => "No wells found for this place"
            ], 404);
        }

        return response()->json($wells);
    }


    /**
     * Store a new well
     *
     * @param  \App\Http\Requests\WellStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WellRequest $request)
    {
        try {
            $well = Well::create($request->validated());
            return response()->json(["message" => "Well Added."], 201);
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
     * @param  \App\Http\Requests\WellUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WellRequest $request, $id)
    {
        try {
            $well = Well::findOrFail($id);
            $well->update($request->validated());
            return response()->json(["message" => "Well updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "Well not found."], 404);
        }
    }

    /**
     * Delete a well
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $well = Well::findOrFail($id);
            $well->delete();
            return response()->json(['message' => "Well with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Well not found.'], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur during deletion
            return response()->json(['message' => 'An error occurred while deleting the well.'], 500);
        }
    }
}
