<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\FormMassage;
use Illuminate\Support\Facades\Validator;
class SettingController extends BaseController
{
    public function about_us(){
        $aboutUs_main = nova_get_setting('main_section_text', 'default_value');
        $aboutUs_sub_text_Main = nova_get_setting('sup_text_main_aboutus', 'default_value');
      
        $about_us = [
            "main_text"=>$aboutUs_main,
            "sub_main_text"=>$aboutUs_sub_text_Main,

        ];
        return $this->sendResponse($about_us, 'Contuct us information');
    }

    public function contact_us(){
      
        $phone_contact = nova_get_setting('phone_Connectus', 'default_value');
        $email_contact = nova_get_setting('email_Connectus', 'default_value');

        $contact_us = [
            "phone"=>$phone_contact,
            "email"=>$email_contact,

        ];

        return $this->sendResponse($contact_us, 'Contuct us information');


    }

    public function report_problem(Request $request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required|string',
            'message' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        FormMassage::create([
            'name' => $request['name'],
            'phone'=> $request['phone'],
            'message' =>$request['message'],
            ]);
        return $this->sendResponse([], 'Success Send Report');
    }
}
