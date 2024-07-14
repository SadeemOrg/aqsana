<?php

namespace App\Nova;

use App\Models\Area;


use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Acme\MultiselectField\Multiselect as Select;
use Acme\MultiselectField\Multiselect;
use Acme\ProjectPicker\ProjectPicker;
use Acme\SectorPicker\SectorPicker;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\ApprovalRejectProjec;
use App\Nova\Actions\ProjectStatu;
use Illuminate\Support\Facades\Auth;
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
use Alaqsa\Project\Project as ProjectProject;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use App\Models\Bus;
use App\Models\Notification;
use App\Models\Sector;
use App\Models\User;
use App\Nova\Actions\AddBus;
use Benjacho\BelongsToManyField\BelongsToManyField;

use Whitecube\NovaFlexibleContent\Flexible;
use Gwd\FlexibleContent\FlexibleContent;

use Laravel\Nova\Panel;
use App\Nova\Actions\ChangeRole;
use App\Nova\Actions\ProjectStartEnd;
use App\Nova\Filters\ProjectSectors;
use App\Nova\Filters\ReportArea;
use App\Nova\Filters\Reportcity;
use App\Nova\Filters\ReportCreated;
use Carbon\Carbon;
use Laravel\Nova\Fields\Markdown;
use Pdmfc\NovaFields\ActionButton;

use Fourstacks\NovaRepeatableFields\Repeater;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\HasMany;
use PosLifestyle\DateRangeFilter\DateRangeFilter;

class Project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'project_name';
    public static $priority = 20;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function label()
    {
        return __('project');
    }
    public static function group()
    {
        return __('Public Administration');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("projectparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }

    public static $search = [
        'id', 'project_name'
    ];
    public static function groupOrder()
    {
        return 7;
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where('project_type', '1');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            SectorPicker::make(__('تاريخ المشروع'), 'ref_id', function () {
                $keyValueArray = ['key1' => $this->sector, 'key2' => $this->start_date];

                return $keyValueArray;
            })->hideFromDetail()->hideFromIndex(),

            DateTime::make(__('projec start'), 'start_date')->rules('required')->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Sector'), 'Sectors', \App\Nova\Sector::class)->hideWhenCreating()->hideWhenUpdating(),


            Text::make(__("project name"), "project_name")->rules('required'),
            Textarea::make(__("project describe"), "project_describe")->rules('required')->hideFromIndex(),
            BelongsTo::make(__('city'), 'CityProject', \App\Nova\City::class)->hideWhenCreating()->hideWhenUpdating(),

            Multiselect::make(__('city'), 'city')
                ->options(function () {
                    $Areas =  \App\Models\City::all();

                    $Area_type_admin_array =  array();

                    foreach ($Areas as $Area) {


                        $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                    }

                    return $Area_type_admin_array;
                })->singleSelect()->hideFromIndex()->hideFromDetail(),


            HasMany::make(__('Volunteer'), 'Volunteer', \App\Nova\Volunteer::class),
            belongsToMany::make(__('Bus'), 'Bus', \App\Nova\Bus::class),
            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class),

            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $refObject = json_decode($request->ref_id);
        if (isset($refObject->key2)) {
            if (!$refObject->key2) {
                $validator->errors()->add('ref_id', 'يجب اضافة مشروع');
            }
        } else {
            $validator->errors()->add('ref_id', 'يجب اضافة قطاع');
        }
    }

    public static function beforeCreate(Request $request, $model)
    {

        $id = Auth::id();
        $model->created_by = $id;
        $model->project_type = '1';
        $model->is_reported = '1';
    }
    public static function beforeSave(Request $request, $model)
    {
        $model->start_date = json_decode($request->ref_id)->key1;
        $model->sector = json_decode($request->ref_id)->key2;
        $request->request->remove('ref_id');
        if ($request->city !== null) {
            $city = City::find($request->city);
            if ($city) {
                $area = Area::find($city->area_id);
                if ($area) {
                    $model->area = $area->id;
                }
            }
        }
    }



    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
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
            new ProjectSectors(),
            new ReportCreated(),
            new ReportArea(),
            new Reportcity(),


            new DateRangeFilter(__("start"), "start_date"),


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

            (new ApprovalRejectProjec)->canSee(function () {
                $user = Auth::user();

                if ($user->type() == 'regular_city' || $user->type() == 'regular_area') {
                    return true;
                }
            }),
            new ProjectStartEnd,



        ];
    }
}
