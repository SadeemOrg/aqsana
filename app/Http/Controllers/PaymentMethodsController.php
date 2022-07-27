<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentMethodsController extends BaseController
{

    public function index(Request $request) {

        $validator =  Validator::make($request->all(),[
            'user_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $payment_methods = PaymentMethods::where("user_id",$request["user_id"])->get();
        return $this->sendResponse($payment_methods, 'Success get payment method');
    }


    public function store(Request $request){
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required|string',
            'type_card'=> 'required',
            'name_person'=>'required',
            'number_card'=>'required',
            "expiry_date"=>'required',
            'ccv'=>'required'

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }


        $payment_method =  PaymentMethods::create([
            'user_id'=> $request['user_id'],
            'type_card'=> $request['type_card'],
            'name_person'=>$request['name_person'],
            'number_card'=>$request['number_card'],
            "expiry_date"=>$request['expiry_date'],
            'ccv'=>$request['ccv']
            ]);
        return $this->sendResponse($payment_method, 'Success create payment method');
    }


    public function update(Request $request){
        $validator =  Validator::make($request->all(),[
            'id' => 'required|string',
        
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $payment_method =  PaymentMethods::where('id',$request['id'])->update([
            'user_id'=> $request['user_id'],
            'type_card'=> $request['type_card'],
            'name_person'=>$request['name_person'],
            'number_card'=>$request['number_card'],
            "expiry_date"=>$request['expiry_date'],
            'ccv'=>$request['ccv']
            ]);
        return $this->sendResponse($payment_method, 'Success update payment method');
    }



    public function delete(Request $request){
        $validator =  Validator::make($request->all(),[
            'id' => 'required|string',
        
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $payment_method =  PaymentMethods::where('id',$request['id'])->delete();
        return $this->sendResponse($payment_method, 'Success update payment method');
    }


}
