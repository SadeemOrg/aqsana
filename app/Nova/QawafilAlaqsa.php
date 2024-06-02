<?php

namespace App\Nova;

use App\Models\Area;


use App\Models\City;
use Laravel\Nova\Actions\Action;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Http\Requests\NovaRequest;
use Acme\MultiselectField\Multiselect as Select;
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
use Techouse\SelectAutoComplete\SelectAutoComplete;

use AwesomeNova\Cards\FilterCard;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
// use App\Console\Commands\ProjectStartEnd;
// use App\CPU\Helpers;
use App\Models\address;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use App\Models\Bus;
use App\Models\BusesCompany;
use App\Models\Notification;
use App\Models\User;
use App\Nova\Actions\AddBus;
use Benjacho\BelongsToManyField\BelongsToManyField;

use Whitecube\NovaFlexibleContent\Flexible;
use Gwd\FlexibleContent\FlexibleContent;

use Laravel\Nova\Panel;
use App\Nova\Actions\ChangeRole;
use App\Nova\Actions\ProjectStartEnd;
use App\Nova\Filters\ProjectArea;
use App\Nova\Filters\ProjectSectors;
use App\Nova\Filters\ReportAdmin;
use App\Nova\Filters\ReportArea;
use App\Nova\Filters\Reportcity;
use App\Nova\Filters\ReportCreated;
use App\Nova\Metrics\NewQawafilAlaqsa;
use App\Rules\QawafilAlaqsaDate;
use Laravel\Nova\Fields\Markdown;
use Pdmfc\NovaFields\ActionButton;

use Fourstacks\NovaRepeatableFields\Repeater;
use Laravel\Nova\Fields\HasMany;
use Mauricewijnia\NovaMapsAddress\MapsAddress;
use Carbon\Carbon;

use function Clue\StreamFilter\fun;

