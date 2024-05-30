<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessagingController extends Controller
{
    public function sendMessage(Request $request)
    {
        // API endpoint
        $url = 'https://la.cellactpro.com/http_req.asp';

        // Query parameters
        $params = [
            'FROM' => 'ppAksa',
            'USER' => 'ppAksa',
            'PASSWORD' => 'UKFV6Sx7',
            'APP' => 'LA',
            'CMD' => 'sendtextmt',
            'CONTENT' => 'hi',
            'SENDER' => '00972506940095',
            'TO' => '00972522212777'
        ];

        // Send the HTTP GET request
        $response = Http::get($url, $params);

        // Return the response text
        return $response->body();
    }
    public function sendText(Request $request)
    {
        $response = Http::get('https://la.cellactpro.com/http_req.asp', [
            'FROM' => 'ppAksa',
            'USER' => 'ppAksa',
            'PASSWORD' => 'UKFV6Sx7',
            'APP' => 'LA',
            'CMD' => 'sendtextmt',
            'CONTENT' => 'hi from aqsa',
            'SENDER' => '0506940095',
            'TO' => '0522212777',
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Text sent successfully!');
        } else {
            return back()->with('error', 'Failed to send text.');
        }
    }
}
