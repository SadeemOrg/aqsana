<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CPU\Helpers;

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
        ->orderBy('created_at', 'desc')->paginate(15);

        $next_page_url = json_encode($trips,true);
        $next_page_url = json_decode($next_page_url)->next_page_url;

        $trips->map(function($trip) use ($request){
        $from_latlng = json_decode($trip->tripfrom->current_location)->latlng;
        $from_lat = $from_latlng->lat;
        $from_lng = $from_latlng->lng;

        $to_latlng = json_decode($trip->tripto->current_location)->latlng;
        $to_lat = $to_latlng->lat;
        $to_lng = $to_latlng->lng;

        $from_distance = Helpers::distance($request->lat,$request->lng,$from_lat,$from_lng,'K'); 
        $trip->from_distance = $from_distance;


        $to_distance = Helpers::distance($request->lat,$request->lng,$to_lat,$to_lng,'K'); 
        $trip->to_distance = $to_distance;
        });


        $trips = $trips->sortBy('from_distance');
        $trips = $trips->values()->all();

        $trips = ["data"=>$trips,"next_page_url"=>$next_page_url];
       
        return $this->sendResponse($trips, 'Success get Trips');

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
