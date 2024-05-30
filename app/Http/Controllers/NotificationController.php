<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationStoreRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    /**
     * Get all notifications
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
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
    public function update(Request $request, $id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $notification->update($request->all());
            return response()->json(["message" => "Notification Updated."], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Notification Not Found',
            ], 404);
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
