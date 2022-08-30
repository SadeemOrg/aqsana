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
        
        $vision_main = nova_get_setting('vision_section_text', 'default_value');
        $vision_sub_text_Main = nova_get_setting('sup_text_vision_aboutus', 'default_value');

        $goalsjson = nova_get_setting('goals', 'default_value');
        $goals = json_decode($goalsjson);
        
        $text_main_workplace = nova_get_setting('text_main_workplace', 'default_value');
        $sub_text_workplace = nova_get_setting('sup_text_workplace', 'default_value');

        $achievementsjson = nova_get_setting('achievements', 'default_value');
        $achievements = json_decode($achievementsjson);
      
        $about_us = [
            "main_text"=>$aboutUs_main,
            "sub_main_text"=>$aboutUs_sub_text_Main,
            "vision_main" => $vision_main,
            "vision_sub_text_Main" => $vision_sub_text_Main,
            "goals" => $goals,
            "text_main_workplace" => $text_main_workplace,
            "sub_text_workplace" => $sub_text_workplace,
            "achievements" => $achievements

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


    public function social_media(){
        $facebook = nova_get_setting('facebook', 'default_value');
        $instagram = nova_get_setting('instagram', 'default_value');
        $twitter = nova_get_setting('twitter', 'default_value');
      
        $social_media = [
            "facebook"=>$facebook,
            "instagram"=>$instagram,
            "twitter"=>$twitter,

        ];
        return $this->sendResponse($social_media, 'social media information');
    }
}
