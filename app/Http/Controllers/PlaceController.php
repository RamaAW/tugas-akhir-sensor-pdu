<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class PlaceController extends Controller
{
    /**
     * Get all places
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
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
    public function store(PlaceStoreRequest $request)
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PlaceUpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PlaceUpdateRequest $request, $id)
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
     * Delete a well
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
                return response()->json(['message' => 'Cannot delete this place because there are wells related to another place.'], 409);
            }

            $place->delete();
            return response()->json(['message' => "Place with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Place not found.'], 404);
        }
    }
}
