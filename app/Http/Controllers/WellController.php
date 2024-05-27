<?php

namespace App\Http\Controllers;

use App\Http\Requests\WellStoreRequest;
use App\Http\Requests\WellUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Well;
use Illuminate\Validation\ValidationException;

class WellController extends Controller
{
    /**
     * Get all wells
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wells = Well::all();
        return response()->json($wells);
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

    /**
     * Store a new well
     *
     * @param  \App\Http\Requests\WellStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WellStoreRequest $request)
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
    public function update(WellUpdateRequest $request, $id)
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
        if (Well::where('id', $id)->exists()) {
            $well = Well::findOrFail($id);
            $well->delete();
            return response()->json(["message" => "Well with ID $id has been successfully deleted."], 200);
        } else {
            return response()->json(["message" => "Well not found."], 404);
        }
    }
}
