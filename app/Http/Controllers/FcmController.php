<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class FcmController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function updateDeviceToken(Request $request)
    {
        $user = User::find(1); // Find the user by ID 1
        Auth::login($user);
        // dd(  $request->user()->fcm_token,$request->user());
        // dd("dd");
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fcm_token' => 'required|string',
            // 'email'=>['required', new passwordRule]
        ], [
            'user_id.required' => 'الرجاء ادخال اسم',





        ]);
        $request->user()->update(['fcm_token' => $request->user()->fcm_token]);

        return response()->json(['message' => 'Device token updated successfully']);
    }

    public function sendFcmNotification(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
        $userIds = $request->user_ids;
        $title = $request->title;
        $body = $request->body;

        return $this->notificationService->sendNotification($userIds, $title, $body);

        return $response;
    }
}
