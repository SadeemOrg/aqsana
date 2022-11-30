<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Auth;

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
        \App\Models\Notification::where('id',$request->Notificationsid) ->update(['read_at' =>' 2022-11-01 12:41:30']);

    }
    public function myNotification()
    {

       $user= Auth::user();
        $Notifications= \App\Models\Notification::where('notifiable_id', $user->id)->get();
       $myNotifications = array();
       foreach ($Notifications as $key => $value) {
        // echo $value->type;
        // echo $value->id;
        // dd($value);

          $data=json_decode($value->data);
          $pus = array(
            "id" => $value->id,
            "Notifications" => $data,
            "done" => $value->read_at,

        );
          array_push($myNotifications, $pus);
        }
        return $myNotifications;
    }

    public function sendNotification(Request $request) {
        $userSchema = User::find($request->user);
        // dd(  $userSchema);
        // dd($request->user);
        $offerData = $request->Notifications;
        Notification::send($userSchema, new TasksNotification($offerData));

        dd('Task completed!');
    }
    public function sendOfferNotification() {
        $userSchema =Auth::user();

        $offerData ='aa';

        Notification::send($userSchema, new TasksNotification($offerData));

        dd('Task completed!');
    }
}
