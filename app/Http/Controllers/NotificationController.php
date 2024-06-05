<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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
    public function receivedNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['status' =>2]);
        $Notification =   \App\Models\Notification::where('id', $request->Notificationsid)->first();

        $new_data =  $Notification->replicate();
        $new_data->id = (string) Str::uuid();
        $new_data->notifiable_id = $new_data->data['sender_id'];
        $new_data->note = 'تم استلام المهمة';

        $data = $new_data->data;
        $data['sender_id'] = Auth::id();
        $data['date'] = Carbon::now()->format('Y-m-d');

        $new_data->data = $data;

        $new_data->notification_type = 2;
        $new_data->status = 2;
        $new_data->save();
    }
    public function WorkOnNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['status' =>3]);
        $Notification =   \App\Models\Notification::where('id', $request->Notificationsid)->first();

        $new_data =  $Notification->replicate();
        $new_data->id = (string) Str::uuid();
        $new_data->notifiable_id = $new_data->data['sender_id'];
        $new_data->note = 'جاري العمل على المهمة ';

        $data = $new_data->data;
        $data['sender_id'] = Auth::id();
        $data['date'] = Carbon::now()->format('Y-m-d');

        $new_data->data = $data;

        $new_data->notification_type = 2;
        $new_data->status = 2;
        $new_data->save();
    }
    public function CompletNotifications(Request $request)
    {\App\Models\Notification::where('id', $request->Notificationsid)->update([
        'read_at' => Carbon::now(),
        'status' => 4,
    ]);
        $Notification =   \App\Models\Notification::where('id', $request->Notificationsid)->first();

        $new_data =  $Notification->replicate();
        $new_data->id = (string) Str::uuid();
        $new_data->notifiable_id = $new_data->data['sender_id'];
        $new_data->note = 'تم انجاز المهمة';

        $data = $new_data->data;
        $data['sender_id'] = Auth::id();
        $data['date'] = Carbon::now()->format('Y-m-d');

        $new_data->data = $data;

        $new_data->notification_type = 2;
        $new_data->status = 4;
        $new_data->save();
    }
    public function DeleteNotifications(Request $request)
    {


        $Notification =   \App\Models\Notification::where('id', $request->Notificationsid)->first();

        $new_data =  $Notification->replicate();
        $new_data->id = (string) Str::uuid();
        $new_data->notifiable_id = $new_data->data['sender_id'];
        $new_data->note = 'تم حذف المهمة';

        $data = $new_data->data;
        $data['sender_id'] = Auth::id();
        $data['date'] = Carbon::now()->format('Y-m-d');

        $new_data->data = $data;

        $new_data->notification_type = 2;
        $new_data->status = 5;
        $new_data->save();
        \App\Models\Notification::where('id', $request->Notificationsid)->delete();

    }
    public function AddNoteNotifications(Request $request)
    {
        $Notification =  \App\Models\Notification::where('id', $request->Notificationsid)->update(['note' => $request->NotificationsNote]);
    }

    public function UNCompletNotifications(Request $request)
    {
        \App\Models\Notification::where('id', $request->Notificationsid)->update(['read_at' => null]);
    }
    public function myNotification()
    {

        $user = Auth::user();
        $Notifications = \App\Models\Notification::where([['notifiable_id', $user->id], ['notification_type', 1]])->get();
        $Notifications =  $Notifications->sortByDesc(function ($item) {
            return data_get($item->data, 'date');
        });

        $myNotifications = array();
        foreach ($Notifications as $key => $value) {


            $data = $value->data;
            $sender = user::find($data['sender_id']);

            $pus = array(
                "sender" => $sender,
                "id" => $value->id,
                "Notifications" => $data,
                "done" => $value->read_at,
                "note" => $value->note,
                "status" => $value->status,


            );
            array_push($myNotifications, $pus);
        }
        return $myNotifications;
    }
    public function myAlert()
    {

        $user = Auth::user();
        $Notifications = \App\Models\Notification::where([['notifiable_id', $user->id], ['notification_type', 2]])->get();
        $Notifications =  $Notifications->sortByDesc(function ($item) {
            // Access the field within the JSON column
            return data_get($item->data, 'date');
        });

        $myNotifications = array();
        foreach ($Notifications as $key => $value) {


            $data = $value->data;
            $sender = user::find($data['sender_id']);

            $pus = array(
                "sender" => $sender,
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

            $Notifications = \App\Models\Notification::where([['notifiable_id',  $request->user], ['notification_type', 1]])->get();
            $Notifications =  $Notifications->sortByDesc(function ($item) {
                // Access the field within the JSON column
                return data_get($item->data, 'date');
            });
            foreach ($Notifications as $key => $value) {
                // echo $value->type;
                // echo $value->id;
                // dd($value);

                $data = $value->data;
                if ($user)
                    $pus = array(

                        "id" => $value->id,
                        "Notifications" => $data,
                        "note" => $value->note,
                        "done" => $value->read_at,
                        "status" => $value->status,



                    );
                array_push($myNotifications, $pus);
            }
        } else {
            $Notifications = \App\Models\Notification::where('notifiable_id', $request->user)->get();
            $Notifications =  $Notifications->sortByDesc(function ($item) {
                // Access the field within the JSON column
                return data_get($item->data, 'date');
            });
            foreach ($Notifications as $key => $value) {
                // echo $value->type;
                // echo $value->id;
                // dd($value);

                $data = $value->data;

                if ($user->id ==  $data['sender_id']) {
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
        $offerData = $request->Notifications;
        $date = $request->date;
        // dd($date);
        // Auth::user()->notify(new PostNotif());
        Notification::send($userSchema, new TasksNotification($offerData, $date, $userSchema));
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::where('id', $userSchema->id)->pluck('device_key')->all();
        // dd($FcmToken);
        $serverKey = 'AAAAA_Hl3RU:APA91bG0Fqxoqxi703Ov637hTwDZx99ezBvlcpETyJOyXod65v2Wp9KVM-Bk_uGAYGyBmTpjbcp_RO9B8Y9P_AhM9K1DuB10zEHriHAFRcmrGrSMIQdKg-Scf05TWgN5ugdwnipdY3mv';

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
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return 'Task completed!';
    }

    public function sendSmsNotificaition()
    {
        // dd("dd");
        $basic  = new \Nexmo\Client\Credentials\Basic('57112870', '5ixeBL0HfF56OxIa');
        $client = new \Nexmo\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("972506940095", "Al-Aqsa-Association", 'Al-Aqsa-Association SMS API')
        // );

        $response = $client->sms()->send(

            new \Vonage\SMS\Message\SMS("972507593658", "Al_Aqsa_Association", 'alaqsa test maseg')
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
