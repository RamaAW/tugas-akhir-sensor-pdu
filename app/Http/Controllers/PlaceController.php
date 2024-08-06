<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWellForPlaceRequest;
use App\Http\Requests\PlaceRequest;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Well;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Get all places
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::with('companies')->get();
        return response()->json($places->map(function ($place) {
            return [
                'id' => $place->id,
                'name' => $place->name,
                'address' => $place->address,
                'latitude' => $place->latitude,
                'longitude' => $place->longitude,
                'companyId' => $place->companyId,
                'companyName' => $place->companyName, // Add companyName
            ];
        }));
    }

    /**
     * Get a specific place
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        if (!empty($place)) {
            return response()->json($place);
        } else {
            return response()->json([
                "message" => "Place Not Found"
            ], 404);
        }
    }

    /**
     * Store a new place
     *
     * @param  \App\Http\Requests\PlaceStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PlaceRequest $request)
    {
        try {
            $place = Place::create($request->validated());
            return response()->json(["message" => "Place Added."], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Create a new well for the place.
     *
     * @param  \App\Http\Requests\CreateWellForPlaceRequest  $request
     * @param  string  $companyId
     * @param  string  $placeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWell(CreateWellForPlaceRequest $request, $companyId, $placeId)
    {
        try {
            // Cari tempat (place) berdasarkan placeId yang terkait dengan perusahaan (companyId)
            $place = Place::where('id', $placeId)
                ->where('companyId', $companyId)
                ->firstOrFail();

            // Buat objek well berdasarkan data yang diterima dari request
            $wellData = $request->validated();
            $wellData['placeId'] = $placeId; // Tetapkan placeId untuk well

            $well = Well::create($wellData);

            return response()->json(["message" => "Well created for place."], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(["message" => "Failed to create well for place."], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PlaceUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PlaceRequest $request, $id)
    {
        try {
            $place = Place::findOrFail($id);
            $place->update($request->validated());
            return response()->json(["message" => "Place updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "Place not found."], 404);
        }
    }

    /**
     * Delete a place
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $place = Place::findOrFail($id);

            $relatedWellsCount = $place->wells()->where('placeId', $id)->count();

            if ($relatedWellsCount > 0) {
                return response()->json(['message' => 'Cannot delete this place because there are wells related to this Place.'], 409);
            }

            $place->delete();
            return response()->json(['message' => "Place with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        }
    }
}
