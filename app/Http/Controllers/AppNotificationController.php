<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppNotificationController extends Controller
{
    public function getNotificationsByUser()
    {
        // Validate the user ID if needed (optional step)
        if (!is_numeric(Auth::id())) {
            return response()->json(['error' => 'Invalid user ID'], 400);
        }

        // Fetch notifications by user_id
        $notifications = AppNotification::where('user_id', Auth::id())->get();

        // Return the response
        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }
}