class QawafilAlaqsa extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Project::class;
    public static $priority = 2;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'project_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function createButtonLabel()
    {
        return 'انشاء قافلة';
    }

    public static function label()
    {
        return __('Qawafil');
    }
    public static function group()
    {
        return __('QawafilAlaqsa');
    }
    public static function groupOrder()
    {
        return 1;
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("QawafilAlaqsaparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        // dd( Auth::id(),$query->where('project_type', '2')->where('created_by', Auth::id())->get());
        if ((in_array("super-admin",  $request->user()->userrole())) ) {
            return $query->where('project_type', '2');

        }
        else  return $query->where('project_type', '2')->where('created_by', Auth::id());


    }
    public function fields(Request $request)
    {
        return [
            (new Panel(__('main'), [
                ID::make(__('ID'), 'id')->sortable(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('لم يبدا بعد'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $starttime = Carbon::parse($this->start_date);
                        $finishTime = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $result = $startDate->gt($endDate);
                        return  $result;
                    })
                    ->readonly(function () {
                        return true;
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),

                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('فعالة'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $starttime = Carbon::parse($this->start_date);
                        $finishTime = Carbon::parse($this->end_date);
                        $now = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $nowtime = Carbon::createFromFormat('Y-m-d H:i:s', $now);

                        return ($startDate->lt($nowtime) && $nowtime->lt($endDate));
                    })
                    ->readonly(function () {
                        return true;
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('اغلاق'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $starttime = Carbon::parse($this->start_date);
                        $finishTime = Carbon::parse($this->end_date);
                        $now = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $nowtime = Carbon::createFromFormat('Y-m-d H:i:s', $now);
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if ($projects) {
                            if ($projects->status == 3) {

                                return false;
                            }
                        }


                        return ($endDate->lt($nowtime));
                    })

                    ->hideWhenCreating()->hideWhenUpdating(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('مغلق'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->readonly()
                    ->canSee(function () {
                        $starttime = Carbon::parse($this->start_date);
                        $finishTime = Carbon::parse($this->end_date);
                        $now = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $nowtime = Carbon::createFromFormat('Y-m-d H:i:s', $now);
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                        if ($projects) {
                            if ($projects->status == 3 && ($endDate->lt($nowtime))) {

                                return true;
                            }
                        }
                    })

                    ->hideWhenCreating()->hideWhenUpdating(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, $this->id)
                    ->text(__('مفتوحة'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $projects = DB::table('project_status')->where('project_id', $this->id)->first();

                        if ($projects) {
                            if ($projects->status != 3 && $this->end_date == null) {

                                return true;
                            }
                        }
                    })
                    ->readonly(function () {
                        return true;
                    })
                    ->hideWhenCreating()->hideWhenUpdating(),


                Text::make(__("QawafilAlaqsa name"), "project_name")->rules('required'),
                Text::make(__("QawafilAlaqsa describe"), "project_describe")->rules('required'),


                BelongsToManyField::make(__('Area'), "Area", '\App\Nova\Area')
                    ->options(Area::all())
                    ->optionsLabel('name')->canSee(function ($request) {
                        $user = Auth::user();
                        if ($user->type() == 'admin') return true;
                        return false;
                    })->rules('required', 'max:1'),
                Multiselect::make(__('city'), 'city')
                    ->options(function () {
                        $Areas =  \App\Models\City::all();

                        $Area_type_admin_array =  array();

                        foreach ($Areas as $Area) {


                            $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                        }

                        return $Area_type_admin_array;
                    })->singleSelect(),

                Select::make(__("Repetition"), "repetition")->options([
                    '6' => __('Once'),
                    '1' => __('daily'),
                    '2' => __('weekly'),
                    '3' => __('fortnightly'),
                    '4' => __('Monthly'),
                    '5' => __('annual'),
                ])->rules('required')->singleSelect(),


                Select::make(__('delegatee'), 'admin_id')
                    ->options(function () {
                        $users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '3')->get();
                        $user_type_admin_array =  array();
                        foreach ($users as $user) {
                            $user_type_admin_array += [$user['id'] => ($user['name'])];
                        }

                        return $user_type_admin_array;
                    })->singleSelect(),
                Flexible::make(__('Qawafil_sub_admin'), 'Qawafil_sub_admin')

                    ->addLayout(__('Qawafil_sub_admin'), 'Qawafil_sub_admin', [
                        Multiselect::make(__('Qawafil_sub_admin'), 'Qawafil_sub_admin')
                            ->options(function () {
                                $users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '3')->get();

                                $user_type_admin_array =  array();

                                foreach ($users as $user) {



                                    $user_type_admin_array += [$user['id'] => ($user['name'])];
                                }
                                return $user_type_admin_array;
                            })->rules('required')->singleSelect(),

                    ]),
                BelongsTo::make(__('trip from'), 'tripfrom', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),
                Select::make(__('trip from'), 'trip_from')
                    ->options(function () {
                        $id = Auth::id();
                        $addresss =  \App\Models\address::where('type', '1')->get();
                        $address_type_admin_array =  array();

                        foreach ($addresss as $address) {

                                $address_type_admin_array += [$address['id'] => ($address['name_address'])];

                        }

                        return $address_type_admin_array;
                    })->hideFromIndex()->hideFromDetail()->singleSelect()->rules('required'),
                // ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                //     return null;
                // }),

                // Flexible::make(__('newadres'), 'newadresfrom')
                //     ->readonly(true)
                //     ->limit(1)
                //     ->hideFromDetail()->hideFromIndex()
                //     ->addLayout(__('Add new bus'), 'bus', [

                //         Text::make(__('Name'), "name_address"),
                //         Text::make(__("description"), "description"),
                //         Text::make(__("phone number"), "phone_number_address")->rules('required'),


                //         MapsAddress::make(__('Address'), 'current_location')->zoom(10)
                //             ->center(['lat' =>  31.775947, 'lng' => 35.235577]),

                //         // Select::make(__("Status"), "address_status")->options([
                //         //     '1' => __('active'),
                //         //     '2' => __('not active'),
                //         // ]),

                //     ]),


                BelongsTo::make(__('trip to'), 'tripto', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),

                // BelongsTo::make(__('trip to'), 'tripto', \App\Nova\address::class)->withMeta([
                //     'value' => "1",
                // ])->hideFromDetail()->hideFromIndex()->hideWhenUpdating(),

                Select::make(__('trip to'), 'trip_to')
                ->options(function () {
                    $id = Auth::id();
                    $addresss =  \App\Models\address::where('type', '1')->get();
                    $address_type_admin_array =  array();

                    foreach ($addresss as $address) {

                            $address_type_admin_array += [$address['id'] => ($address['name_address'])];

                    }

                    return $address_type_admin_array;
                })
                ->withMeta([
                        'value' => "1",
                    ])
                ->hideFromIndex()->hideFromDetail()->singleSelect(),
                text::make(__('note'), "note"),
                DateTime::make(__('QawafilAlaqsa start'), 'start_date')->rules('required'),
                DateTime::make(__('QawafilAlaqsa end'), 'end_date')->rules('required',new QawafilAlaqsaDate($request->start_date)),



                Boolean::make(__('is_has_Donations'), 'is_donation'),






                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


            ]))->withToolbar(),



            (new Panel(__('bus'), [

                BelongsToManyField::make(__('bus'), 'bus', 'App\Nova\bus')
                    ->options(Bus::all())
                    ->optionsLabel('bus_number')
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    }),
                Flexible::make(__('newbus'), 'newbus')
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        $model->$attribute = null;
                    })

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
                            })->singleSelect(),


                        Text::make(__("Bus Number"), "bus_number"),

                        Number::make(__("Number person on bus"), "number_person_on_bus")->step(1.0),

                        Number::make(__("seat price"), "seat_price")->step(1.0),
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
                            })->singleSelect(),

                        Textarea::make(__('tooles'), "text_tools"),

                    ]),


            ])),


            // HasMany::make(__('Donations'), 'Donations', \App\Nova\Donations::class),
            HasMany::make(__('TripBooking'), 'TripBooking', \App\Nova\TripBooking::class),
            belongsToMany::make(__('Bus'), 'Bus', \App\Nova\Bus::class),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
        $model->project_type = '2';
        $model->sector = '5';
        $model->is_reported = '1';

        $model->trip_to = '1';
        $model->newbus = null;
    }
    public static function afterCreate(Request $request, $model)
    {
        DB::table('project_status')->insert([
            'project_id' => $model->id,
            'status' => 2,
        ]);

        $id = Auth::id();
        $Area = \App\Models\Area::where('admin_id', $id)->first();

        if (isset($Area)) {
            DB::table('project_area')->insert([
                'project_id' => $model->id,
                'area_id' => $Area->id,
            ]);
        }

        $model->newbus = null;
    }
    public static function beforesave(Request $request, $model)
    {
        $request->request->remove('newtype');
    }
    public static function aftersave(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;

        $citye =   City::where('admin_id', $id)
            ->select('id')->first();


        if ($request->Area) {
            $areas = json_decode($request->Area);
            $tokens = [];
            foreach ($areas as $key => $area) {
                $user = User::where('id', $area->admin_id)->first();
                $notification = Notification::where('id', '2')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            // if (!empty($tokens)) {

            //     Helpers::send_notification($tokens, $notification);
            // }
        }
        if ($request->City) {
            $Citys = json_decode($request->City);
            $tokens = [];
            foreach ($Citys as $key => $City) {
                $user = User::where('id', $City->admin_id)->first();
                $notification = Notification::where('id', '2')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
                }
            }
            // if (!empty($tokens)) {

            //     Helpers::send_notification($tokens, $notification);
            // }
        }

        if ($request->Budjet) {

            DB::table('transactions')
                ->updateOrInsert(
                    ['ref_id' => $model->id, 'ref_cite_id' => $citye['id']],
                    [
                        'main_type' => '2',
                        'type' => '2',
                        'Currency' => '3',
                        'transact_amount' => $request->Budjet,
                        'equivelant_amount' => $request->Budjet,
                        'transaction_date' => $date = date('Y-m-d'),

                    ]
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


            $busss = DB::table('project_bus')->where(
                ['project_id' => $model->id]
            )->get();
            $busstack = array();
            foreach ($busss as $key => $value) {
                array_push($busstack, $value->bus_id);
            }
            $result = array_intersect($stack, $busstack);

            $deleted = DB::table('project_bus')->where(['project_id' => $model->id])
                ->whereNotIn('bus_id', $result)
                ->delete();

            // dd(gettype($buss));
            // $bus_id=$buss[0]->id;


            foreach ($buss as $key => $user) {


                DB::table('project_bus')
                    ->updateOrInsert(
                        ['project_id' => $model->id, 'bus_id' => $user->id],

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
            // $to='{"country":"Israel","countryCode":"il","latlng":{"lat":31.769,"lng":35.2163},"name":"Jerusalem","query":"ontefiore Windmill Sderot Blumfield Jerusalem","type":"city","value":"Jerusalem, Israel"}';
            // $tojsone =
            // dd( json_decode($to));
            // dd($tojsone );
            // dd($request->newbus);
            foreach ($buss as $bus) {
                // dd($bus['attributes']);
                DB::table('buses')
                    ->insert(
                        [
                            'name_driver' => $bus['attributes']['name_driver'] ? $bus['attributes']['name_driver'] : "",
                            'company_id' => $bus['attributes']['BusesCompany'],
                            'bus_number' => $bus['attributes']['bus_number'],
                            'number_of_seats' => $bus['attributes']['number_person_on_bus'],
                            'seat_price' => $bus['attributes']['seat_price'],
                            'phone_number_driver' => $bus['attributes']['phone_number'] ? $bus['attributes']['phone_number'] : " ",
                            'status' => '1',
                        ]
                    );
                $bus =  \App\Models\Bus::where('bus_number', $bus['attributes']['bus_number'],)->first();
                $user = Auth::user();
                if ($user->type() == 'regular_city') {
                    DB::table('project_bus')
                        ->updateOrInsert(
                            ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $bus['id']],

                        );
                } else {
                    DB::table('project_bus')
                        ->updateOrInsert(
                            ['project_id' => $model->id, 'bus_id' => $bus['id']],

                        );
                }
            }
        }


        // if (!$request->trip_from) {
        //     if ($request->newadresfrom[0]['attributes']['name_address'] && $request->newadresfrom[0]['attributes']['description'] &&  $request->newadresfrom[0]['attributes']['current_location'] && $request->newadresfrom[0]['attributes']['phone_number_address']) {
        //         // dd("hf");
        //         DB::table('addresses')
        //             ->Insert(
        //                 [
        //                     'name_address' => $request->newadresfrom[0]['attributes']['name_address'],
        //                     'description' => $request->newadresfrom[0]['attributes']['description'],
        //                     'current_location' => $request->newadresfrom[0]['attributes']['current_location'],
        //                     'phone_number_address' => $request->newadresfrom[0]['attributes']['phone_number_address'],
        //                     'status' => '1',
        //                     'type' => '4',
        //                     'created_by' => $id
        //                 ]
        //             );
        //         $address =  \App\Models\address::where('name_address',  $request->newadresfrom[0]['attributes']['name_address'])->first();
        //         DB::table('projects')
        //             ->where('id', $model->id)
        //             ->update(['trip_from' => $address->id]);
        //     }
        // } else   $model->trip_from = $request->trip_from;
        // $model->newbus = null;
    }
    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            // new NewQawafilAlaqsa(),
            new FilterCard(new ProjectArea()),

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
              new ReportAdmin(),
            new ReportCreated(),
            new ReportArea(),
            new Reportcity(),
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
