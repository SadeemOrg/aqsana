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



        $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())
            ->latest('id')->take(5)->get();

        $trips->map(function ($trip) use ($request) {

            $buss = $trip->bus;
            $number = 0;
            foreach ($buss as $key => $bus) {
                $number_of_people = TripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                    ['project_id', $trip->id],
                ])->sum('number_of_people');
                $number +=  ($bus->number_of_seats - $number_of_people);
            }
             $trip->number=$number;
             $trip->isFull = $number > 0 ? 0 : 1 ;




            $trip->tripToLocation = $trip->tripto->name_address;
            $trip->tripFromLocation = $trip->tripfrom->name_address;
            $trip->start_date = $trip->start_date;
            $trip->start_date = $trip->start_date;
            $trip->end_date = $trip->end_date;

            if (($trip->tripfrom) != null && isset($trip->tripfrom->current_location)) {
                $from_latlng = $trip->tripfrom;
                $from_lat = isset($from_latlng->current_location['latitude']) ? $from_latlng->current_location['latitude'] : 180;
                $from_lng = isset($from_latlng->current_location['longitude']) ? $from_latlng->current_location['longitude'] : -180;
            } else {
                $from_lat = 180;
                $from_lng = -180;
            }
            if (($trip->tripto) != null && isset($trip->tripto->current_location)) {
                $to_latlng = $trip->tripto;
                $to_lat = isset($to_latlng->current_location['latitude']) ? $to_latlng->current_location['latitude'] : 180;
                $to_lng = isset($to_latlng->current_location['longitude']) ? $to_latlng->current_location['longitude'] : -180;
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
        $trips = $trips->filter(function ($trip) {
            return $trip->from_distance < 20;
        })->sortBy('from_distance');
        $trips = $trips->skip($request->get("skip"));

        $trips = $trips->values()->all();


        return $this->sendResponse($trips, 'Success get Trips');
    }


    public function getNearAndBokkingTrip(Request $request)
    {



        if (Auth()->id() != null) {

            $trip_booking = TripBooking::where('user_id', Auth()->id())->first();
            if ($trip_booking != null) {
                $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                    ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())->where('id', $trip_booking->project_id)->get();
            } else {
                $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                    ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())->get();
            }
        } else {
            $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
                ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())->get();
        }

        $trips->map(function ($trip) use ($request) {

            $buss = $trip->bus;
            $number = 0;
            foreach ($buss as $key => $bus) {
                $number_of_people = TripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                    ['project_id', $trip->id],
                ])->sum('number_of_people');
                $number +=  ($bus->number_of_seats - $number_of_people);
            }
             $trip->number=$number;
             $trip->isFull = $number > 0 ? 0 : 1 ;


            $trip->tripToLocation = $trip->tripto->name_address;
            $trip->tripFromLocation = $trip->tripfrom->name_address;
            $trip->start_date = $trip->start_date;
            $trip->start_date = $trip->start_date;
            $trip->end_date = $trip->end_date;

            if (($trip->tripfrom) != null && isset($trip->tripfrom->current_location)) {
                $from_latlng = $trip->tripfrom;
                $from_lat = isset($from_latlng->current_location['latitude']) ? $from_latlng->current_location['latitude'] : 180;
                $from_lng = isset($from_latlng->current_location['longitude']) ? $from_latlng->current_location['longitude'] : -180;
            } else {
                $from_lat = 180;
                $from_lng = -180;
            }
            if (($trip->tripto) != null && isset($trip->tripto->current_location)) {
                $to_latlng = $trip->tripto;
                $to_lat = isset($to_latlng->current_location['latitude']) ? $to_latlng->current_location['latitude'] : 180;
                $to_lng = isset($to_latlng->current_location['longitude']) ? $to_latlng->current_location['longitude'] : -180;
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
        if (Auth()->id() != null && $trip_booking != null) {
            $trips = $trips->sortBy('from_distance');
        } else {
            $trips = $trips->filter(function ($trip) {
                return $trip->from_distance < 20;
            })->sortBy('from_distance');
        }



        $trip = $trips->first();


        return $this->sendResponse($trip, Carbon::now());
    }


    public function search_trip(Request $request)
    {


        $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->whereDate('end_date', '>=', date('Y-m-d H:i:s'))->orderBy('created_at', 'desc')->get();

        $search_trip = collect();
        $trips->map(function ($trip) use ($request, $search_trip) {

            $buss = $trip->bus;
            $number = 0;
            foreach ($buss as $key => $bus) {
                $number_of_people = TripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                    ['project_id', $trip->id],
                ])->sum('number_of_people');
                $number +=  ($bus->number_of_seats - $number_of_people);
            }
             $trip->number=$number;
             $trip->isFull = $number > 0 ? 0 : 1 ;

            $trip->tripToLocation = $trip->tripto->name_address;
            $trip->tripFromLocation = $trip->tripfrom->name_address;
            $trip->start_date = $trip->start_date;
            $trip->start_date = $trip->start_date;
            $trip->end_date = $trip->end_date;

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

            if ($trip->tripfrom != null) {
                $trip_to_value = $trip->tripfrom?->name_address;
                if (stripos($trip_to_value, $request->get("search")) !== false) {
                    $search_trip->push($trip);
                }
            }
        });


        return $this->sendResponse($search_trip, 'Success get Trips');
    }

    public function auto_compleate_search_trip(Request $request)
    {


        $trips = Project::where("project_type", "2")->with('TripCity.City', 'BusTrip.travelto', 'BusTrip.travelfrom', 'tripfrom', 'tripto')
            ->orderBy('created_at', 'desc')->where('start_date', '>', Carbon::now())
            ->get();

        $search_trip = collect();
        $filteredTrips = $trips->filter(function ($trip) use ($request, $search_trip) {
            if ($trip->tripfrom != null) {
                $trip_to_value = $trip->tripfrom?->name_address;
                if (stripos($trip_to_value, $request->get("search")) !== false) {
                    $search_trip->push($trip_to_value);

                    return true;
                }
            }
            return false;
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
