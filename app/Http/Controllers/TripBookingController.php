<?php

namespace App\Http\Controllers;


use App\Models\TripBooking;
use App\Models\Bus;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TripBookingController extends BaseController
{
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'project_id' => 'required|string',
            'number_of_people' => 'required',
            'number_phone' => 'required',



        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }


        $check_trip_booking = TripBooking::where("user_id", Auth()->id())->where("project_id", $request['project_id'])->first();

        if ($check_trip_booking != null) {
            if ($check_trip_booking->status == "0") {
                $check_trip_booking->status = '1';
                $check_trip_booking->save();

                return $this->sendResponse($check_trip_booking, 'لم تم  حجز الرحلة بنجاح');
            } else {
                return $this->sendError('Error', ["message" => "لقد قمت بلحجز مسبقا"], 202);
            }
        }


        $projext = Project::where('id', $request['project_id'])->with('bus')->first();
        $buss = $projext->bus;
        $IsFull = 1;
        $BusId = null;

        foreach ($buss as $key => $bus) {
            if ($IsFull == 1) {
                $number_of_people =  TripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                ])->sum('number_of_people');
                $number_of_people += $request['number_of_people'];
                if (($number_of_people  <= $bus->number_of_seats)) {
                    $IsFull = 0;
                    $BusId = $bus->id;
                }
            }
        }
        if ($IsFull == 0) {
            $tripBooking =  TripBooking::create([
                'project_id' => $request['project_id'],
                'bus_id' => $BusId,
                'user_id' => Auth()->id(),
                'booking_type' => "1",
                'status' => '1',
                'number_of_people' => $request['number_of_people'],
                'reservation_amount' => '0.0',
                'number_phone' => $request['number_phone'],
            ]);
            //sms
            Http::get('https://la.cellactpro.com/http_req.asp', [
                'FROM' => 'ppAksa',
                'USER' => 'ppAksa',
                'PASSWORD' => 'UKFV6Sx7',
                'APP' => 'LA',
                'CMD' => 'sendtextmt',
                'CONTENT' => 'تم الحجز بنجاح',
                'SENDER' => '0506940095',
                'TO' => $request['number_phone'],
            ]);
            return $this->sendResponse($tripBooking, 'تم الحجز بنجاح');
        } else {
            return $this->sendError('Error', ["message" => "ناسف! الباص ممتلئ"], 202);
        }
    }

    public function cancel_trip_booking(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }
        TripBooking::where('project_id', $request->get('id'))
            ->where('user_id', Auth()->id())
            ->delete();
        return $this->sendResponse([], 'Trib booking has been cancelled');
    }

    public function get_trip_booking_user(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'user_id' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }

        if ($request->status == "0") {
            $trip_booking_user = TripBooking::where("user_id", $request->get("user_id"))->where("status", "0")->with('Project')->paginate(15);
        }
        $trip_booking_user = TripBooking::where("user_id", $request->get("user_id"))->where("status", "1")->with('Project')->paginate(15);


        return $this->sendResponse($trip_booking_user, 'Success get trib booking user');
    }


    public function search_trip(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'travel_to' => 'required|string',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validate Error', $validator->errors());
        }


        $search_trips = Bus::where("travel_to", $request->get("user_id"))->where("status", "like", "%" . $request->get("travel_to") . "%")->with('Project')->get();


        return $this->sendResponse($search_trips, 'Success get trib');
    }
}
