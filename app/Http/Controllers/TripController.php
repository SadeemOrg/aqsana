<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CPU\Helpers;
use App\Models\QawafilAlaqsa;
use App\Models\TripBooking;
use Carbon\Carbon;
use DateTime;
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



        $trips = Project::where("id", 251)->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())


            ->latest('id')->take(5)->get();

        $trips->map(function ($trip) use ($request) {
            $trip->start_date = $trip->start_date;
            $trip->start_date = $trip->start_date;
            $trip->end_date = $trip->end_date;
            if (($trip->tripfrom) != null) {

                $from_latlng = ($trip->tripfrom);

                $from_lat = $from_latlng?->current_location['latitude'];
                $from_lng =$from_latlng?->current_location['longitude'];// $from_latlng->longitude;
            } else {
                $from_lat = 180;
                $from_lng = -180;
            }


            if (($trip->tripto) != null) {
                $to_latlng = ($trip->tripto);
                $to_lat = $to_latlng?->current_location['latitude'];
                $to_lng = $to_latlng?->current_location['longitude'];
            } else {
                $to_lat = 180;
                $to_lng = -180;
            }

            $from_distance = Helpers::distance($request->lat,$request->lng,$from_lat,$from_lng,'K');
            $trip->from_distance = round($from_distance, 2);


            $to_distance = Helpers::distance($request->lat,$request->lng,$to_lat,$to_lng,'K');
            $trip->to_distance = round($to_distance, 2);

            if (Auth()->id() != null) {
                $trip_bokking = TripBooking::where('user_id', Auth()->id())->where('project_id', $trip->id)->first();

                if ($trip_bokking != null) {
                    if ($trip_bokking->status == 1) {
                        $trip->isBooking = 1;
                    } else {
                        $trip->isBooking = 0;
                    }
                } else {
                    $trip->isBooking = 0;
                }
            } else {
                $trip->isBooking = 0;
            }
        });

        $trips = $trips->skip($request->get("skip"));
        $trips = $trips->sortBy('from_distance');
        $trips = $trips->values()->all();

        // dd($trips);

        return $this->sendResponse($trips, 'Success get Trips');
    }


    public function getNearAndBokkingTrip(Request $request)
    {



        if (Auth()->id() != null) {

            $trip_bokking = TripBooking::where('user_id', Auth()->id())->first();
            if ($trip_bokking != null) {
                $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                    ->orderBy('created_at', 'desc')->where('id', $trip_bokking->project_id)->get();
            } else {
                $trips = Project::where("project_type", "2")->orWhere("project_type", "3")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                    ->orderBy('created_at', 'desc')->get();
            }
        } else {
            $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                ->orderBy('created_at', 'desc')->get();
        }



        $trips->map(function ($trip) use ($request) {


            if (($trip->tripfrom) != null) {
                $from_latlng = ($trip->tripfrom);
                $from_lat = $from_latlng->latitude;
                $from_lng = $from_latlng->longitude;
            } else {
                $from_lat = 180;
                $from_lng = -180;
            }


            if (($trip->tripto) != null) {
                $to_latlng = ($trip->tripto);
                $to_lat = $to_latlng->latitude;
                $to_lng = $to_latlng->longitude;
            } else {
                $to_lat = 180;
                $to_lng = -180;
            }


            $from_distance = Helpers::distance($request->lat, $request->lng, $from_lat, $from_lng, 'K');
            $trip->from_distance = round($from_distance, 2);


            $to_distance = Helpers::distance($request->lat, $request->lng, $to_lat, $to_lng, 'K');
            $trip->to_distance = round($to_distance, 2);


            if (Auth()->id() != null) {
                $trip_bokking = TripBooking::where('user_id', Auth()->id())->where('project_id', $trip->id)->first();

                if ($trip_bokking != null) {
                    if ($trip_bokking->status == 1) {
                        $trip->isBooking = 1;
                    } else {
                        $trip->isBooking = 0;
                    }
                } else {
                    $trip->isBooking = 0;
                }
            } else {
                $trip->isBooking = 0;
            }
        });

        $trip = $trips->sortBy('from_distance')->first();


        return $this->sendResponse($trip, 'Success get Trips');
    }


    public function search_trip(Request $request)
    {


        $trips = Project::where("project_type", "2")->orWhere("project_type", "3")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->whereDate('end_date', '>=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->get();

        $search_trip = collect();
        $trips->map(function ($trip) use ($request, $search_trip) {

            if (($trip->tripfrom) != null) {
                $from_latlng = ($trip->tripfrom);
                $from_lat = $from_latlng->latitude;
                $from_lng = $from_latlng->longitude;
            } else {
                $from_lat = 180;
                $from_lng = -180;
            }


            if (($trip->tripto) != null) {
                $to_latlng = ($trip->tripto);
                $to_lat = $to_latlng->latitude;
                $to_lng = $to_latlng->longitude;
            } else {
                $to_lat = 180;
                $to_lng = -180;
            }


            $from_distance = Helpers::distance($request->lat, $request->lng, $from_lat, $from_lng, 'K');
            $trip->from_distance = round($from_distance, 2);


            $to_distance = Helpers::distance($request->lat, $request->lng, $to_lat, $to_lng, 'K');
            $trip->to_distance = round($to_distance, 2);


            if (Auth()->id() != null) {
                $trip_bokking = TripBooking::where('user_id', Auth()->id())->where('project_id', $trip->id)->first();

                if ($trip_bokking != null) {
                    if ($trip_bokking->status == 1) {
                        $trip->isBooking = 1;
                    } else {
                        $trip->isBooking = 0;
                    }
                } else {
                    $trip->isBooking = 0;
                }
            } else {
                $trip->isBooking = 0;
            }

            if (($trip->tripfrom) != null) {

                $tripfrom = json_decode($trip->tripfrom)->current_location;

                $trip_to_value = $tripfrom->formatted_address;


                if (stripos($trip_to_value, $request->get("search")) !== false) {
                    $search_trip->push($trip);
                }
            }
        });


        return $this->sendResponse($search_trip, 'Success get Trips');
    }

    public function auto_compleate_search_trip(Request $request)
    {


        $trips = Project::where("project_type", "2")->orWhere("project_type", "3")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->orderBy('created_at', 'desc')->get();

        $search_trip = collect();
        $trips->map(function ($trip) use ($request, $search_trip) {

            if ($trip->tripto != null) {
                $tripfrom = $trip->tripfrom->current_location;
                dump($tripfrom);
                // $trip_to_value = $tripfrom?->formatted_address;

                // if(stripos($trip_to_value,$request->get("search")) !== false){

                //     if($search_trip->search($tripfrom->formatted_address) === false) {
                //         $search_trip->push($tripfrom?->formatted_address);
                //     }

                // }
            }
        });




        return $this->sendResponse($search_trip, 'Success get Trips');
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
