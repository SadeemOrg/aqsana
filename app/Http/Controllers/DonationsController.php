<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonationsController extends BaseController
{

    public function index(){

        $donations = Donations::where('user_id',Auth()->id())->with("project","bus")->get();

        return $this->sendResponse($donations, 'Success get all donations');
    }


    public function store(Request $request) {
        
        $validator =  Validator::make($request->all(),[
            'project_id' => 'required|string',
            'donor_name' => 'required|string',
            'donation_amount' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

       
        
        $donation = Donations::create([
            'project_id' => $request->get("project_id"),
            'project_type' => $request->get("project_type"),
            'donor_name' => $request->get("donor_name"),
            'amount' => $request->get("donation_amount"),
            'bus_id' => $request->get("bus_id"),
            'user_id' => Auth()->id(),
            'number_of_people' => $request->get("number_of_people"),

        ]);

        return $this->sendResponse($donation, 'Success create donation');
    }

   
}