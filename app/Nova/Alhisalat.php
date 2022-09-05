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
use App\Models\User;
use App\Models\Income;
use App\Nova\Actions\AlhisalatStatus;
use App\Nova\Actions\AlhisalatStatuscompleted;
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



    public static $model = \App\Models\Alhisalat::class;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            Text::make(__("Name"), "name"),
            ActionButton::make(__('POST NEWS'))
            ->action((new AlhisalatStatus)->confirmText('Are you sure you want to read  this Massage?')
                ->confirmButtonText(__('post'))
                ->cancelButtonText(__('Dont post')), $this->id)
                ->canSee(function () {
                return $this->status === '1';
            })->text(__('colect'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('POST NEWS'))
            ->action((new AlhisalatStatuscompleted)->confirmText('Are you sure you want to read  this Massage?')
                ->confirmButtonText(__('post'))
                ->cancelButtonText(__('Dont post')), $this->id)
                ->canSee(function () {
                return $this->status === '2';
            })->text(__('Complet'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('finsh'))
            ->action((new AlhisalatStatuscompleted)->confirmText('Are you sure you want to read  this Massage?')
                ->confirmButtonText(__('post'))
                ->cancelButtonText(__('Dont post')), $this->id)
                ->canSee(function () {
                return $this->status === '3';
            })
            ->readonly()
            ->text(__('Finsh'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            BelongsTo::make(('address'), 'address')->nullable(),



            Select::make(__('add adres'), 'name_format')->options([
                0 => 'no',
                1 => 'yes',

            ])->displayUsingLabels()
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->hideFromIndex()->hideFromDetail(),

            NovaDependencyContainer::make([

                Text::make(__('Name'), "name_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                Text::make(__("description"), "description")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                Text::make(__("phone number"), "phone_number_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                GoogleMaps::make(__('current_location'), 'current_location')
                    ->zoom(8)->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    }),
                Select::make(__("Status"), "address_status")->options([
                    '1' => 'active',
                    '2' => 'not active',
                ])->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            ])->dependsOn('name_format', 1),


            Number::make(__("number alhisala"), "number_alhisala"),


            Multiselect::make(__("Status"), "status")->options([
                '1' => 'تم انشاء الحصالة',
                '2' => 'تم جمع الحصالة',
                '3' => 'مكتملة',

            ])->singleSelect()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),
                  BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),

        ];
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
    public static function afterSave(Request $request, $model)
    {
        $id = Auth::id();
        if (!$model->address_id) {
            if ($request->name_address && $request->description && $request->phone_number_address && $request->current_location && $request->address_status) {
                DB::table('addresses')
                    ->Insert(
                        [
                            'name_address' => $request->name_address,
                            'description' => $request->description,
                            'phone_number_address' => $request->phone_number_address,
                            'current_location' => $request->current_location,
                            'status' => $request->address_status,
                            'created_by' => $id
                        ]
                    );
                $address =  \App\Models\address::where('name_address', $request->name_address)->first();


                DB::table('alhisalats')
                    ->where('id', $model->id)
                    ->update(['address_id' => $address->id]);
            }
        }
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

            (new AlhisalatStatus),
        //     ->canSee(function ($request) {
        //         $model = $request->findModelQuery()->first();
        //         if ($request->status == '1' ) {
        //             return true;
        //         }
        //     }
        // ),
          (  new AlhisalatStatuscompleted)
        //     ->canSee(function () {
        //         if ($this->status == '2' ) {
        //             return true;
        //         }
        //     }
        // ),
        ];
    }
}
