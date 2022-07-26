<?php

namespace App\Http\Controllers;

use App\Models\TripBooking;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripBookingController extends BaseController
{
    public function store(Request $request){
        $validator =  Validator::make($request->all(),[
            'project_id' => 'required|string',
            'user_id' => 'required|string',
            'number_of_people'=> 'required',
            'reservation_amount'=>'required'

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $check_trip_booking = TripBooking::where("user_id",$request['user_id'])->where("project_id",$request['project_id'])->first();

        if($check_trip_booking != null) {
            if($check_trip_booking->status == "0"){
                $check_trip_booking->status = '1';
                $check_trip_booking->save();
                return $this->sendResponse($check_trip_booking, 'Trib booking has been done');
            } else {
                return $this->sendError('Error', ["message"=>"I have already trib booking for this project"]);
            }

        }

        $tripBooking =  TripBooking::create([
            'project_id' => $request['project_id'],
            'user_id'=> $request['user_id'],
            'booking_type'=>"1",
            'status' => '1',
            'number_of_people'=> $request['number_of_people'],
            'reservation_amount'=> $request['reservation_amount'],
            ]);
        return $this->sendResponse($tripBooking, 'Success create trib booking');
    }

    public function cancel_trip_booking(Request $request){
        $validator =  Validator::make($request->all(),[
            'id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        $trip_booking = TripBooking::where("id",$request->get("id"))->first();

        $trip_booking->status = '0';
        $trip_booking->save();
        return $this->sendResponse([], 'Trib booking has been cancelled');

    }

    public function get_trip_booking_user(Request $request){
        $validator =  Validator::make($request->all(),[
            'user_id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        if($request->status == "0") {
            $trip_booking_user = TripBooking::where("user_id",$request->get("user_id"))->where("status","0")->with('Project')->paginate(15);

        }
        $trip_booking_user = TripBooking::where("user_id",$request->get("user_id"))->where("status","1")->with('Project')->paginate(15);


        return $this->sendResponse($trip_booking_user, 'Success get trib booking user');

    }


    public function search_trip(Request $request){
        $validator =  Validator::make($request->all(),[
            'travel_to' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

    
        $search_trips = Bus::where("travel_to",$request->get("user_id"))->where("status","like","%".$request->get("travel_to")."%")->with('Project')->get();


        return $this->sendResponse($search_trips, 'Success get trib');

    }
}
