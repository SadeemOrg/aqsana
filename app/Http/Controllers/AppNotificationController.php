<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppNotificationController extends Controller
{
    public function getNotificationsByUser(Request $request)
    {
        // Validate the user ID if needed (optional step)
        if (!is_numeric(Auth::id())) {
            return response()->json(['error' => 'Invalid user ID'], 400);
        }

        // Get the page and pageSize from the request, with defaults if not provided
        $page = $request->input('page', 1);  // Default to page 1 if not provided
        $pageSize = $request->input('pageSize', 3);  // Default to 3 items per page if not provided

        // Fetch notifications by user_id with pagination
        $notifications = AppNotification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate($pageSize, ['*'], 'page', $page);

        // Return the response
        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }

}
