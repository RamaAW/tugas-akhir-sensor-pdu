<?php

namespace App\Http\Controllers;

use App\Http\Requests\RigStoreRequest;
use App\Models\Rig;
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
            $rig->update($request->validated());
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

            // Check for related records or notifications if applicable
            // $relatedRecordsCount = $rig->records()->where('rigId', $id)->count();
            // $relatedNotificationsCount = $rig->notifications()->where('rigId', $id)->count();

            // if ($relatedRecordsCount > 0) {
            //     return response()->json(['message' => 'Cannot delete this Rig because there are records related to this Rig.'], 409);
            // }

            // if ($relatedNotificationsCount > 0) {
            //     return response()->json(['message' => 'Cannot delete this Rig because there are notifications related to this Rig.'], 409);
            // }

            $rig->delete();
            return response()->json(['message' => "Rig with ID $id has been successfully deleted."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rig not found.'], 404);
        }
    }
}
