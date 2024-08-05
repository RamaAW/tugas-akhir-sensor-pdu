<?php

namespace App\Http\Controllers;

use App\Http\Requests\RigStoreRequest;
use App\Models\Rig;
use App\Models\Well;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get all rigs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rigs = Rig::with('wells')->get();
        return response()->json($rigs->map(function ($rig) {
            return [
                'id' => $rig->id,
                'rigName' => $rig->rigName,
                'rigType' => $rig->rigType,
                'rigPower' => $rig->rigPower,
                'rigActivity' => $rig->rigActivity,
                'isActive' => $rig->isActive,
                'wellId' => $rig->wellId,
                'wellName' => $rig->wellName,
                'placeId' => $rig->placeId,
                'placeName' => $rig->placeName,
                'companyId' => $rig->companyId,
                'companyName' => $rig->companyName,
            ];
        }));
    }

    /**
     * Get a specific rig
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rig = Rig::find($id);
        if (!empty($rig)) {
            return response()->json($rig);
        } else {
            return response()->json([
                "message" => "Rig Not Found"
            ], 404);
        }
    }

    public function showByWellId($wellId)
    {
        $well = Well::find($wellId);

        if (is_null($well)) {
            return response()->json([
                "message" => "Well Not Found"
            ], 404);
        }

        $rig = $well->rigs;

        if (is_null($rig)) {
            return response()->json([
                "message" => "Rig not found for the given well"
            ], 404);
        }

        // Return data rig
        return response()->json($rig);
    }

    /**
     * Store a new rig
     *
     * @param  \App\Http\Requests\RigStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RigStoreRequest $request)
    {
        try {
            $rig = Rig::create($request->validated());
            return response()->json(["message" => "Rig Added."], 201);
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
     * @param  \App\Http\Requests\RigStoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RigStoreRequest $request, $id)
    {
        try {
            $rig = Rig::findOrFail($id);

            // Update the rig with validated data
            $rig->update($request->validated());

            // If isActive is set in the request, update the isActive status
            if ($request->has('isActive')) {
                $rig->isActive = $request->input('isActive');
                $rig->save();
            }

            return response()->json(["message" => "Rig updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Rig not found."], 404);
        }
    }

    /**
     * Delete a rig
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $rig = Rig::findOrFail($id);
            $rig->delete();
            return response()->json(['message' => "Rig with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rig not found.'], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur during deletion
            return response()->json(['message' => 'An error occurred while deleting the well.'], 500);
        }
    }
}
