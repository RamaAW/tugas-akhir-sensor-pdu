<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Faker\Factory as Faker;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store', 'generateDummyRecord');
    }
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

    public function generateDummyRecord()
    {
        $faker = Faker::create();

        $record = new Record([
            'Date-Time' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'BitDepth' => $faker->randomFloat(2, 0, 5000),
            'Scfm' => $faker->randomFloat(2, 0, 100),
            'MudCondIn' => $faker->randomFloat(2, 0, 10),
            'BlockPos' => $faker->randomFloat(2, 0, 100),
            'WOB' => $faker->randomFloat(2, 0, 50),
            'ROPi' => $faker->randomFloat(2, 0, 100),
            'BVDepth' => $faker->randomFloat(2, 0, 5000),
            'MudCondOut' => $faker->randomFloat(2, 0, 10),
            'Torque' => $faker->randomFloat(2, 0, 100),
            'RPM' => $faker->randomFloat(2, 0, 200),
            'Hkld' => $faker->randomFloat(2, 0, 1000),
            'LogDepth' => $faker->randomFloat(2, 0, 5000),
            'H2S_1' => $faker->randomFloat(2, 0, 100),
            'MudFlowOutp' => $faker->randomFloat(2, 0, 1000),
            'TotSPM' => $faker->randomFloat(2, 0, 200),
            'SpPress' => $faker->randomFloat(2, 0, 500),
            'MudFlowIn' => $faker->randomFloat(2, 0, 1000),
            'CO2_1' => $faker->randomFloat(2, 0, 100),
            'Gas' => $faker->randomFloat(2, 0, 100),
            'MudTempIn' => $faker->randomFloat(2, 0, 200),
            'MudTempOut' => $faker->randomFloat(2, 0, 200),
            'TankVolTot' => $faker->randomFloat(2, 0, 10000),
            'WellId' => 'well-001'
        ]);

        $record->save();

        return response()->json(['message' => 'Dummy record generated successfully', 'data' => $record], 201);
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
