<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\File;
use Acme\MultiselectField\Multiselect;
use App\CPU\Helpers;
use App\Models\User;
use App\Models\Income;
use App\Models\Notification;
use App\Nova\Actions\AlhisalatColect;
use App\Nova\Actions\AlhisalatStatus;
use App\Nova\Actions\AlhisalatStatuscompleted;
use App\Nova\Actions\AlhisalatSurrender;
use App\Nova\Filters\AlhisalatStatusFilters;
use AwesomeNova\Cards\FilterCard;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Select;
use Pdmfc\NovaFields\ActionButton;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaGoogleMaps\GoogleMaps;



class Alhisalat extends Resource
{
    use HasDependencies;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label()
    {
        return __('Alhisalat');
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
        if ($request->user()->type() == 'financial_user'  ) {
            return false;
        } else return true;
    }
    public static $model = \App\Models\Alhisalat::class;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'number_alhisala';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static $priority = 4;
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
        }
        // elseif($user->type() == 'regular_area'){
        // $areas = DB::table('areas')->where('admin_id', $id)
        // ->join('cities', 'cities.area_id', '=', 'areas.id')
        // ->join('alhisalats', 'alhisalats.city_id', '=', 'cities.id')
        // ->select('alhisalats.name')->get();
        // $stack = array();
        // foreach ( $areas as $key => $value) {
        //     array_push($stack, $value->name);
        // }
        // return $query->whereIn('name', $stack);
        // }
    }



    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__("number alhisala"), "number_alhisala")->withMeta([
                'value' => uniqid(),
            ])->readonly()->hideWhenUpdating()->hideFromDetail()->hideFromIndex(),

            Text::make(__("number alhisala"), "number_alhisala")
                ->readonly()->hideWhenCreating(),

            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to colect  this Alhisalat?'))
                    ->confirmButtonText(__('colect'))
                    ->cancelButtonText(__('Dont colect')), $this->id)
                ->canSee(function () {
                    return $this->status === '1';
                })->text(__('colect'))->showLoadingAnimation()
                ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),



            ActionButton::make(__('colect'))
                ->action((new AlhisalatSurrender)->confirmText(__('Are you sure you want to Surrender  this Alhisalat?'))
                        ->confirmButtonText(__('Surrender')),
                    $this->id
                )
                ->canSee(function () {
                    return $this->status === '2';
                })->text(__('AlhisalatSurrender'))->showLoadingAnimation()
                ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to read  this Alhisalat?'))
                    ->confirmButtonText(__('colect '))
                    ->cancelButtonText(__('sent done')), $this->id)
                ->canSee(function () {
                    return $this->status  >= '3';
                })->readonly()->text(__('sent done'))->showLoadingAnimation()
                ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            Select::make(__('address'), 'address_id')
                ->options(function () {
                    $id = Auth::id();
                    $addresss =  \App\Models\address::where('type', '2')->get();
                    $address_type_admin_array =  array();

                    foreach ($addresss as $address) {

                        if ($address->Area == null || $this->admin_id == $address['id']) {
                            $address_type_admin_array += [$address['id'] => ($address['name_address'])];
                        }
                    }

                    return $address_type_admin_array;
                })->hideFromIndex()->hideFromDetail()
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            BelongsTo::make(__('address'), 'address', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),


            Flexible::make(__('newadres'), 'newadres')
                ->readonly(true)
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new bus'), 'bus', [

                    Text::make(__('Name'), "name_address"),
                    Text::make(__("description"), "description"),
                    Text::make(__("phone number"), "phone_number_address"),
                    GoogleMaps::make(__('current_location'), 'current_location'),
                    Select::make(__("Status"), "address_status")->options([
                        '1' => __('active'),
                        '2' => __('not active'),
                    ]),

                ]),


            //     Select::make(__('add adres'), 'name_format')->options([
            //     0 => __('no'),
            //     1 => __('yes'),

            // ])->displayUsingLabels()
            //     ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     })->hideFromIndex()->hideFromDetail(),

            // NovaDependencyContainer::make([

            //     Text::make(__('Name'), "name_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            //     Text::make(__("description"), "description")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            //     Text::make(__("phone number"), "phone_number_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            //     GoogleMaps::make(__('current_location'), 'current_location')
            //         ->zoom(8)->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //             return null;
            //         }),
            //     Select::make(__("Status"), "address_status")->options([
            //         '1' => __('active'),
            //         '2' => __('not active'),
            //     ])->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            // ])->dependsOn('name_format', 1),





            Multiselect::make(__("Status"), "status")->options([
                '1' => 'تم  الوضع',
                '2' => 'تم جمع ',
                '3' => 'تم التسليم',
                '4' => 'تم العد',


            ])->singleSelect()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

        ];
    }

    public static function beforeCreate(Request $request, $model)
    {

        // dd($request->address_id);
        // $request->address_id=2;
        $id = Auth::id();
        $model->created_by = $id;
        $model->status = '1';
        $users = User::where('user_role', 'admin')->get();



        $tokens = [];

        foreach ($users as $key => $user) {

            $notification = Notification::where('id', '4')->first();

            if ($user->fcm_token != null && $user->fcm_token != "") {
                array_push($tokens, $user->fcm_token);
            }
        }

        if (!empty($tokens)) {

            Helpers::send_notification($tokens, $notification);
        }
        // $model->number_alhisala = '1';

        // dd( $model);

    }
    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
    }
    public static function beforeSave(Request $request, $model)
    {

        $model->number_alhisala = $request->number_alhisala;

        // $request->address = '2';
        // dd($request->number_alhisala);
        // dd($request->address);
        // dd($request->newadres[0]['attributes']['name_address']);
        $id = Auth::id();
        // $request->address='1';
        if (!$request->address_id) {
            if ($request->newadres[0]['attributes']['name_address'] && $request->newadres[0]['attributes']['description'] && $request->newadres[0]['attributes']['phone_number_address'] && $request->newadres[0]['attributes']['current_location'] && $request->newadres[0]['attributes']['address_status']) {
                //   dd("hf");
                DB::table('addresses')
                    ->Insert(
                        [
                            'name_address' => $request->newadres[0]['attributes']['name_address'],
                            'description' => $request->newadres[0]['attributes']['description'],
                            'phone_number_address' => $request->newadres[0]['attributes']['phone_number_address'],
                            'current_location' => $request->newadres[0]['attributes']['current_location'],
                            'status' => $request->newadres[0]['attributes']['address_status'],
                            'type' => '2',
                            'created_by' => $id
                        ]
                    );
                $address =  \App\Models\address::where('name_address',  $request->newadres[0]['attributes']['name_address'])->first();
                DB::table('alhisalats')
                    ->where('id', $model->id)
                    ->update(['address_id' => $address->id]);
            }
        } else   $model->address_id = $request->address_id;
        // dd("finsh");
    }

    // public static function  beforeSave(Request $request, $model)

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new FilterCard(new AlhisalatStatusFilters()),
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
            new AlhisalatStatusFilters()
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

            (new AlhisalatColect),
            //     ->canSee(function ($request) {
            //         $model = $request->findModelQuery()->first();
            //         if ($request->status == '1' ) {
            //             return true;
            //         }
            //     }
            // ),
            (new AlhisalatStatuscompleted),
            //     ->canSee(function () {
            //         if ($this->status == '2' ) {
            //             return true;
            //         }
            //     }
            // ),
            (new AlhisalatSurrender),
        ];
    }
}
