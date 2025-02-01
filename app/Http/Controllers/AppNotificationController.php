<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\Request;

class AppNotificationController extends Controller
{
    public function getNotificationsByUser($user_id)
    {
        // Validate the user ID if needed (optional step)
        if (!is_numeric($user_id)) {
            return response()->json(['error' => 'Invalid user ID'], 400);
        }

        // Fetch notifications by user_id
        $notifications = AppNotification::where('user_id', $user_id)->get();

        // Return the response
        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }
}
