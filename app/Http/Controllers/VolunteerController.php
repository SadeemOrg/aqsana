<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Volunteer;
class VolunteerController extends BaseController
{
    public function store(Request $request){
        $validator =  Validator::make($request->all(),[
            'project_id' => 'required|string',
            'user_id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $check_volunteer = Volunteer::where("user_id",$request['user_id'])->where("project_id",$request['project_id'])->first();

        if($check_volunteer != null) {
            if($check_volunteer->status == "0"){
                $check_volunteer->status = '1';
                $check_volunteer->save();
                return $this->sendResponse($check_volunteer, 'Volunteering has been done');
            } else {
                return $this->sendError('Error', ["message"=>"I have already volunteered for this project"]);
            }

        }

        $volunteer =  Volunteer::create([
            'project_id' => $request['project_id'],
            'user_id'=> $request['user_id'],
            'status' => '1',
            ]);
        return $this->sendResponse($volunteer, 'Success create volunteer');
    }

    public function cancel_volunteering(Request $request){
        $validator =  Validator::make($request->all(),[
            'id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $volunteer = Volunteer::where("id",$request->get("id"))->first();

        $volunteer->status = '0';
        $volunteer->save();
        return $this->sendResponse([], 'Volunteer has been cancelled');

    }

    public function get_volunteering_user(Request $request){
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $volunteering_user = Volunteer::where("user_id",$request->get("user_id"))->with('Project')->get();

        return $this->sendResponse($volunteering_user, 'Success get Volunteer user');

    }
}