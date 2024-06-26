<?php


namespace App\Nova;

use App\Models\{
    City,
    Address,
    Bus,
    TripBooking,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB
};
use Carbon\Carbon;
use Laravel\Nova\{
    Fields\ID,
    Fields\Number,
    Fields\Text,
    Fields\Textarea,
    Fields\Boolean,
    Fields\DateTime,
    Fields\BelongsTo,
    Fields\BelongsToMany,
    Fields\HasMany,
    Panel,
    Http\Requests\NovaRequest,
};
use Laravel\Nova\Actions\ActionResource;
use Acme\MultiselectField\Multiselect as Select;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Whitecube\NovaFlexibleContent\Flexible;
use OptimistDigital\NovaDetachedFilters\NovaDetachedFilters;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use Pdmfc\NovaFields\ActionButton;
use App\Nova\Actions\{
    ApprovalRejectProjec,
    ProjectStartEnd
};
use App\Nova\Filters\{
    ReportAdmin,
    ReportArea,
    Reportcity,
    ReportCreated,
    ReportTripFrom
};
use App\Rules\QawafilAlaqsaDate;

class QawafilAlaqsa extends Resource
{
    public static $model = \App\Models\Project::class;
    public static $priority = 2;
    public static $title = 'project_name';
    public static $search = ['id', 'project_name', 'project_describe'];

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
        $userRoles = $request->user()->userrole();
        return in_array("super-admin", $userRoles) || in_array("QawafilAlaqsaparmation", $userRoles);
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $userRoles = $request->user()->userrole();
        $query = $query->where('project_type', '2');

        if (!in_array("super-admin", $userRoles)) {
            $query = $query->where('city', $request->user()->city);
        }

        return $query;
    }


    public function fields(Request $request)
    {
        return [
            (new Panel(__('main'), [
                ID::make(__('ID'), 'id')->sortable(),
                ActionButton::make(__('Action'))
                    ->action(ProjectStartEnd::class, (string) $this->id)
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
                    ->action(ProjectStartEnd::class, (string) $this->id)
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
                    ->action(ProjectStartEnd::class, (string) $this->id)
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
                    ->action(ProjectStartEnd::class, (string) $this->id)
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
                    ->action(ProjectStartEnd::class, (string) $this->id)
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
                BelongsTo::make(__('city'), 'CityProject', \App\Nova\City::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('trip from'), 'tripfrom', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),
                Select::make(__('trip from'), 'trip_from')
                    ->options(function () {
                        $user = Auth::user();
                        $userRoles = $user->userrole();
                        if (in_array("super-admin", $userRoles)) {
                            $addresss =  \App\Models\address::where('type', '1')->get();
                        } else {
                            $addresss =  \App\Models\address::where('type', '1')->where('city_id', $user->city)->get();

                        }


                        $address_type_admin_array =  array();

                        foreach ($addresss as $address) {

                            $address_type_admin_array += [$address['id'] => ($address['name_address'])];
                        }

                        return $address_type_admin_array;
                    })->hideFromIndex()->hideFromDetail()->singleSelect()->rules('required'),

                BelongsTo::make(__('trip to'), 'tripto', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),


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
                DateTime::make(__('QawafilAlaqsa end'), 'end_date')->rules('required', new QawafilAlaqsaDate($request->start_date)),

                Boolean::make(__('is_has_Donations'), 'is_donation')->hideFromIndex(),

                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating()->hideFromIndex(),
                Text::make(__("TripBooking number"),'TripBooking number',function(){
                    $buss = $this->bus;
                    $number = 0;
                    $text='';
                    foreach ($buss as $key => $bus) {
                        $number_of_people = TripBooking::where([
                            ['bus_id', $bus->id],
                            ['status', '1'],
                            ['project_id', $this->id],
                        ])->sum('number_of_people');
                        $text .=  'اسم الباص:    '  . $bus->bus_number . "   " .'عدد  الاشخاص المتبقي:    ' . ($bus->number_of_seats - $number_of_people)."</br>";

                        $number +=  $number_of_people ;

                    }
                    $number +  $number ."</br>";
                    return $text;


                })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating()->asHtml(),

            ]))->withToolbar(),




            (new Panel(__('bus'), [

                BelongsToManyField::make(__('bus'), 'bus', 'App\Nova\bus')
                    ->options(Bus::all())
                    ->optionsLabel('bus_number')
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    })->hideFromIndex(),
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
                            })->singleSelect()->rules('required'),


                        Text::make(__("Bus Number"), "bus_number")->rules('required'),

                        Number::make(__("Number person on bus"), "number_person_on_bus")->rules('required'),

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


            HasMany::make(__('TripBooking'), 'TripBooking', \App\Nova\TripBooking::class),
            belongsToMany::make(__('Bus'), 'Bus', \App\Nova\Bus::class),
            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {

        if (!($request->bus != '[]' || $request->newbus)) {
            $validator->errors()->add('bus', 'يجب اضافة باصات');
        }
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
        address::find($request->trip_from);
        $model->city = address::find($request->trip_from)->city_id;
        $model->area = address::find($request->trip_from)->area_id;
        $request->request->remove('newtype');
    }
    public static function aftersave(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;

        $citye =   City::where('admin_id', $id)
            ->select('id')->first();



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

            foreach ($buss as $bus) {
                DB::table('buses')
                    ->insert(
                        [
                            'name_driver' => $bus['attributes']['name_driver'] ? $bus['attributes']['name_driver'] : "",
                            'company_id' => $bus['attributes']['BusesCompany'] ? $bus['attributes']['BusesCompany'] : "",
                            'bus_number' => $bus['attributes']['bus_number'],
                            'number_of_seats' => $bus['attributes']['number_person_on_bus'] ? $bus['attributes']['number_person_on_bus'] : 50,
                            'seat_price' => $bus['attributes']['seat_price'] ? $bus['attributes']['seat_price'] : '0',
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
            (new NovaDetachedFilters([
                (new ReportCreated())->withMeta(['width' => 'w-1/3']),
                (new ReportArea())->withMeta(['width' => 'w-1/3']),
                (new Reportcity())->withMeta(['width' => 'w-1/3']),
                (new ReportAdmin())->withMeta(['width' => 'w-1/3']),
                (new ReportTripFrom())->withMeta(['width' => 'w-1/3']),
                 (new DateRangeFilter(__("start"), "start_date"))->withMeta(['width' => 'w-1/3']),
            ]))->width('full'),
        ];
    }
    // vendor\pos-lifestyle\laravel-nova-date-range-filter
    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ReportCreated(),
            new ReportArea(),
            new Reportcity(),
            new ReportAdmin(),
            new ReportTripFrom(),
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
