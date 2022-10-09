<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Futureecom\OmnipayTranzila\TranzilaGateway;

class PaymentController extends BaseController
{
   public function sendMoney1(Request $request){
    $validator =  Validator::make($request->all(),[
        'amount' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validate Error', $validator->errors());
    }
    /** @var TranzilaGateway $gateway */
    $response = $gateway->authorize([
        'amount' => '10.00',
        'currency' => 'ILS',
        'myid' => '12345678',
        'card' => [
            'ccno' => '4444333322221111',
            'expdate' => '1225',
            'mycvv' => '1234',
        ],
    ])->send();
    return $this->sendResponse($response, 'Success payment');

   }

   public function sendMoney(){
    $tranzila_api_host  =  'secure5.tranzila.com'; 
    $tranzila_api_path  =  '/cgi-bin/tranzila71u.cgi';
    
    // Prepare transaction parameters 
    // Prepare transaction parameters
    $query_parameters['supplier'] = 'alaqsaqudstok-9049770';// 'TERMINAL_NAME' should be replaced by actual terminal name
    $query_parameters['sum'] = '5'; //Transaction sum 
    $query_parameters['tranmode'] = 'A';
    $query_parameters['currency'] = '1'; //Type of currency 1 NIS, 2 USD, 978 EUR, 826 GBP, 392 JPY
    $query_parameters['ccno'] = '12312312'; // Test card number
    $query_parameters['expdate'] = '0820'; // Card expiry date: mmyy
    $query_parameters['myid'] = '12312312'; //ID number if required
    $query_parameters['mycvv'] = '123'; // number if required
    $query_parameters['cred_type'] = '1'; // This field specifies the type of transaction, 1 - normal transaction, 6 - credit, 8 - payments
    // $query_parameters['TranzilaPW'] = 'cdEf';
    
    $query_string = '' ; 
    foreach($query_parameters as $name => $value) { 
        $query_string .= $name.'='.$value.'&' ; 
    }
    
    $query_string  =  substr($query_string ,  0 ,  - 1 ) ;  // Remove trailing '&'
    
    // Initiate CURL
    $cr = curl_init();
    
    curl_setopt($cr, CURLOPT_URL, "https://$tranzila_api_host$tranzila_api_path");
    curl_setopt($cr, CURLOPT_POST, 1);
    curl_setopt($cr, CURLOPT_FAILONERROR, true);
    curl_setopt($cr, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cr, CURLOPT_SSL_VERIFYPEER, 0);
 
    
    // Execute request
    $result = curl_exec($cr);
    $error = curl_error($cr);
    
    if (!empty($error)) {
        die ($error);
    }
    curl_close($cr);
    
    
    // Preparing associative array with response data 
    $response_array = explode('&',$result); 
    $response_assoc = array(); 
    if(count($response_array) > 1){ 
        foreach($response_array as $value){ 
            $tmp = explode('=',$value); 
            if  (count($tmp) > 1 ){ 
                $response_assoc [$tmp[0]] = $tmp[1]; 
            } 
        } 
    }
    
    // Analyze the result string 
    if(!isset($response_assoc['Response'])){ 
        // die($result."\n"); 
        return $this->sendError($result);
        /**
         * When there is no 'Response' parameter it either means
         * that some pre-transaction error happened (like authentication
         * problems), in which case the result string will be in HTML format,
         * explaining the error, or the request was made for generate token only
         * (in this case the response string will only contain 'TranzilaTK'
         * parameter)
         */
    }else if($response_assoc['Response'] !== '000'){ 
        // die($response_assoc['Response']."\n"); 
        return $this->sendResponse($response_assoc['Response'], 'Success ');
        // Any other than '000' code means transaction failure 
        // (bad card, expiry, etc ..) 
    }else{ 
        return $this->sendResponse($response_assoc['Response'], 'Success payment');

    }
   }
}
