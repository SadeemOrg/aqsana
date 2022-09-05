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
use App\Models\address;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use App\Models\Bus;
use App\Models\BusesCompany;
use App\Nova\Actions\AddBus;
use Benjacho\BelongsToManyField\BelongsToManyField;

use Whitecube\NovaFlexibleContent\Flexible;
use Gwd\FlexibleContent\FlexibleContent;

use Laravel\Nova\Panel;
use App\Nova\Actions\ChangeRole;
use Laravel\Nova\Fields\Markdown;
use Pdmfc\NovaFields\ActionButton;

use Fourstacks\NovaRepeatableFields\Repeater;

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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function label()
    {
        return __('QawafilAlaqsa');
    }
    public static function group()
    {
        return __('project');
    }
    public static function availableForNavigation(Request $request)
    {
        if ($request->user()->type() == 'website_admin') {
            return false;
        } else return true;
    }
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

            return $query->where('project_type', '2');
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
        return $query->whereIn('id', $stack)->where('project_type', '2');
    }
    public function fields(Request $request)
    {
        return [
            (new Panel(__('main'), [
                ID::make(__('ID'), 'id')->sortable(),
                ActionButton::make(__('Action'))
                    ->action(ApprovalRejectProjec::class, $this->id)
                    ->text(__('acsept'))
                    ->showLoadingAnimation()
                    ->loadingColor('#fff')->buttonColor('#21b970')
                    ->canSee(function () {
                        $user = Auth::user();

                        if ($user->type() == 'regular_city') {
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

                    BelongsTo::make('trip from', 'tripfrom', \App\Nova\address::class),
                DateTime::make(__('projec start'), 'start_date'),
                DateTime::make(__('projec end'), 'end_date'),


                Boolean::make(__('is_bus'), 'is_bus'),
                Boolean::make(__('is_has_volunteer'), 'is_volunteer'),
                Boolean::make(__('is_has_Donations'), 'is_donation'),


                // Select::make(__('is_reported'), 'is_reported')->options([
                //     '1' => 'نعم',
                //     '0' => 'لا',
                // ])->displayUsingLabels(),


                NovaDependencyContainer::make([
                    Text::make(__("Title"), 'report_title'),
                    Textarea::make(__('description'), 'report_description'),
                    Tiptap::make(__('Contents'), 'report_contents')
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


                    Image::make(__('Image'), 'report_image')->disk('public')->prunable(),
                    ArrayImages::make(__('Pictures'), 'report_pictures')
                        ->disk('public'),
                    Text::make(__("video link"), 'report_video_link'),
                    Date::make(__('DATE'), 'report_date')->pickerDisplayFormat('d.m.Y'),

                ])->dependsOn('is_reported', '10'),

                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),
                  BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),


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
            (new Panel(__('Budget'), [

                Text::make("Budjet", "Budjet", function () {

                    $id = Auth::id();
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') {
                        $citye =   City::where('admin_id', $id)
                            ->select('id')->first();
                        // dd($id);
                        // dd($citye);
                        $bud = DB::table('transactions')
                            ->where([
                                ['ref_id', '=', $this->id],
                                ['ref_cite_id', '=', $citye['id']],
                            ])
                            ->first();

                        if ($bud)  return  $bud->equivelant_amount;
                    }
                })->canSee(function ($request) {
                    $user = Auth::user();
                    if ($user->type() == 'regular_city') return true;
                    return false;
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            ])),
            (new Panel(__('tooles'), [

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
                    if ($user->type() == 'regular_city') {
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
                    }
                })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),





            ])),
            (new Panel(__('status'), [
                Select::make(__('status'), 'status', function () {
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

                        if ($acspet)  return   $acspet->status;
                        else return "__";
                    }
                })->options([
                    '1' => 'active',
                    '2' => 'not active',
                ])
                    ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
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
                Flexible::make('newbus', 'newbus')
                    ->readonly(true)
                    ->addLayout('Add new bus', 'bus', [

                        Select::make('BusesCompany', 'BusesCompany')
                            ->options(function () {
                                $users =  \App\Models\BusesCompany::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name'])];
                                }

                                return $user_type_admin_array;
                            }),


                        Text::make("Bus Number", "bus_number"),

                        Number::make("Number person on bus", "number_person_on_bus")->step(1.0),

                        Number::make("seat price", "seat_price")->step(1.0),

                        Select::make('travel from', 'from')
                            ->options(function () {
                                $users =  \App\Models\address::all();
                                $user_type_admin_array =  array();
                                foreach ($users as $user) {
                                    $user_type_admin_array += [$user['id'] => ($user['name_address'])];
                                }

                                return $user_type_admin_array;
                            }),


                        // Select::make('travel to', 'to')
                        //     ->options(function () {
                        //         $users =  \App\Models\address::all();
                        //         $user_type_admin_array =  array();
                        //         foreach ($users as $user) {
                        //             $user_type_admin_array += [$user['id'] => ($user['name_address'])];
                        //         }

                        //         return $user_type_admin_array;
                        //     }),


                        Text::make("Name Driver", "name_driver"),
                        Text::make("phone_number", "phone_number"),

                    ])





            ])),





        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
        $model->project_type = '2';
        $model->is_bus = '1';
        $model->is_reported = '1';
        $model->sector = 'Null';
    }
    public static function beforeUpdate(Request $request, $model)
    {
        // dd($request->newbus);
        $id = Auth::id();
        $model->update_by = $id;

        $citye =   City::where('admin_id', $id)
            ->select('id')->first();

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
                            'name_driver' => $bus['attributes']['name_driver'],
                            'company_id' => $bus['attributes']['BusesCompany'],
                            'bus_number' => $bus['attributes']['bus_number'],
                            'number_of_seats' => $bus['attributes']['number_person_on_bus'],
                            'seat_price' => $bus['attributes']['seat_price'],
                            'travel_from' => $bus['attributes']['from'],
                            'travel_to' => '1',
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

        // if ($request->newbus) {
        //     $buss = json_decode($request->newbus);

        //     foreach ($buss as $user) {
        //         //  dd($user);

        //         DB::table('buses')
        //             ->insert(
        //                 ['name_driver' => $user->name_driver, 'bus_number' => $user->bus_number, 'number_of_seats' => $user->number_of_seats, 'seat_price' => $user->seat_price, 'phone_number_driver' => $user->phone_number_driver],

        //             );
        //         $bus =  \App\Models\Bus::where('bus_number', $user->bus_number)->first();


        //         // dd($users['id']);

        //         DB::table('project_bus')
        //             ->updateOrInsert(
        //                 ['project_id' => $model->id, 'city_id' => $citye['id'], 'bus_id' => $bus['id']],

        //             );
        //     }
        // }
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

                if ($user->type() == 'regular_city') {
                    return true;
                }
            }),

        ];
    }
}
