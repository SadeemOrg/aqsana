<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CPU\Helpers;
use App\Models\TripBooking;
use Illuminate\Support\Facades\Auth;

class TripController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    

        $trips = Project::where("project_type","2")->with('TripCity.City','BusTrip.travelto','BusTrip.travelfrom','tripfrom','tripto')
        ->orderBy('created_at', 'desc')->get();


        $trips->map(function($trip) use ($request){
        $from_latlng = json_decode($trip->tripfrom->current_location)->latlng;
        $from_lat = $from_latlng->lat;
        $from_lng = $from_latlng->lng;

        $to_latlng = json_decode($trip->tripto->current_location)->latlng;
        $to_lat = $to_latlng->lat;
        $to_lng = $to_latlng->lng;

        $from_distance = Helpers::distance($request->lat,$request->lng,$from_lat,$from_lng,'K'); 
        $trip->from_distance = round($from_distance, 2);


        $to_distance = Helpers::distance($request->lat,$request->lng,$to_lat,$to_lng,'K'); 
        $trip->to_distance = round($to_distance, 2);
        });

        $trips = $trips->skip($request->get("skip"));
        $trips = $trips->sortBy('from_distance');
        $trips = $trips->values()->all();


       
        return $this->sendResponse($trips, 'Success get Trips');

    }


    public function getNearAndBokkingTrip(Request $request)
    {
    


        if(Auth()->id() != null){

            $trip_bokking = TripBooking::where('user_id',Auth()->id())->first();
            if($trip_bokking != null) {
                $trips = Project::where("project_type","2")->with('TripCity.City','BusTrip.travelto','BusTrip.travelfrom','tripfrom','tripto')
                ->orderBy('created_at', 'desc')->where('id',$trip_bokking->project_id)->get();
            } else {
                $trips = collect();
            }
            
        } else{
            $trips = Project::where("project_type","2")->with('TripCity.City','BusTrip.travelto','BusTrip.travelfrom','tripfrom','tripto')
            ->orderBy('created_at', 'desc')->get();
        }
       


        $trips->map(function($trip) use ($request){
        $from_latlng = json_decode($trip->tripfrom->current_location)->latlng;
        $from_lat = $from_latlng->lat;
        $from_lng = $from_latlng->lng;

        $to_latlng = json_decode($trip->tripto->current_location)->latlng;
        $to_lat = $to_latlng->lat;
        $to_lng = $to_latlng->lng;

        $from_distance = Helpers::distance($request->lat,$request->lng,$from_lat,$from_lng,'K'); 
        $trip->from_distance = round($from_distance, 2);


        $to_distance = Helpers::distance($request->lat,$request->lng,$to_lat,$to_lng,'K'); 
        $trip->to_distance = round($to_distance, 2);
        });

        $trip = $trips->sortBy('from_distance')->first();
       
       
        return $this->sendResponse($trip, 'Success get Trips');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        //
    }
}
