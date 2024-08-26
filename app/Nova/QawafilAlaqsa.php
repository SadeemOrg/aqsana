<?php


namespace App\Nova;

use App\Models\{
    City,
    Address,
    address as ModelsAddress,
    Area,
    Bus,
    Project,
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
use Acme\MultiselectField\Multiselect;
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
use App\Rules\AlhisalatMap;
use App\Rules\QawafilAlaqsaDate;
use Mauricewijnia\NovaMapsAddress\MapsAddress;

class QawafilAlaqsa extends Resource
{
    public static $model = \App\Models\Project::class;
    public static $priority = 1;
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

        $CloseProjects = $query->where('project_type', '2')->get();
        foreach ($CloseProjects as $key => $CloseProject) {
            $starttime = Carbon::parse($CloseProject->start_date);
            $finishTime = Carbon::parse($CloseProject->end_date);
            $now = Carbon::now();
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
            $nowtime = Carbon::createFromFormat('Y-m-d H:i:s', $now);
            $projects = DB::table('project_status')->where('project_id', $CloseProject->id)->first();
            if (($endDate->lt($nowtime)) && $projects->status != 3) {
                DB::table('project_status')
                    ->where('project_id', $CloseProject->id)
                    ->update(['status' => DB::raw('status+1'),]);
                TripBooking::where('project_id', $CloseProject->id)
                    ->update([
                        'status' => '0'
                    ]);
                DB::table('project_status')
                    ->where('project_id', $CloseProject->id)
                    ->first();
                switch ($CloseProject->repetition) {
                    case "1":
                        $newQafel = $CloseProject->replicate();
                        $newQafel->start_date = Carbon::parse($newQafel->start_date)->addDays(8);
                        $newQafel->end_date = Carbon::parse($newQafel->end_date)->addDays(8);
                        break;
                    case "2":
                        $newQafel = $CloseProject->replicate();
                        $newQafel->start_date = Carbon::parse($newQafel->start_date)->addWeeks(8);
                        $newQafel->end_date = Carbon::parse($newQafel->end_date)->addWeeks(8);
                        break;
                    case "3":
                        $newQafel = $CloseProject->replicate();
                        $newQafel->start_date = Carbon::parse($newQafel->start_date)->addWeeks(8);
                        $newQafel->end_date = Carbon::parse($newQafel->end_date)->addWeeks(8);
                        break;
                    case "4":
                        $newQafel = $CloseProject->replicate();
                        $newQafel->start_date = Carbon::parse($newQafel->start_date)->addMonths(8);
                        $newQafel->end_date = Carbon::parse($newQafel->end_date)->addMonths(8);
                        break;
                    case "5":
                        $newQafel = $CloseProject->replicate();
                        $newQafel->start_date = Carbon::parse($newQafel->start_date)->addYears(8);
                        $newQafel->end_date = Carbon::parse($newQafel->end_date)->addYears(8);
                        break;
                    default:
                        break;
                }

                if (isset($newQafel)) {
                    $newQafel->created_at = Carbon::now();
                    $newQafel->save();
                    $Buses = $CloseProject->Bus;
                    foreach ($Buses as $key => $Bus) {
                        DB::table('project_bus')
                            ->updateOrInsert(
                                ['project_id' => $newQafel->id, 'bus_id' => $Bus->id],

                            );
                    }

                    DB::table('project_status')->insert([
                        'project_id' => $newQafel->id,
                        'status' => 2,
                    ]);
                }
            }
        }
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
                // ActionButton::make(__('Action'))
                //     ->action(ProjectStartEnd::class, (string) $this->id)
                //     ->text(__('اغلاق'))
                //     ->showLoadingAnimation()
                //     ->loadingColor('#fff')->buttonColor('#21b970')
                //     ->canSee(function () {
                //         $starttime = Carbon::parse($this->start_date);
                //         $finishTime = Carbon::parse($this->end_date);
                //         $now = Carbon::now();
                //         $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                //         $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                //         $nowtime = Carbon::createFromFormat('Y-m-d H:i:s', $now);
                //         $projects = DB::table('project_status')->where('project_id', $this->id)->first();
                //         if ($projects) {
                //             if ($projects->status == 3) {

                //                 return false;
                //             }
                //         }


                //         return ($endDate->lt($nowtime));
                //     })

                //     ->hideWhenCreating()->hideWhenUpdating(),
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
                            if (($endDate->lt($nowtime))) {

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
                Text::make(__("QawafilAlaqsa describe"), "project_describe")->hideFromIndex(),

                Select::make(__("Repetition"), "repetition")->options([
                    '6' => __('Once'),
                    '1' => __('daily'),
                    '2' => __('weekly'),
                    '3' => __('fortnightly'),
                    '4' => __('Monthly'),
                    '5' => __('annual'),
                ])->rules('required')->singleSelect()->hideFromIndex(),


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
                BelongsTo::make(__('Area'), 'AreaProject', \App\Nova\Area::class)->hideWhenCreating()->hideWhenUpdating(),
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
                    })->hideFromIndex()->hideFromDetail()->singleSelect(),


                Flexible::make(__('newadres'), 'newadresFrom')
                    ->limit(1)
                    ->hideFromDetail()->hideFromIndex()
                    ->addLayout(__('Add new bus'), 'bus', [
                        Text::make(__('Name'), "name_address"),
                        Multiselect::make(__('city'), 'city_id')
                            ->options(function () {
                                $Areas =  \App\Models\City::all();

                                $Area_type_admin_array =  array();

                                foreach ($Areas as $Area) {


                                    $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                                }

                                return $Area_type_admin_array;
                            })->singleSelect()->hideFromIndex()->hideFromDetail(),
                        Text::make(__("phone number"), "phone_number_address"),
                        MapsAddress::make(__('Address'), 'current_location')
                            ->zoom(15)->center(['lat' =>  31.77624246761854, 'lng' => 35.236198620223036])
                            ->types(['establishment']),
                    ]),
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

                Boolean::make(__('is_has_Donations'), 'is_donation')
                    ->hideFromIndex()
                    ->default(true),
                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating()->hideFromIndex(),
                Text::make(__("TripBooking number"), 'TripBooking number', function () {
                    $buss = $this->bus;
                    $number = 0;
                    $text = '';
                    foreach ($buss as $key => $bus) {
                        $number_of_people = TripBooking::where([
                            ['bus_id', $bus->id],
                            ['status', '1'],
                        ])->sum('number_of_people');
                        $text .=  'اسم الباص:    '  . $bus->bus_number . "   " . 'عدد  الاشخاص المتبقي:    ' . ($bus->number_of_seats - $number_of_people) . "</br>";

                        $number +=  $number_of_people;
                    }
                    $number +  $number . "</br>";
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
        if (!($request->newadresFrom  || $request->trip_from)) {

            $validator->errors()->add('trip_from', 'يجب اضافة عنوان');
        }
        if ($request->newadresFrom  &&  empty(($request->trip_from))) {




            if (!isset($request->newadresFrom[0]['attributes']['name_address'])) {
                $validator->errors()->add($request->newadresFrom[0]['key'] . '__name_address', 'هذا الحقل مطلوب');
            }
            if (!isset($request->newadresFrom[0]['attributes']['city_id'])) {
                $validator->errors()->add($request->newadresFrom[0]['key'] . '__city_id', 'هذا الحقل مطلوب');
            }

            if (($request->newadresFrom[0]['attributes']['current_location']) == 'null') {
                $validator->errors()->add($request->newadresFrom[0]['key'] . '__current_location', 'هذا الحقل مطلوب');
            }
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

        $replicationIntervals = [
            "1" => 1,          // 1 day
            "2" => 7,          // 7 days
            "3" => 14,         // 14 days
            "4" => 1,          // 1 month
            "5" => 12,         // 1 year (12 months)
        ];
        $interval = isset($replicationIntervals[$model->repetition]) ? $replicationIntervals[$model->repetition] : 0;
        if ($interval > 0) {
            for ($i = 1; $i <= 7; $i++) {
                $newProjectId = DB::table('projects')->insertGetId([
                    'project_type' => 2,
                    'project_name' => $model->project_name,
                    'project_describe' => $model->project_describe,
                    'city' => $model->city,
                    'area' => $model->area,
                    'sector'=> '5',
                    'repetition' => $model->repetition,
                    'admin_id' => $model->admin_id,
                    'trip_from' => $model->trip_from,
                    'trip_to' => $model->trip_to,
                    'start_date' => $model->start_date,
                    'end_date' => $model->end_date,
                    'note' => $model->note,
                    'created_by' => $model->created_by,

                ]);
                $newProject = DB::table('projects')->where('id', $newProjectId)->first();
                if ($interval < 12) {
                    $newStartDate = Carbon::parse($newProject->start_date)->addDays($interval * $i);
                    $newEndDate = Carbon::parse($newProject->end_date)->addDays($interval * $i);
                } else {
                    $newStartDate = Carbon::parse($newProject->start_date)->addMonths($interval * $i);
                    $newEndDate = Carbon::parse($newProject->end_date)->addMonths($interval * $i);
                }

                DB::table('projects')->where('id', $newProjectId)->update([
                    'start_date' => $newStartDate,
                    'end_date' => $newEndDate,
                ]);

                DB::table('project_status')->insert([
                    'project_id' => $newProjectId,
                    'status' => 2,
                ]);
            }
        }
    }
    public static function beforesave(Request $request, $model)
    {
        if ($request->project_describe == null) {
            $request->merge(['project_describe' => '']);
        }
        if ($request->trip_from) {
            address::find($request->trip_from);
            $model->city = address::find($request->trip_from)->city_id;
            $model->area = address::find($request->trip_from)->area_id;
        } else {
            $id = Auth::id();
            if ($request->newadresFrom) {
                $address = address::create([
                    'name_address' => $request->newadresFrom[0]['attributes']['name_address'],
                    'description' => " ",
                    'city_id' => $request->newadresFrom[0]['attributes']['city_id'],
                    'phone_number_address' => $request->newadresFrom[0]['attributes']['phone_number_address'],
                    'current_location' => json_decode($request->newadresFrom[0]['attributes']['current_location']),
                    "number" => "1",
                    'status' => 1,
                    'type' => 1,
                    'created_by' => $id
                ]);
                $request->merge(['trip_from' => $address->id]);

                $model->city = address::find($address->id)->city_id;
                $model->area = address::find($address->id)->area_id;
            }
        }
        $request->request->remove('newadresFrom');
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
        $buses = $model->Bus;
        $newProjects = Project::where('project_name', $model->project_name)
            ->where('trip_from', $model->trip_from)
            ->get();
        $newProjects->map(function ($project) use ($buses) {
            // Loop through each bus and attach it to the project if not already attached
            $buses->each(function ($bus) use ($project) {
                if (!$project->Bus->contains($bus->id)) {
                    $project->Bus()->attach($bus->id);
                }
            });
        });
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
                (new DateRangeFilter(__("From_to"), "start_date"))->withMeta(['width' => 'w-1/3']),
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
            new DateRangeFilter(__("From_to"), "start_date"),



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
