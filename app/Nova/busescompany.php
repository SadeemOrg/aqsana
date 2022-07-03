<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Facades\Auth;

class busescompany extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\busescompany::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group = 'Admin';
    public static function label()
    {
        return __('Buses Company');
    }
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
    public function fields(Request $request)
    {
        //     'Created_By','Update_By'

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("name","name"),
            Text::make("description","description"),
            Number::make("cost","cost")->step(1.0),
            Number::make("number of buses","number_of_buses")->step(1.0),
            Text::make("contact person","contact_person"),
            Number::make("phone number","phone_number"),


            Select::make("status","status")
            ->options([
                '1' => 'available',
                '2' => 'un available',


                ])->displayUsingLabels()
            ->hideWhenCreating()->
            hideWhenUpdating(),

            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),



        ];
    }

    public static function afterCreate(Request $request, $model)
    {   $id = Auth::id();
        $model->update([
            'created_by'=>$id,
            ]);
    }

    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update([
            'update_by'=>$id,

        ]);
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
        return [];
    }
}
