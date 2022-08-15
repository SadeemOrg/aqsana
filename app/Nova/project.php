<?php

namespace App\Nova;

use App\Models\Area;


use App\Models\City;
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
use App\Models\Bus;
use App\Nova\Actions\AddBus;
use Benjacho\BelongsToManyField\BelongsToManyField;

use Whitecube\NovaFlexibleContent\Flexible;
use Gwd\FlexibleContent\FlexibleContent;

use Laravel\Nova\Panel;
use App\Nova\Actions\ChangeRole;
use Laravel\Nova\Fields\Markdown;
use Pdmfc\NovaFields\ActionButton;

use Fourstacks\NovaRepeatableFields\Repeater;

class Project extends Resource
{
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
    public static $title = 'id';

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
        return __('project');
    }
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $user = Auth::user();
        $id = Auth::id();
        if ($user->type() == 'admin') {
            return $query;
        } elseif ($user->type() == 'regular_area') {

            $Area = \App\Models\Area::where('admin_id', $id)->first();
            $projects = DB::table('project_area')->where('area_id', $Area->id)->get();
        } else {
            $citye =   City::where('admin_id', $id)
                ->select('id')->first();
            $projects = DB::table('project_city')->where('city_id', $citye->id)->get();
        }


        $stack = array();
        foreach ($projects as $key => $value) {
            array_push($stack, $value->project_id);

        }
        return $query->whereIn('id', $stack);
    }
    public function fields(Request $request)
    {
        return [
            (new Panel(__('main'), [
                ID::make(__('ID'), 'id')->sortable(),
                Text::make("project name", "project_name"),
                Text::make("project describe", "project_describe"),
                Select::make(__('SECTOR'), 'sector')
                    ->options(function () {
                        $sectors = nova_get_setting('workplace', 'default_value');
                        $user_type_admin_array =  array();
                        foreach ($sectors as $sector) {
                            $user_type_admin_array += [$sector['data']['searsh_text_workplace'] => ($sector['data']['searsh_text_workplace'] . " (" . $sector['data']['text_main_workplace'] . ")")];
                        }
                        return  $user_type_admin_array;
                    }),
                BelongsToManyField::make('Area', 'Area')
                    ->options(Area::all())
                    ->optionsLabel('name')->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'admin') return true;
                        return false;
                    }),


                DateTime::make('projec start', 'start_date'),
                DateTime::make('projec end', 'end_date'),


                Boolean::make('is_has_Donations', 'is_bus'),
                Boolean::make('is_has_volunteer', 'is_volunteer'),
                Boolean::make('is_has_Donations', 'is_donation'),


                Select::make('is_reported Status ', 'is_reported')->options([
                    '1' => 'yes',
                    '0' => 'no',
                ])->displayUsingLabels(),


                NovaDependencyContainer::make([
                    Text::make("Title", 'report_title'),
                    Textarea::make('description', 'report_description'),
                    Tiptap::make('Contents', 'report_contents')
                        ->buttons([
                            'heading',
                            '|',
                            'italic',
                            'bold',
                            '|',
                            'link',
                            'code',
                            'strike',
                            'underline',
                            'highlight',
                            '|',
                            'bulletList',
                            'orderedList',
                            'br',
                            'codeBlock',
                            'blockquote',
                            '|',
                            'horizontalRule',
                            'hardBreak',
                            '|',
                            'table',
                            '|',
                            'image',
                            '|',
                            'textAlign',
                            '|',
                            'rtl',
                            '|',
                            'history',
                        ])
                        ->headingLevels([1, 2, 3, 4, 5, 6]),


                    Image::make('Image', 'report_image')->disk('public')->prunable(),
                    ArrayImages::make('Pictures', 'report_pictures')
                        ->disk('public'),
                    Text::make("video link", 'report_video_link'),


                ])->dependsOn('is_reported', '1'),

                BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),



            ]))->withToolbar(),

            (new Panel(__('City'), [

                BelongsToManyField::make('City', 'City')
                    // ->options(Area::all())
                    ->options(function () {

                        $id = Auth::id();
                        $Area = \App\Models\Area::where('admin_id', $id)->first();
                        //    dd( $Area->id);
                        $Citys =  \App\Models\City::where('area_id', $Area->id)->get();
                        // $users =  \App\Models\City::where('area_id', $id)->get();
                        return $Citys;
                        $user_type_admin_array =  array();

                        foreach ($Citys as $City) {
                            // dd($user['id'] ."**" .($user['id']));
                            $user_type_admin_array += [$City['id'] => ($City['name'])];
                        }

                        return $user_type_admin_array;
                    })->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'regular_area') return true;
                        return false;
                    }),
                ])),

            (new Panel(__('Budjet'), [

                Text::make("Budjet", "Budjet", function () {

                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        // dd($id);
                        // dd($citye);
                        $bud = DB::table('project_budjet')
                            ->where([
                                ['project_id', '=', $this->id],
                                ['city_id', '=', $citye['id']],
                            ])
                            ->first();

                        if ($bud)  return  $bud->budjet;
                    }
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') return true;
                    return false;
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            ])),
            (new Panel(__('Toole'), [

                Text::make("Toole", "Toole", function () {

                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        $Tooles = DB::table('project_toole')
                            ->where([
                                ['project_id', '=', $this->id],
                                ['city_id', '=', $citye['id']],
                            ])
                            ->first();

                        if ($Tooles)  return  $Tooles->tools;
                    }
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') return true;
                    return false;
                }),
            ])),
            (new Panel(__('Approved'), [

                Text::make('approval ', 'approval', function () {
                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        $acspet = DB::table('accept_project')
                            ->where([
                                ['project_id', '=', $this->id],
                                ['city_id', '=', $citye['id']],
                            ])
                            ->first();
                        // return  "1";
                        // dd("1");
                        if ($acspet) {
                            if ($acspet->accepted == "1") return "aproved";
                            elseif ($acspet->accepted == "2") return "not aproved";
                            else return "__";
                        }
                    }
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') return true;
                    return false;
                })->readonly(true),




                Text::make('reason_of_reject', 'reason_of_reject', function () {
                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        $acspet = DB::table('accept_project')
                            ->where([
                                ['project_id', '=', $this->id],
                                ['city_id', '=', $citye['id']],
                            ])
                            ->first();
                        // return  "1";
                        // dd("1");
                        if ($acspet)  return  $acspet->reject_reason;
                    }
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city'){
                    $id = Auth::id();
                    $citye =   City::where('admin_id', $id)
                        ->select('id')->first();

                    $acspet = DB::table('accept_project')
                        ->where([
                            ['project_id', '=', $this->id],
                            ['city_id', '=', $citye['id']],
                        ])
                        ->first();
                    if ($acspet) if ($acspet->accepted == "2")   return true;
                    return false;
              }  })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),





            ])),

            (new Panel(__('status'), [
                Text::make('approval ', 'approval', function () {
                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        $acspet = DB::table('project_status')
                            ->where([
                                ['project_id', '=', $this->id],
                                ['city_id', '=', $citye['id']],
                            ])
                            ->first();
                        // return  "1";
                        // dd("1");
                        if ($acspet)  return   $acspet->status;
                        else return "__";

                    }
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') return true;
                    return false;
                })->readonly(true),
        ])),
            (new Panel(__('bus'), [





                BelongsToManyField::make('bus', 'bus', 'App\Nova\bus')
                    ->options(Bus::all())
                    ->optionsLabel('bus_number')
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    })
                    ->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'regular_city') return true;
                        return false;
                    }),
                Repeater::make('newbus')
                    ->addField([

                        'name' => 'name_driver',
                        'label' => 'driver name',

                        'width' => 'w-full',
                        'options' => [
                            'fido' => 'Fido',
                            'mr_bubbles' => 'Mr Bubbles',
                            'preston' => 'Preston'
                        ],

                    ])
                    ->addField([

                        'name' => 'bus_number',
                        'label' => 'bus number',
                        'options' => [
                            'fido' => 'Fido',
                            'mr_bubbles' => 'Mr Bubbles',
                            'preston' => 'Preston'
                        ],

                    ])
                    ->addField([

                        'name' => 'number_of_seats',
                        'label' => 'number of seats',
                        'width' => 'w-full',
                    ])
                    ->addField([

                        'name' => 'seat_price',
                        'label' => 'seat price',
                        'width' => 'w-full',
                    ])
                    ->addField([

                        'name' => 'phone_number_driver',
                        'label' => 'phone number driver',
                        'width' => 'w-full',
                    ])->hideFromDetail()->hideFromIndex()

                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    })->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'regular_city') return true;
                        return false;
                    }),


            ])),




        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
    }
    public static function beforeUpdate(Request $request, $model)
    {

        $id = Auth::id();
        $model->update_by = $id;

        $citye =   City::where('admin_id', $id)
            ->select('id')->first();

        if ($request->Budjet) {

            DB::table('project_budjet')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'city_id' => $citye['id']],
                    ['budjet' => $request->Budjet]
                );
        }
        if ($request->Toole) {

            DB::table('project_toole')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'city_id' => $citye['id']],
                    ['tools' => $request->Toole]
                );
        }
        if ($request->bus) {

            $buss = json_decode($request->bus);

            $stack = array();
            foreach ($buss as $key => $value) {
                array_push($stack, $value->id);
            }
            // dd($stack);
            $busss = DB::table('project_bus')->where(
                ['project_id' => $model->id, 'city_id' => $citye['id']])->get();
                $busstack = array();
                foreach ($busss as $key => $value) {
                    array_push($busstack, $value->bus_id);
                }
                $result = array_intersect($stack, $busstack);
        //    dd($busstack);
                // dd( $result);
        $deleted = DB::table('project_bus')->where(['project_id' => $model->id, 'city_id' => $citye['id']])
        ->whereNotIn('bus_id',$result)
        ->delete();

            // dd(gettype($buss));
            // $bus_id=$buss[0]->id;


            foreach ($buss as $key => $user) {


                DB::table('project_bus')
                    ->updateOrInsert(
                        ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $user->id],

                    );
            }
            // dd($buss );
            // $request->bus = json_encode($buss);
            // dd( $request->bus);

            // DB::table('project_bus')
            //     ->updateOrInsert(
            //         ['project_id' => $model->id, 'city_id' => $citye['id'],'bus_id' => $bus_id],

            //     );
        }
        // if ($request->bus) {


        //     foreach ($request->busus as $user) {
        //         //  dd($user);
        //         DB::table('project_bus')
        //             ->updateOrInsert(
        //                 ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $user],

        //             );
        //         // dd($user);
        //     }
        // }
        if ($request->newbus) {
            $buss = json_decode($request->newbus);

            foreach ($buss as $user) {
                //  dd($user);

                DB::table('buses')
                    ->insert(
                        ['name_driver' => $user->name_driver, 'bus_number' => $user->bus_number, 'number_of_seats' => $user->number_of_seats, 'seat_price' => $user->seat_price, 'phone_number_driver' => $user->phone_number_driver],

                    );
                $bus =  \App\Models\Bus::where('bus_number', $user->bus_number)->first();


                // dd($users['id']);

                DB::table('project_bus')
                    ->updateOrInsert(
                        ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $bus['id']],

                    );
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
        return [];
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

            new ApprovalRejectProjec,
            new ProjectStatu


        ];
    }
}
