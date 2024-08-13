<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Models\Notification;
use App\Models\Record;
use App\Models\Rig;
use App\Models\Well;
use App\Services\WebSocketHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use Carbon\Carbon;

use Faker\Factory as Faker;

class RecordController extends Controller
{

    protected $webSocketHandler;

    public function __construct(WebSocketHandler $webSocketHandler)
    {
        $this->middleware('auth:sanctum')->except('store');
        $this->webSocketHandler = $webSocketHandler;
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

    public function getLastRecords(Request $request, $rigId)
    {
        $rig = Rig::findOrFail($rigId);

        $records = $rig->records()
            ->orderBy('id', 'desc')
            ->limit(30)
            ->get();

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

    public function showByRigId($rigId)
    {
        $rig = Rig::find($rigId);
        if (is_null($rig)) {
            return response()->json([
                "message" => "Rig Not Found"
            ], 404);
        }

        $record = Record::where('RigId', $rigId)->get();
        if (!empty($record)) {
            return response()->json($record);
        } else {
            return response()->json([
                "message" => "No Records for this Rig"
            ], 404);
        }
    }

    /**
     * Get a specific record by Well Id
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showByWellId($wellId)
    {
        // Temukan well berdasarkan ID
        $well = Well::find($wellId);
        if (is_null($well)) {
            return response()->json([
                "message" => "Well not found"
            ], 404);
        }

        // Ambil records berdasarkan wellId
        $records = Record::where('wellId', $wellId)
            ->with(['rigs', 'rigs.well']) // Memuat relasi rig dan well
            ->get();

        // Cek jika records kosong
        if ($records->isEmpty()) {
            return response()->json([
                "message" => "No records found"
            ], 404);
        }

        // Return data records
        return response()->json($records);
    }

    /**
     * Store a new record
     *
     * @param  \App\Http\Requests\RecordStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RecordStoreRequest $request)
    {
        try {
            $record = Record::create($request->validated());
            if ($record->Torque > 25) {
                Notification::create([
                    'title' => 'Torque Alert',
                    'message' => 'Torque value exceeded the threshold: ' . $record->Torque . ' klb.ft ' . 'at depth: ' . $record->BitDepth . ' m',
                    'recordId' => $record->id,
                    'seen' => false // Default to unseen
                ]);
            }
            if ($record->RPM < 80 && $record->Torque > 15) {
                Notification::create([
                    'title' => 'RPM & Torque Alert',
                    'message' => 'RPM is low: ' . $record->RPM . '<br>and Torque is high: ' . $record->Torque . ' klb.ft' . '<br>at depth: ' . $record->BitDepth . ' m',
                    'recordId' => $record->id,
                    'seen' => false // Default to unseen
                ]);
            }

            $rigId = $request->RigId;
            $this->webSocketHandler->broadcastNewData($rigId);
            return response()->json(["message" => "Record Added."], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function uploadCsv(Request $request)
    {
        // Validate the uploaded file and rigId
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
            'rigId' => 'required|exists:rigs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Get the uploaded file and rigId
        $file = $request->file('csv_file');
        $rigId = $request->input('rigId');

        // Verify if the Rig exists
        $rig = Rig::find($rigId);
        if (!$rig) {
            return response()->json(['error' => 'Rig not found'], 404);
        }

        // Read the CSV file
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);

        $records = [];
        $errors = [];
        $notifications = []; // Array to store notifications

        foreach ($csv as $offset => $row) {
            // Remove the 'Stuck' column if it exists
            unset($row['Stuck']);

            // Add RigId to the row data
            $row['RigId'] = $rigId;

            // Validate each row
            $validator = Validator::make($row, [
                'Date-Time' => 'required|date',
                'BitDepth' => 'nullable|numeric',
                'Scfm' => 'nullable|numeric',
                'MudCondIn' => 'nullable|numeric',
                'BlockPos' => 'nullable|numeric',
                'WOB' => 'nullable|numeric',
                'ROPi' => 'nullable|numeric',
                'BVDepth' => 'nullable|numeric',
                'MudCondOut' => 'nullable|numeric',
                'Torque' => 'nullable|numeric',
                'RPM' => 'nullable|numeric',
                'Hkld' => 'nullable|numeric',
                'LogDepth' => 'nullable|numeric',
                'H2S_1' => 'nullable|numeric',
                'MudFlowOutp' => 'nullable|numeric',
                'TotSPM' => 'nullable|numeric',
                'SpPress' => 'nullable|numeric',
                'MudFlowIn' => 'nullable|numeric',
                'CO2_1' => 'nullable|numeric',
                'Gas' => 'nullable|numeric',
                'MudTempIn' => 'nullable|numeric',
                'MudTempOut' => 'nullable|numeric',
                'TankVolTot' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                $errors[] = "Row {$offset}: " . implode(', ', $validator->errors()->all());
                continue;
            }

            // Create a new Record
            try {
                // Set created_at from Date-Time
                $createdAt = Carbon::parse($row['Date-Time']);

                $record = new Record($row);
                $record->created_at = $createdAt;
                $record->save();

                $records[] = $record;

                if ($record->Torque > 25) {
                    Notification::create([
                        'title' => 'Torque Alert',
                        'message' => 'Torque value exceeded the threshold: ' . $record->Torque . ' klb.ft ' . 'at depth: ' . $record->BitDepth . ' m',
                        'recordId' => $record->id,
                        'seen' => false // Default to unseen
                    ]);
                }
                if ($record->RPM < 80 && $record->Torque > 15) {
                    Notification::create([
                        'title' => 'RPM & Torque Alert',
                        'message' => 'RPM is low: ' . $record->RPM . '<br>and Torque is high: ' . $record->Torque . ' klb.ft' . '<br>at depth: ' . $record->BitDepth . ' m',
                        'recordId' => $record->id,
                        'seen' => false // Default to unseen
                    ]);
                }
            } catch (\Exception $e) {
                $errors[] = "Row {$offset}: Failed to create record - " . $e->getMessage();
            }
        }

        return response()->json([
            'message' => 'CSV file processed',
            'rigId' => $rigId,
            'records_created' => count($records),
            'errors' => $errors,
        ]);
    }

    public function saveCsv($rigId)
    {
        // Validasi rigId jika perlu
        $rig = Rig::find($rigId);
        if (!$rig) {
            return response()->json(['error' => 'Rig not found'], 404);
        }

        // Ambil data record berdasarkan rigId
        $records = Record::where('RigId', $rigId)->get();

        // Membuat file CSV menggunakan League CSV
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'Date-Time',
            'BitDepth',
            'Scfm',
            'MudCondIn',
            'BlockPos',
            'WOB',
            'ROPi',
            'BVDepth',
            'MudCondOut',
            'Torque',
            'RPM',
            'Hkld',
            'LogDepth',
            'H2S_1',
            'MudFlowOutp',
            'TotSPM',
            'SpPress',
            'MudFlowIn',
            'CO2_1',
            'Gas',
            'MudTempIn',
            'MudTempOut',
            'TankVolTot',
            'Stuck' // Menambahkan kolom Stuck
        ]);

        // Menambahkan data record ke file CSV
        foreach ($records as $record) {
            // Tentukan nilai untuk kolom Stuck
            $stuckValue = $record->Torque > 25 || $record->RPM < 80 && $record->Torque > 15 ? 1 : 0;

            $csv->insertOne([
                $record->created_at->format('Y-m-d H:i:s'), // Date-Time
                $record->BitDepth,
                $record->Scfm,
                $record->MudCondIn,
                $record->BlockPos,
                $record->WOB,
                $record->ROPi,
                $record->BVDepth,
                $record->MudCondOut,
                $record->Torque,
                $record->RPM,
                $record->Hkld,
                $record->LogDepth,
                $record->H2S_1,
                $record->MudFlowOutp,
                $record->TotSPM,
                $record->SpPress,
                $record->MudFlowIn,
                $record->CO2_1,
                $record->Gas,
                $record->MudTempIn,
                $record->MudTempOut,
                $record->TankVolTot,
                $stuckValue // Menambahkan nilai Stuck
            ]);
        }

        // Simpan file CSV ke sistem penyimpanan
        $csvContent = $csv->toString();
        $fileName = 'records_' . $rigId . '_' . now()->format('Ymd_His') . '.csv';
        $filePath = 'csv/' . $fileName;

        Storage::disk('local')->put($filePath, $csvContent);

        return response()->json([
            'message' => 'CSV file saved successfully',
            'file_path' => Storage::url($filePath),
        ]);
    }

    public function saveCsvByTime(Request $request, $rigId)
    {
        // Validate input
        $request->validate([
            'startDateTime' => 'required|date_format:Y-m-d H:i:s',
            'endDateTime' => 'required|date_format:Y-m-d H:i:s|after:startDateTime',
        ]);

        // Validate rigId
        $rig = Rig::find($rigId);
        if (!$rig) {
            return response()->json(['error' => 'Rig not found'], 404);
        }

        // Get records for the specified rig and time range
        $records = Record::where('RigId', $rigId)
            ->whereBetween('created_at', [$request->startDateTime, $request->endDateTime])
            ->get();

        // Create CSV file (using League CSV as before)
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'Date-Time',
            'BitDepth',
            'Scfm',
            'MudCondIn',
            'BlockPos',
            'WOB',
            'ROPi',
            'BVDepth',
            'MudCondOut',
            'Torque',
            'RPM',
            'Hkld',
            'LogDepth',
            'H2S_1',
            'MudFlowOutp',
            'TotSPM',
            'SpPress',
            'MudFlowIn',
            'CO2_1',
            'Gas',
            'MudTempIn',
            'MudTempOut',
            'TankVolTot',
            'Stuck' // Menambahkan kolom Stuck
        ]);

        foreach ($records as $record) {
            $stuckValue = $record->Torque > 25 || $record->RPM < 80 && $record->Torque > 15 ? 1 : 0;

            $csv->insertOne([
                $record->created_at->format('Y-m-d H:i:s'), // Date-Time
                $record->BitDepth,
                $record->Scfm,
                $record->MudCondIn,
                $record->BlockPos,
                $record->WOB,
                $record->ROPi,
                $record->BVDepth,
                $record->MudCondOut,
                $record->Torque,
                $record->RPM,
                $record->Hkld,
                $record->LogDepth,
                $record->H2S_1,
                $record->MudFlowOutp,
                $record->TotSPM,
                $record->SpPress,
                $record->MudFlowIn,
                $record->CO2_1,
                $record->Gas,
                $record->MudTempIn,
                $record->MudTempOut,
                $record->TankVolTot,
                $stuckValue // Menambahkan nilai Stuck
            ]);
        }

        // Save and return file as before
        $csvContent = $csv->toString();
        $fileName = 'records_' . $rigId . '_' . now()->format('Ymd_His') . '.csv';
        $filePath = 'csv/' . $fileName;

        Storage::disk('local')->put($filePath, $csvContent);

        return response()->json([
            'message' => 'CSV file saved successfully',
            'file_path' => Storage::url($filePath),
        ]);
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
            return response()->json(["message" => "Record with ID $id and the related reports has been successfully deleted."], 200);
        } else {
            return response()->json(["message" => "Record not found."], 404);
        }
    }

    public function destroyByRig($rigId)
    {
        // Validasi jika rigId ada
        $rig = Rig::find($rigId);
        if (!$rig) {
            return response()->json(["message" => "Rig not found."], 404);
        }

        // Menghapus semua record yang terkait dengan rigId
        $deletedRecords = Record::where('RigId', $rigId)->delete();

        return response()->json([
            "message" => "All records for Rig ID $rigId have been successfully deleted.",
            "deleted_records_count" => $deletedRecords,
        ], 200);
    }
}
