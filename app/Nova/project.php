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
use App\CPU\Helpers;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use App\Models\Bus;
use App\Models\Notification;
use App\Models\User;
use App\Nova\Actions\AddBus;
use Benjacho\BelongsToManyField\BelongsToManyField;

use Whitecube\NovaFlexibleContent\Flexible;
use Gwd\FlexibleContent\FlexibleContent;

use Laravel\Nova\Panel;
use App\Nova\Actions\ChangeRole;
use App\Nova\Actions\ProjectStartEnd;
use Carbon\Carbon;
use Laravel\Nova\Fields\Markdown;
use Pdmfc\NovaFields\ActionButton;

use Fourstacks\NovaRepeatableFields\Repeater;
use Laravel\Nova\Fields\HasMany;


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
    public static $priority = 1;
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
    public static function availableForNavigation(Request $request)
    {
        if ($request->user()->type() == 'regular_city'  &&  (!($request->user()->cite))) {
            return false;
        }
        if ($request->user()->type() == 'website_admin' || $request->user()->type() == 'financial_user' || $request->user()->type() == 'Almuahada_admin') {
            return false;
        } else return true;
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

            return $query->where('project_type', '1');
        } elseif ($user->type() == 'regular_area') {

            $Area = \App\Models\Area::where('admin_id', $id)->first();
            $projects = DB::table('project_area')->where('area_id', $Area->id)->get();
        } elseif ($user->type() == 'regular_city') {
            $citye =   City::where('admin_id', $id)
                ->select('id')->first();
            $projects = DB::table('project_city')->where('city_id', $citye->id)->get();
        } else   $projects = DB::table('project_city')->get();


        $stack = array();
        foreach ($projects as $key => $value) {
            array_push($stack, $value->project_id);
        }
        return $query->whereIn('id', $stack)->where('project_type', '1');
    }
    public function fields(Request $request)
    {
        return [
            (new Panel(__('main'), [
                ID::make(__('ID'), 'id')->sortable(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('start'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if ($projects) {

                            if ($projects->status == '0')  return true;
                        }
                    })
                    ->readonly(function () {
                        return false;
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),

                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('end'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if ($projects) {

                            if ($projects->status == '1')  return true;
                        }
                    })
                    ->readonly(function () {
                        return false;
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('Finished'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if ($projects) {

                            if ($projects->status > '1')  return true;
                        }
                    })
                    ->readonly()
                    ->hideWhenCreating()->hideWhenUpdating(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('incomplete'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#787878')
                    ->canSee(function () {
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if (!$projects) {
                            return true;
                        }
                    })
                    ->readonly()
                    ->hideWhenCreating()->hideWhenUpdating(),




                ActionButton::make(__('Action'))
                    ->action(ApprovalRejectProjec::class, $this->id)
                    ->text(__('acsept'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $user = Auth::user();

                        if ($user->type() == 'regular_city' || $user->type() == 'regular_area') {
                            return true;
                        }
                    })
                    ->readonly(function () {
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

                            if ($acspet) {

                                if ($acspet->accepted == "1")   return  true;
                                else return false;
                            }
                        }
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),




           Text::make(__("project name"), "project_name"),
                Text::make(__("project describe"), "project_describe"),

                Select::make(__('SECTOR'), 'sector')
                    ->options(function () {
                        $sectors = nova_get_setting('workplace', 'default_value');
                        $user_type_admin_array =  array();
                        if ($sectors != "default_value") {
                            foreach ($sectors as $sector) {
                                $user_type_admin_array += [$sector['data']['searsh_text_workplace'] => ($sector['data']['searsh_text_workplace'] . " (" . $sector['data']['text_main_workplace'] . ")")];
                            }
                            return  $user_type_admin_array;
                        }
                    }),
                BelongsToManyField::make(__('Area'), "Area", '\App\Nova\Area')
                    ->options(Area::all())
                    ->optionsLabel('name')->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'admin') return true;
                        return false;
                    }),









                DateTime::make(__('projec start'), 'start_date'),
                DateTime::make(__('projec end'), 'end_date'),


                Boolean::make(__('is_bus'), 'is_bus'),
                Boolean::make(__('is_has_volunteer'), 'is_volunteer'),
                Boolean::make(__('is_has_Donations'), 'is_donation'),







                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


            ]))->withToolbar(),

            (new Panel(__('City'), [
                BelongsToManyField::make(__('City'), "City", '\App\Nova\City')
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

            (new Panel(__('bus'), [





                BelongsToManyField::make(__('bus'), 'bus', 'App\Nova\bus')
                    // ->options(Bus::all())
                    ->options(Bus::all())
                    ->optionsLabel('bus_number')
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    }),


                Flexible::make(__('newbus'), 'newbus')
                    ->readonly(true)
                    ->hideFromDetail()->hideFromIndex()
                    ->addLayout(__('Add new bus'), 'bus', [

                        Select::make(__('BusesCompany'), 'BusesCompany')
                            ->options(function () {
                                $users =  \App\Models\BusesCompany::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name'])];
                                }

                                return $user_type_admin_array;
                            }),


                        Text::make(__("Bus Number"), "bus_number"),

                        Number::make(__("Number person on bus"), "number_person_on_bus")->step(1.0),

                        Number::make(__("seat price"), "seat_price")->step(1.0),

                        Select::make(__('travel from'), 'from')
                            ->options(function () {
                                $users =  \App\Models\address::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name_address'])];
                                }

                                return $user_type_admin_array;
                            }),


                        Select::make(__('travel to'), 'to')
                            ->options(function () {
                                $users =  \App\Models\address::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name_address'])];
                                }

                                return $user_type_admin_array;
                            }),


                        Text::make(__("Name Driver"), "name_driver"),
                        Text::make(__("phone_number"), "phone_number"),

                    ])





            ])),
            (new Panel(__('tooles'), [

                Flexible::make(__('tooles'), 'tools')

                    ->addLayout(__('tooles'), 'toole', [
                        Select::make(__('user'), 'user_tools')
                            ->options(function () {
                                $users =  \App\Models\User::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name'])];
                                }

                                return $user_type_admin_array;
                            }),

                        Textarea::make(__('tooles'), "text_tools"),

                    ]),


            ])),



            HasMany::make(__('Donations'), 'Donations', \App\Nova\Donations::class),
            HasMany::make(__('Volunteer'), 'Volunteer', \App\Nova\Volunteer::class),
            belongsToMany::make(__('Bus'), 'Bus', \App\Nova\Bus::class),
            // ->canSee(function ($request) {

            //     $user = Auth::user();
            //     if ($user->type() == 'regular_city') return true;
            //     return false;
            // }),
        ];
    }




    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
        $model->project_type = '1';
        $model->is_reported = '1';
    }

    public static function afterCreate(Request $request, $model)
    {

        if ($request->Area) {
            $areas = json_decode($request->Area);
            $tokens = [];
            foreach ($areas as $key => $area) {
                $user = User::where('id', $area->admin_id)->first();
                $notification = Notification::where('id', '1')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            if (!empty($tokens)) {

                Helpers::send_notification($tokens, $notification);
            }
        }
        if ($request->City) {
            $Citys = json_decode($request->City);
            $tokens = [];
            foreach ($Citys as $key => $City) {
                $user = User::where('id', $City->admin_id)->first();
                $notification = Notification::where('id', '1')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            if (!empty($tokens)) {

                Helpers::send_notification($tokens, $notification);
            }
        }


        $user = Auth::user();
        $id = Auth::id();
        $citye =   City::where('admin_id', $id)
            ->first();
        if ($user->type() == 'regular_area') {
            $Area = \App\Models\Area::where('admin_id', $id)->first();
            DB::table('project_area')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'area_id' =>  $Area['id']],

                );
        }
        if ($user->type() == 'regular_city') {
            // dd($citye);
            DB::table('project_area')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'area_id' =>  $citye['area_id']],

                );
            DB::table('project_city')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'city_id' =>  $citye['id']],

                );
        }
    }
    public static function afterSave(Request $request, $model)
    {
        //
        // dd($request->tooles[0]['attributes']['user_tools']);


        $id = Auth::id();

        $citye =   City::where('admin_id', $id)
            ->select('id')->first();
        $model->update_by = $id;

        // if ($request->tooles) {
        //     $toooles = $request->tooles;
        //     foreach ($toooles as $key => $tooole) {
        //         DB::table('project_toole')
        //             ->updateOrInsert(
        //                 ['project_id' => $model->id, 'city_id' => $citye['id'], 'user_id' => $tooole['attributes']['user_tools']],
        //                 ['tools' => $request->tooles]
        //             );
        //     }
        // }
        if ($request->bus) {

            $buss = json_decode($request->bus);

            $stack = array();
            foreach ($buss as $key => $value) {
                array_push($stack, $value->id);
            }
            // dd($stack);
            $busss = DB::table('project_bus')->where(
                ['project_id' => $model->id, 'city_id' => $citye['id']]
            )->get();
            $busstack = array();
            foreach ($busss as $key => $value) {
                array_push($busstack, $value->bus_id);
            }
            $result = array_intersect($stack, $busstack);
            //    dd($busstack);
            // dd( $result);
            $deleted = DB::table('project_bus')->where(['project_id' => $model->id, 'city_id' => $citye['id']])
                ->whereNotIn('bus_id', $result)
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
        if ($request->newbus) {
            $buss = $request->newbus;

            foreach ($buss as $bus) {
                // dd($bus['attributes']);
                if ($bus['attributes']['name_driver'] && $bus['attributes']['BusesCompany'] && $bus['attributes']['bus_number'] && $bus['attributes']['number_person_on_bus'] && $bus['attributes']['seat_price'] && $bus['attributes']['from'] && $bus['attributes']['to'] && $bus['attributes']['phone_number']) {


                    DB::table('buses')
                        ->insert(
                            [
                                'name_driver' => $bus['attributes']['name_driver'],
                                'company_id' => $bus['attributes']['BusesCompany'],
                                'bus_number' => $bus['attributes']['bus_number'],
                                'number_of_seats' => $bus['attributes']['number_person_on_bus'],
                                'seat_price' => $bus['attributes']['seat_price'],
                                'travel_from' => $bus['attributes']['from'],
                                'travel_to' => $bus['attributes']['to'],
                                'phone_number_driver' => $bus['attributes']['phone_number'],
                                'status' => '1',
                            ]
                        );
                    $bus =  \App\Models\Bus::where('bus_number', $bus['attributes']['bus_number'],)->first();

                    DB::table('project_bus')
                        ->updateOrInsert(
                            ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $bus['id']],

                        );
                }
            }
        }
        if ($request->City) {

            $City = json_decode($request->City);


            DB::table('project_status')
                ->updateOrInsert(
                    ['project_id' => $model->id, 'city_id' => $City[0]->id],
                    ['status' => '0']
                );
        }

        // if (!$request->trip_from) {
        //     if ($request->newadresfrom[0]['attributes']['name_address'] && $request->newadresfrom[0]['attributes']['description'] && $request->newadresfrom[0]['attributes']['phone_number_address'] && $request->newadresfrom[0]['attributes']['current_location'] && $request->newadresfrom[0]['attributes']['address_status']) {

        //         //   dd("hf");
        //         DB::table('addresses')
        //             ->Insert(
        //                 [
        //                     'name_address' => $request->newadresfrom[0]['attributes']['name_address'],
        //                     'description' => $request->newadresfrom[0]['attributes']['description'],
        //                     'phone_number_address' => $request->newadresfrom[0]['attributes']['phone_number_address'],
        //                     'current_location' => $request->newadresfrom[0]['attributes']['current_location'],
        //                     'status' => $request->newadresfrom[0]['attributes']['address_status'],
        //                     'type' => '1',
        //                     'created_by' => $id
        //                 ]
        //             );
        //         $address =  \App\Models\address::where('name_address',  $request->newadresfrom[0]['attributes']['name_address'])->first();
        //         DB::table('projects')
        //             ->where('id', $model->id)
        //             ->update(['trip_from' => $address->id]);
        //     }
        // } else   $model->trip_from = $request->trip_from;



        // if (!$request->trip_to) {
        //     if ($request->newadresto[0]['attributes']['name_address'] && $request->newadresto[0]['attributes']['description'] && $request->newadresto[0]['attributes']['phone_number_address'] && $request->newadresto[0]['attributes']['current_location'] && $request->newadresto[0]['attributes']['address_status']) {
        //         //   dd("hf");
        //         DB::table('addresses')
        //             ->Insert(
        //                 [
        //                     'name_address' => $request->newadresto[0]['attributes']['name_address'],
        //                     'description' => $request->newadresto[0]['attributes']['description'],
        //                     'phone_number_address' => $request->newadresto[0]['attributes']['phone_number_address'],
        //                     'current_location' => $request->newadresto[0]['attributes']['current_location'],
        //                     'status' => $request->newadresto[0]['attributes']['address_status'],
        //                     'type' => '1',
        //                     'created_by' => $id
        //                 ]
        //             );
        //         $address =  \App\Models\address::where('name_address',  $request->newadresto[0]['attributes']['name_address'])->first();
        //         DB::table('projects')
        //             ->where('id', $model->id)
        //             ->update(['trip_to' => $address->id]);
        //     }
        // } else   $model->trip_to = $request->trip_to;
    }
    public static function afterupdate(Request $request, $model)
    {
        if ($request->Area) {
            $areas = json_decode($request->Area);
            $tokens = [];
            foreach ($areas as $key => $area) {
                $user = User::where('id', $area->admin_id)->first();
                $notification = Notification::where('id', '1')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            if (!empty($tokens)) {

                Helpers::send_notification($tokens, $notification);
            }
        }
        if ($request->City) {
            $Citys = json_decode($request->City);
            $tokens = [];
            foreach ($Citys as $key => $City) {
                $user = User::where('id', $City->admin_id)->first();
                $notification = Notification::where('id', '1')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            if (!empty($tokens)) {

                Helpers::send_notification($tokens, $notification);
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
