<?php

namespace App\Nova;

use App\Models\Area;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Http\Requests\NovaRequest;
use Acme\MultiselectField\Multiselect;
use App\Nova\Actions\ApprovalRejectProjec;
use App\Nova\Actions\ProjectStatu;
use Illuminate\Support\Facades\Auth;
use App\Nova\Filters\ProjectStatus;
use App\Nova\Filters\Projectapproval;
use App\Models\ProjectType;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\hasOne;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Yassi\NestedForm\NestedForm;
use Laravel\Nova\Fields\BelongsToMany;
use AwesomeNova\Cards\FilterCard;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\HasOne as FieldsHasOne;

class project extends Resource
{
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'project_name';
    public static $group = 'project_name';
    public static $displayInNavigation = false;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     $id = Auth::id();
    //     $areas = DB::table('areas')->where('admin_id', $id)
    //     ->join('projects', 'projects.area_id', '=', 'areas.id')
    //     ->select('alhisalats.name')->get();
    //     $stack = array();
    //   foreach ( $areas as $key => $value) {
    //       array_push($stack, $value->name);
    //       // echo $value->name;
    //   }
    //     return $query->whereIn('name', $stack);
    // }
    public function fields(Request $request)
    {


        // 'is_reported','report_title','report_description','report_text','report_image','pictures',




        return [


            // new Tabs('Some Title', [
            //     'project detales'    => [

            //         ID::make(__('ID'), 'id')->sortable(),
            //         Text::make("project name", "project_name"),
            //         Text::make("project describe", "project_describe"),
            //         Text::make("project purpose", "purpose"),
            //         Select::make('Project type', 'type')
            //             ->options(function () {
            //                 $users =  \App\Models\ProjectType::all();

            //                 $user_type_admin_array =  array();

            //                 foreach ($users as $user) {
            //                     if ($user->Area == null) {


            //                         $user_type_admin_array += [$user['code'] => ($user['name'])];
            //                     }
            //                 }
            //                 return $user_type_admin_array;
            //             })->hideFromIndex()->hideFromDetail(),
            //         BelongsTo::make('Project Type', 'ProjectType', \App\Nova\ProjectType::class)->hideWhenCreating()->hideWhenUpdating(),
            //         Number::make("Budjet", 'Budjet'),
            //         Select::make('admin', 'admin_id',)
            //             ->options(function () {
            //                 $users =  \App\Models\User::where('user_role', '=', 'admin')->get();

            //                 $user_type_admin_array =  array();

            //                 foreach ($users as $user) {
            //                     $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
            //                 }

            //                 return $user_type_admin_array;
            //             }),
            //         Select::make('Project Status ', 'Project_Status')->options([
            //             '0' => 'Initial',
            //             '1' => 'Acceptable',
            //             '2  in progress' => 'project  in progress',
            //             '3' => 'locked',
            //             '4' => 'Collection the project',
            //         ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            //         DateTime::make('projec start', 'start_date'),
            //         DateTime::make('projec end', 'end_date'),
            //         Text::make("approval", "approval")->hideWhenCreating()->hideWhenUpdating(),
            //         Text::make("reason_of_reject", "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),
            //         // NestedForm::make('buses', 'buses', 'App\Nova\bus'),


            //         Select::make('is_reported Status ', 'is_reported')->options([
            //             '1' => 'yes',
            //             '0' => 'no',
            //         ])->displayUsingLabels(),


            //         NovaDependencyContainer::make([

            //             Text::make("project name", "report_title"),
            //             Textarea::make('description', 'report_description'),
            //             CKEditor::make('Contents', 'report_text')->hidefromindex(),
            //             Image::make('Image', 'report_image')->disk('public')->prunable(),
            //             ArrayImages::make('Pictures', 'pictures')
            //                 ->disk('public'),


            //         ])->dependsOn('is_reported', '1'),

            //         BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            //         BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            //         HasOne::make('buses')->hideWhenCreating()->hideWhenUpdating(),
            //         NestedForm::make('buses', 'buses', 'App\Nova\bus'),
            //     ],
            //     // HasOne::make('buses')->hideWhenCreating()->hideWhenUpdating(),
            //     // NestedForm::make('buses', 'buses', 'App\Nova\bus')->displayIf(function ($nestedForm, $request) {
            //     //     return [
            //     //         ['attribute' => 'type', 'is' => '8']
            //     //     ];
            //     // })

            // ]),




            // NestedForm::make('buses', 'buses', 'App\Nova\bus'),




            ID::make(__('ID'), 'id')->sortable(),
            Text::make("project name", "project_name"),
            Text::make("project describe", "project_describe"),
            Text::make("project purpose", "purpose"),
            Select::make('Project type', 'type')
                ->options(function () {
                    $users =  \App\Models\ProjectType::all();

                    $user_type_admin_array =  array();

                    foreach ($users as $user) {
                        if ($user->Area == null) {


                            $user_type_admin_array += [$user['code'] => ($user['name'])];
                        }
                    }
                    return $user_type_admin_array;
                })->hideFromIndex()->hideFromDetail(),
            BelongsTo::make('Project Type', 'ProjectType', \App\Nova\ProjectType::class)->hideWhenCreating()->hideWhenUpdating(),
            Number::make("Budjet", 'Budjet'),
            Select::make('admin', 'admin_id',)
                ->options(function () {
                    $users =  \App\Models\User::where('user_role', '=', 'admin')->get();

                    $user_type_admin_array =  array();

                    foreach ($users as $user) {
                        $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
                    }

                    return $user_type_admin_array;
                }),
            Select::make('Project Status ', 'Project_Status')->options([
                '0' => 'Initial',
                '1' => 'Acceptable',
                '2  in progress' => 'project  in progress',
                '3' => 'locked',
                '4' => 'Collection the project',
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            DateTime::make('projec start', 'start_date'),
            DateTime::make('projec end', 'end_date'),
            Text::make("approval", "approval")->hideWhenCreating()->hideWhenUpdating(),
            Text::make("reason_of_reject", "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),
            // NestedForm::make('buses', 'buses', 'App\Nova\bus'),


            Select::make('is_reported Status ', 'is_reported')->options([
                '1' => 'yes',
                '0' => 'no',
            ])->displayUsingLabels(),


            NovaDependencyContainer::make([

                Text::make("project name", "report_title"),
                Textarea::make('description', 'report_description'),
                CKEditor::make('Contents', 'report_text')->hidefromindex(),
                Image::make('Image', 'report_image')->disk('public')->prunable(),
                ArrayImages::make('Pictures', 'pictures')
                    ->disk('public'),


            ])->dependsOn('is_reported', '1'),

            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            HasOne::make('buses')->hideWhenCreating()->hideWhenUpdating(),
            NestedForm::make('buses', 'buses', 'App\Nova\bus'),







        ];
    }

    // public static function afterCreate(Request $request, $model)
    // {
    //     $id = Auth::id();
    //     $model->update([
    //         'created_by'=>$id,
    //         ]);
    // }

    // public static function beforeUpdate(Request $request, $model)
    // {
    //     $id = Auth::id();
    //     $model->update([
    //         'update_by'=>$id,

    //     ]);
    // }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [

            new FilterCard(new ProjectStatus()),
            new FilterCard(new Projectapproval()),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ProjectStatus,
            new  Projectapproval
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [

            (new ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
                return  $user->type() == 'admin';
            }),
            new ProjectStatu,

        ];
    }
}
