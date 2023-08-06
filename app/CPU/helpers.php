<?php

namespace App\CPU;


class Helpers {

   public static function send_notification($tokens,$notification) {

            
            $server_key = "AAAAA_Hl3RU:APA91bG0Fqxoqxi703Ov637hTwDZx99ezBvlcpETyJOyXod65v2Wp9KVM-Bk_uGAYGyBmTpjbcp_RO9B8Y9P_AhM9K1DuB10zEHriHAFRcmrGrSMIQdKg-Scf05TWgN5ugdwnipdY3mv";
            $msg = array
                  (
                    'body'  => $notification->message,
                    'title' => $notification->title,
                    'receiver' => 'erw',
                    'icon'  => "http://url-to-an-icon/icon.png",/*Default Icon*/
                    'sound' => 'mySound'/*Default sound*/
                  );
    
            $fields = array
                    (
                        'registration_ids' => $tokens, 
                        'notification'  => $msg
                    );
    
            $headers = array
                    (
                        'Authorization: key=' . $server_key,
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

   public static function send_notification_topic($topic,$notification) {

    $server_key = "AAAAA_Hl3RU:APA91bG0Fqxoqxi703Ov637hTwDZx99ezBvlcpETyJOyXod65v2Wp9KVM-Bk_uGAYGyBmTpjbcp_RO9B8Y9P_AhM9K1DuB10zEHriHAFRcmrGrSMIQdKg-Scf05TWgN5ugdwnipdY3mv";
    $msg = array
          (
            'body'  => $notification->message,
            'title' => $notification->title,
            'receiver' => 'erw',
            'icon'  => "http://url-to-an-icon/icon.png",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
          );

    $fields = array
            (
                'to' => "/topics/$topic",
                'notification'  => $msg
            );

    $headers = array
            (
                'Authorization: key=' . $server_key,
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

public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
  
    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
  }

}

?>

