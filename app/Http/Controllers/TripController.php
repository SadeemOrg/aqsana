<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    

        $projects = Project::where("project_type","2")->with('TripCity.City','BusTrip.travelto','BusTrip.travelfrom','tripfrom','tripto')->orderBy('created_at', 'desc')->paginate(15);
        return $this->sendResponse($projects, 'Success get Trips');

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
