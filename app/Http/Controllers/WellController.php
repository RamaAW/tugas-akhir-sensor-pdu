<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Well;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $well = Well::create($request->all());
        return response()->json(["message" => "Well Added."], 201);
    }

    /**
     * Update a well
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Well::where('id', $id)->exists()) {
            $well = Well::findOrFail($id);
            $well->update($request->all());
            return response()->json(["message" => "Well updated successfully."], 200);
        } else {
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
