<?php

// app/Services/NotificationService.php

namespace App\Services;

use Google_Client;

class NotificationService
{
    protected $projectId;
    protected $credentialsFilePath;

    public function __construct()
    {
        $this->projectId = 'alaqsa-association'; // This can be dynamic, like config('services.fcm.project_id')
        $this->credentialsFilePath = storage_path('app/json/file.json'); // Adjust as needed
    }

    public function sendNotification(array $userIds, $title, $body)
    {
        $responses = [];
        foreach ($userIds as $userId) {
            // Step 1: Validate and find the user

            $user = \App\Models\User::find($userId);
            dump($user ,$user->fcm_token,$userId);
            if (!$user || !$user->fcm_token) {
                $responses[] = [
                    'user_id' => $userId,
                    'message' => 'User does not have a device token',
                    'status' => 400
                ];
                continue;
            }

            // Step 2: Prepare Firebase credentials and token
            $fcm = $user->fcm_token;
            $client = new Google_Client();
            $client->setAuthConfig($this->credentialsFilePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->refreshTokenWithAssertion();
            $token = $client->getAccessToken();
            $access_token = $token['access_token'];

            // Step 3: Prepare headers
            $headers = [
                "Authorization: Bearer $access_token",
                'Content-Type: application/json'
            ];

            // Step 4: Prepare data to send
            $data = [
                "message" => [
                    "token" => $fcm,
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                    ],
                ]
            ];

            // Step 5: Send the request
            $response = $this->sendRequest($data, $headers);
            $responses[] = [
                'user_id' => $userId,
                'response' => $response->getData()
            ];
        }

        return response()->json($responses);
    }


    private function sendRequest($data, $headers)
    {
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
    }
}
