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
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Select;
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
            Text::make("Name", "name"),
            BelongsTo::make('address', 'address')->nullable(),



            Select::make('add adres', 'name_format')->options([
                0 => 'no',
                1 => 'yes',

            ])->displayUsingLabels()
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),

            NovaDependencyContainer::make([

                Text::make("Name", "name_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                Text::make("description", "description")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                Text::make("phone number", "phone_number_address")->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
                GoogleMaps::make('current_location', 'current_location')
                    ->zoom(8)->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                        return null;
                    }),
                Select::make("Status", "address_status")->options([
                    '1' => 'active',
                    '2' => 'not active',
                ])->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            ])->dependsOn('name_format', 1),


            Number::make("number alhisala", "number_alhisala"),


            Multiselect::make("Status", "status")->options([
                '1' => 'تم انشاء الحصالة',
                '2' => 'نم جمع الحصالة',
                '3' => 'مكتملة',

            ])->singleSelect()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


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

            (new Actions\ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
                return ($user->type() == 'admin' || $user->type() == 'regular_area');
            }),
        ];
    }
}
