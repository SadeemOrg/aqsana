<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }
    public function CompletNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['read_at' => Carbon::now()]);
    }
    public function AddNoteNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['note' => $request->NotificationsNote]);
    }

    public function UNCompletNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['read_at' => null]);
    }
    public function myNotification()
    {

        $user = Auth::user();
        $Notifications = \App\Models\Notification::where('notifiable_id', $user->id)->get();
        $myNotifications = array();
        foreach ($Notifications as $key => $value) {
            // echo $value->type;
            // echo $value->id;
            // dd($value);

            $data = json_decode($value->data);
            $pus = array(

                "id" => $value->id,
                "Notifications" => $data,
                "done" => $value->read_at,
                "note" => $value->note,

            );
            array_push($myNotifications, $pus);
        }
        return $myNotifications;
    }
    public function AdminNotifications(Request $request)
    {
        $user = Auth::user();
        $myNotifications = array();

        if ((in_array('super-admin',   $user->userrole()))) {
            $Notifications = \App\Models\Notification::where('notifiable_id', $request->user)->get();
            foreach ($Notifications as $key => $value) {
                // echo $value->type;
                // echo $value->id;
                // dd($value);

                $data = json_decode($value->data);
             if($user)
                $pus = array(

                    "id" => $value->id,
                    "Notifications" => $data,
                    "note" => $value->note,
                    "done" => $value->read_at,

                );
                array_push($myNotifications, $pus);
            }
        } else {
            $Notifications = \App\Models\Notification::where('notifiable_id', $request->user)->get();

            foreach ($Notifications as $key => $value) {
                // echo $value->type;
                // echo $value->id;
                // dd($value);

                $data = json_decode($value->data);

                if($user->id ==  $data->sender_id)
                {
                   $pus = array(

                       "id" => $value->id,
                       "Notifications" => $data,
                       "note" => $value->note,
                       "done" => $value->read_at,

                   );
                   array_push($myNotifications, $pus);
                }
            }
        }


        return $myNotifications;
    }
    public function sendNotification(Request $request)
    {

        $userSchema = User::find($request->user);
        // dd(  $userSchema);
        // dd($request->user);
        $offerData = $request->Notifications;
        $date = $request->date;
        // dd($date);
        // Auth::user()->notify(new PostNotif());
        Notification::send($userSchema, new TasksNotification($offerData, $date));
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where('id',$userSchema->id)->pluck('device_key')->all();
        // dd($FcmToken);

        $serverKey = 'AAAAJz9jvcE:APA91bGNRoHzz8sk5aw3EJmqynwyrSMPIxkwbnxdM-rfZelMvZnsosFiEKHjrFMI8bj_jUsG1yM1sg9WgpL0SpvXlOEQYM6cJQEkAQUdv_pA6iQoDA5_2fZuvcuWsIVpwM1DC5a1ymJM';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => Auth::user()->name,
                "body" => $request->Notifications,
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);

        // $userSchema->notify($userSchema, new TasksNotification($offerData,$date));
        return 'Task completed!';
    }

    public function sendSmsNotificaition()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('89302929', 'EcfCP1BjWhrTWJNZ');
        $client = new \Nexmo\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("972506940095", "Al-Aqsa-Association", 'Al-Aqsa-Association SMS API')
        // );

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("970569465465", "Al_Aqsa_Association", 'alaqsa test maseg')
        );


        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
    // public function sendOfferNotification() {
    //     $userSchema =Auth::user();

    //     $offerData ='aa';

    //     Notification::send($userSchema, new TasksNotification($offerData));

    //     dd('Task completed!');
    // }
}
