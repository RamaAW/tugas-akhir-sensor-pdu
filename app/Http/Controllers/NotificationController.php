<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationStoreRequest;
use App\Models\Notification;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
    }
    /**
     * Get all notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rigId = $request->input('rigId');
        $notifications = Notification::whereHas('records', function ($query) use ($rigId) {
            $query->where('RigId', $rigId);
        })
            ->with('records.rigs.wells')
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'recordId' => $notification->recordId,
                    'created_at' => $notification->created_at,
                    'updated_at' => $notification->updated_at,
                    'seen' => $notification->seen,
                    'records' => [
                        'Date-Time' => $notification->records->{"Date-Time"},
                        'Torque' => $notification->records->Torque,
                        'RigName' => $notification->records->rigs->rigName,
                        'WellName' => $notification->records->rigs->wells->name
                    ]
                ];
            });
        return response()->json($notifications);
    }

    //pake gak ya
    public function getNotificationsByRigId($rigId)
    {
        $recordIds = Record::where('RigId', $rigId)->pluck('id');

        // Mengambil notifikasi yang terkait dengan recordIds
        $notifications = Notification::whereIn('recordId', $recordIds)->get();
        return response()->json($notifications);
    }

    /**
     * Get a specific notification
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        if (!empty($notification)) {
            return response()->json($notification);
        } else {
            return response()->json([
                "message" => "Notification Not Found"
            ], 404);
        }
    }

    /**
     * Store a new notification
     *
     * @param  \App\Http\Requests\NotificationStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NotificationStoreRequest $request)
    {
        try {
            $notification = Notification::create($request->validated());
            return response()->json(["message" => "Notification Added."], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Update a notification
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NotificationStoreRequest $request, $id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $notification->update($request->validated());
            return response()->json(["message" => "Notification updated successfully."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(["message" => "Notification not found."], 404);
        }
    }

    /**
     * Delete a notification
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Notification::where('id', $id)->exists()) {
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return response()->json(["message" => "Notification with ID $id has been successfully deleted."], 200);
        } else {
            return response()->json(["message" => "Notification not found."], 404);
        }
    }
}
