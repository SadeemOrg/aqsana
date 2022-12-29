<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\TasksNotification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        \App\Models\Notification::where('id',$request->Notificationsid) ->update(['read_at' => Carbon::now()]);

    }

    public function UNCompletNotifications(Request $request)
    {
        \App\Models\Notification::where('id',$request->Notificationsid) ->update(['read_at' => null]);

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
    public function AdminNotifications(Request $request)
    {


        $Notifications= \App\Models\Notification::where('notifiable_id', $request->user)->get();
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
        $date= $request->date;
        // dd($date);
        Notification::send($userSchema, new TasksNotification($offerData,$date));

        return 'Task completed!';
    }
    // public function sendOfferNotification() {
    //     $userSchema =Auth::user();

    //     $offerData ='aa';

    //     Notification::send($userSchema, new TasksNotification($offerData));

    //     dd('Task completed!');
    // }
}
