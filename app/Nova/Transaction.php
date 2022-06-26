<?php

namespace App\Nova;


use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $displayInNavigation = false;
    public static $title = 'id';
    public static $group = 'Admin';

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
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Select::make('Transactions Type ', 'transactions_type')->options([
                0 => 'Payment voucher',
                1 => 'receipt voucher',
             ])->displayUsingLabels(),

            Select::make('type ', 'type')->options([
                "alhasala" => 'alhasala',
                "donation"=> 'donation',
                'trip' => 'trip',
            ])->displayUsingLabels(),


                NovaDependencyContainer::make([
                Select::make('alhasala','ref_id')
                ->options( function() {
                $users =  \App\Models\Alhisalat::all();
                $user_type_admin_array =  array();
                foreach($users as $user) {
                $user_type_admin_array += [$user['id'] => ($user['name'] )];
                }
                return $user_type_admin_array;
                }),







                ])->dependsOn('type', 'alhasala'),

                BelongsTo::make('Alhisalat ', 'Alhisalat', \App\Nova\Alhisalat::class)->hideWhenCreating()->
                hideWhenUpdating(),



                NovaDependencyContainer::make([
                    Select::make('Trip','ref_id')
                    ->options( function() {
                    $users =  \App\Models\Trip::all();
                    $user_type_admin_array =  array();
                    foreach($users as $user) {
                    $user_type_admin_array += [$user['id'] => ($user['name'] )];
                    }
                    return $user_type_admin_array;
                    })->hideFromIndex()->hideFromDetail(),


                   BelongsTo::make('Trip ', 'Trip', \App\Nova\Trip::class)->exceptOnForms(),

                                    ])->dependsOn('type', "trip"),


                // Select::make("transactions status","transactions_status")->options([
                //     '0' => 'not',
                //     '1' => 'ok',

                //     ])->default(0)
                //     ->hideFromIndex() ,

                    // Text::make('Description')->rules('max:255')->displayUsing(function ($text) {

                    //     if (strlen($text) > 30) {
                    //         return substr($text, 0, 30) . '...';
                    //     }
                    //     return $text;
                    // }),


                    Text::make('equivalent amount','equivalent_amount'),


                    // Select::make('Currency','Currency')->options(\App\Models\Currency::pluck('name')),
                    Select::make('Currency','Currency')
                    ->options( function() {
                    $users =  \App\Models\Currency::all();
                    $user_type_admin_array =  array();
                    foreach($users as $user) {
                    $user_type_admin_array += [$user['name'] => ($user['name'] )];
                    }
                    return $user_type_admin_array;
                    }),
                    Select::make('approval ', 'approval')->options([
                        1 => 'approval',
                        2=> 'reject',
                    ])->displayUsingLabels()->hideWhenCreating()->
                    hideWhenUpdating(),
                    Text::make("reason_of_reject","reason_of_reject")->hideWhenCreating()->
                    hideWhenUpdating(),


            // Select::make("transactions_type","transactions_type")->options([
            //     '0' => 'not',
            //     '1' => 'ok',

            //     ])->default(0)
            //     ->hideFromIndex() ,

            Date::make('date','date'),




        ];
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
            (new Actions\ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
              return  ($user->type() == 'admin'|| $user->type() == 'financial_user');
            }),
        ];
    }
}
