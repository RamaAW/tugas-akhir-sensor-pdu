<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RecordController extends Controller
{
    /**
     * Get all records
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::all();
        return response()->json($records);
    }

    /**
     * Get a specific record
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Record::find($id);
        if (!empty($record)) {
            return response()->json($record);
        } else {
            return response()->json([
                "message" => "Record Not Found"
            ], 404);
        }
    }

    /**
     * Store a new record
     *
     * @param  \App\Http\Requests\WellStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RecordStoreRequest $request)
    {
        try {
            $record = Record::create($request->validated());
            return response()->json(["message" => "Record Added."], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Delete a record
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Record::where('id', $id)->exists()) {
            $record = Record::findOrFail($id);
            $record->delete();
            return response()->json(["message" => "Record with ID $id has been successfully deleted."], 200);
        } else {
            return response()->json(["message" => "Record not found."], 404);
        }
    }
}
