<?php

namespace App\Nova;

use App\Nova\Actions\ExportBusesCompany;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\HasMany;

class BusesCompany extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BusesCompany::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("BusesCompanyparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    public static function createButtonLabel()
    {
        return 'انشاء شركة';
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group = 'Admin';
    public static $priority = 7;
    public static function label()
    {
        return __('Buses Company');
    }

    public static function group()
    {
        return __('Public Administration');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        //     'Created_By','Update_By'

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__("Name"),"name") ->rules('required'),
            Text::make(__("Describtion"),"description"),
            Number::make(__("number of buses"),"number_of_buses")->step(1.0),
            Number::make(__("cost"),"cost")->step(1.0),
            Text::make(__("contact person"),"contact_person"),
            Text::make(__("contact person phone"),"phone_number"),

            // Text::make(__("company id"),"company_id"),
            Text::make(__("bank name"),"bank_name"),
            Text::make(__("bank number"),"bank_number"),
            Text::make(__("Branch number"),"bank_branch_number"),
            Text::make(__("account number"),"account_number"),


            Select::make(__("status"),"status")
            ->options([
                '1' => __('available'),
                '2' => __('un available'),


                ])->displayUsingLabels()
            ->hideWhenCreating()->
            hideWhenUpdating(),

            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),

            HasMany::make(__('bus'),'Bus', \App\Nova\Bus::class),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }

    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by=$id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by=$id;


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
            (new ExportBusesCompany)->standalone()->withoutConfirmation(),


        ];
    }
}
