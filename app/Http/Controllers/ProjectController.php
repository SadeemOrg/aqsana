<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Volunteer;
use App\Models\ProjectCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
  
        $projects = Project::where("project_type","1")->orderBy('created_at', 'desc')->paginate(15);

        $projects->map(function($project){
            $check_volunteer = Volunteer::where("user_id",Auth()->id())->where("project_id",$project->id)->first();
            
            if($check_volunteer != null) {
                if($check_volunteer->status == "0"){
                   $project->is_volunteer_user = 0;
                } else {
                    $project->is_volunteer_user = 1;
               }
    
            } else {
                $project->is_volunteer_user = 0; 
            }

            $projectCities = ProjectCity::where("project_id",$project->id)->with('City')->get();
            $projectCitiesString = "";
            if($projectCities != null && !empty($projectCities)) {
            
                for($i=0; $i< count($projectCities);$i++){
                    $city = $projectCities[$i]; 
                    if($projectCitiesString == "") {
                        $projectCitiesString = $city->city->name;
                    } else {
                        $projectCitiesString = $projectCitiesString.','.$city->city->name;
                    }
                   
                }
            
            }

            $project->projectCities = $projectCitiesString;

        });

       


        return $this->sendResponse($projects, 'Success get projects');

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
