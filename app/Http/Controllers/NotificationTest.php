<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use DB;
use App\ProfileMeta;
use App\PrivacyPolicy;
use App\Faq;
use App\Guidelines;
class NotificationTest extends Controller
{
    function sendNotfiy(){
        $token = "eU1k7vgH1FASnTlH5gZPAr:APA91bHBhNH8P71N6fCKakQFZxH2XaUQkIwl8J6HX0wEb4XGtH84rtU_LQ0ovz0y0uGLqoayq2ax420psis3HkwOMPvF_6rmF9-oMi8q3F2XLw_YdhREL0k0fmWB_qbGHUJiypMJtGeA";  
        $from = "AAAAA_Hl3RU:APA91bG0Fqxoqxi703Ov637hTwDZx99ezBvlcpETyJOyXod65v2Wp9KVM-Bk_uGAYGyBmTpjbcp_RO9B8Y9P_AhM9K1DuB10zEHriHAFRcmrGrSMIQdKg-Scf05TWgN5ugdwnipdY3mv";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "http://url-to-an-icon/icon.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to' => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
        curl_close( $ch );
        return back();
      
    }
}