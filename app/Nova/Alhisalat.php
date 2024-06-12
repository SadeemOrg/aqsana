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
use App\Models\address;
use App\Models\Alhisalat as ModelsAlhisalat;
use App\Models\User;
use App\Models\Income;
use App\Models\Notification;
use App\Nova\Actions\AlhisalatColect;
use App\Nova\Actions\AlhisalatDelete;
use App\Nova\Actions\AlhisalatStatus;
use App\Nova\Actions\AlhisalatStatuscompleted;
use App\Nova\Actions\AlhisalatSurrender;
use App\Nova\Filters\AlhisalatAddress;
use App\Nova\Filters\AlhisalatArea;
use App\Nova\Filters\AlhisalatCite;
use App\Nova\Filters\AlhisalatStatusFilters;
use App\Nova\Metrics\NewAlhisalat;
use App\Rules\AlhisalatMap;
use AwesomeNova\Cards\FilterCard;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\ActionResource;
use Pdmfc\NovaFields\ActionButton;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;
use Mauricewijnia\NovaMapsAddress\MapsAddress;

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
        return __('Financial management');
    }


    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Alhisalatparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
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
        'id', 'number_alhisala'
    ];
    public static $priority = 4;
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     $user = Auth::user();
    //     $id = Auth::id();
    //     if ($user->type() == 'admin') {
    //         return $query;
    //     }
    //     // elseif($user->type() == 'regular_area'){
    //     // $areas = DB::table('areas')->where('admin_id', $id)
    //     // ->join('cities', 'cities.area_id', '=', 'areas.id')
    //     // ->join('alhisalats', 'alhisalats.city_id', '=', 'cities.id')
    //     // ->select('alhisalats.name')->get();
    //     // $stack = array();
    //     // foreach ( $areas as $key => $value) {
    //     //     array_push($stack, $value->name);
    //     // }
    //     // return $query->whereIn('name', $stack);
    //     // }
    // }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $userRoles = $request->user()->userrole();
        if (!in_array("super-admin", $userRoles)) {
            $query = $query->whereHas('address', function($query) use ($request) {
                $query->where('city_id', $request->user()->city);
            });
        }

        return $query;
    }

    public function fields(Request $request)
    {

        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__("number alhisala"), "number_alhisala")
                ->readonly()->hideWhenCreating()->hideWhenUpdating(),



            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to colect  this Alhisalat?'))
                    ->confirmButtonText(__('colect'))
                    ->cancelButtonText(__('Dont colect')), [$this->id])
                ->canSee(function () {
                    return $this->status === '1';
                })->text(__('colect'))->showLoadingAnimation()
                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),



            ActionButton::make(__('colect'))
                ->action((new AlhisalatSurrender)->confirmText(__('Are you sure you want to Surrender  this Alhisalat?'))
                        ->confirmButtonText(__('Surrender')),
                    [$this->id]
                )
                ->canSee(function () {
                    return $this->status === '2';
                })->text(__('AlhisalatSurrender'))->showLoadingAnimation()
                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to read  this Alhisalat?'))
                    ->confirmButtonText(__('colect '))
                    ->cancelButtonText(__('sent done')), [$this->id])
                ->canSee(function () {
                    return $this->status  >= '3';
                })->readonly()->text(__('sent done'))->showLoadingAnimation()
                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),


            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to read  this Alhisalat?'))
                    ->confirmButtonText(__('colect '))
                    ->cancelButtonText(__('sent done')), [$this->id])
                ->canSee(function () {
                    return $this->status == '0';
                })->readonly()->text(__('لا يمكن الجمع '))->showLoadingAnimation()->buttonColor('#3374FF')
                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),


            ActionButton::make(__('حصالة مفقودة'))

                ->action((new AlhisalatDelete)
                    ->confirmText(__('Are you sure you want to colect  this Alhisalat?'))
                    ->confirmButtonText(__('حصالة مفقودة'))
                    ->cancelButtonText(__('الغاء')), [$this->id])
                ->canSee(function () {
                    return $this->status != '0';
                })->readonly(function () {
                    return $this->status  >= '3';
                })
                ->text(__('حصالة مفقودة'))->showLoadingAnimation()
                ->loadingColor('#FF3333')->buttonColor('#FF3333')->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('colect'))
                ->action((new AlhisalatColect)->confirmText(__('Are you sure you want to read  this Alhisalat?'))
                    ->confirmButtonText(__('colect '))
                    ->cancelButtonText(__('sent done')), [$this->id])
                ->canSee(function () {
                    return $this->status == '0';
                })->readonly()->text(__('delete done'))->showLoadingAnimation()->buttonColor('#3374FF')
                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),




            Multiselect::make(__('saved addresss'), 'address_id')
                ->options(function () {
                    $id = Auth::id();
                    $addresss =  \App\Models\address::where('type', '2')->get();
                    $address_type_admin_array =  array();

                    foreach ($addresss as $address) {

                        $address_type_admin_array += [$address['id'] => ($address['name_address'])];
                    }

                    return $address_type_admin_array;
                })->singleSelect()->hideFromIndex()->hideFromDetail()
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),



            BelongsTo::make(__('saved addresss'), 'address', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),




            Flexible::make(__('newadres'), 'newadres')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new bus'), 'bus', [
                    Text::make(__('Name'), "name_address")->rules('required'),
                    Text::make(__("description"), "description")->rules('required'),
                    Text::make(__("phone number"), "phone_number_address")->rules('required'),
                    MapsAddress::make(__('Address'), 'current_location')
                        ->zoom(15)->center(['lat' =>  31.77624246761854, 'lng' => 35.236198620223036])
                        ->types(['establishment'])->rules(new AlhisalatMap(), 'required'),
                ])->hideWhenUpdating(),

            Multiselect::make(__("Status"), "status")->options([
                '1' => 'تم  الوضع',
                '2' => 'تم جمع ',
                '3' => 'تم التسليم',
                '4' => 'تم العد',
            ])->singleSelect()->hideWhenCreating()->hideWhenUpdating()->rules('required'),
            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {

        if (!($request->newadres  || $request->address_id)) {
            $validator->errors()->add('address_id', 'يجب اضافة عنوان');
        }
    }
    public static function beforesave(Request $request, $model)
    {

        if ($request->address_id) {
            $addresses = DB::table('addresses')->where('id', $request->address_id)->first();
            $countt = $addresses->number + 1;
            DB::table('addresses')->where('id', $request->address_id)->update(['number' => $countt]);
            $model->number_alhisala =   $addresses->name_address . " " . $countt;
            $model->address_id = $addresses->id;
        } else {
            $id = Auth::id();
            if ($request->newadres) {
                // dd(json_decode( $request->newadres[0]['attributes']['current_location']));
                $address = address::create([
                    'name_address' => $request->newadres[0]['attributes']['name_address'],
                    'description' => $request->newadres[0]['attributes']['description'],
                    'phone_number_address' => $request->newadres[0]['attributes']['phone_number_address'],
                    'current_location' => json_decode($request->newadres[0]['attributes']['current_location']),
                    "number" => "1",
                    'status' => 1,
                    'type' => 2,
                    'created_by' => $id
                ]);
                $model->number_alhisala =  $address->name_address . " 1";
                $model->address_id = $address->id;
            }
        }
        $request->request->remove('newadres');
    }


    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
        $model->status = '1';
    }
    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
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
            new FilterCard(new AlhisalatStatusFilters()),
            new NewAlhisalat()
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
            new AlhisalatStatusFilters(),
            new AlhisalatArea(),
            new AlhisalatCite(),
            new AlhisalatAddress(),
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

            (new  AlhisalatSurrender),


            (new AlhisalatDelete),

        ];
    }
    public function tools(Request $request)
    {
        return [
            (new AlhisalatColect)->canSee(function ($request) {
                return true;
            }),
        ];
    }
}
