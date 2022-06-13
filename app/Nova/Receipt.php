<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;

class Receipt extends Resource
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
    use HasDependencies;

    public function fields(Request $request)
    {
        return [

            Select::make('Transactions Type ', 'transactions_type')->options([
                0 => 'Payment voucher',
                1 => 'receipt voucher',
             ]),

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
                $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                }
                return $user_type_admin_array;
                }),
                ])->dependsOn('type', 'alhasala'),


                NovaDependencyContainer::make([
                Select::make('donation','ref_id')
                ->options( function() {
                $users =  \App\Models\Alhisalat::all();

                $user_type_admin_array =  array();

                foreach($users as $user) {
                $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                }

                return $user_type_admin_array;
                }),
                ])->dependsOn('type', "donation"),

                NovaDependencyContainer::make([
                Select::make('trip','ref_id')
                ->options( function() {
                $users =  \App\Models\Alhisalat::all();
                $user_type_admin_array =  array();
                foreach($users as $user) {
                $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                }
                return $user_type_admin_array;
                }),
                ])->dependsOn('type', "trip"),

                Select::make("transactions status","transactions_status")->options([
                    '0' => 'not',
                    '1' => 'ok',

                    ])->default(0)
                    ->hideFromIndex() ,
                    Select::make('alhasala','Currency')
                    ->options( function() {
                    $users =  \App\Models\Alhisalat::all();
                    $user_type_admin_array =  array();
                    foreach($users as $user) {
                    $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                    }
                    return $user_type_admin_array;
                    }),

                    Date::make('date','date'),

            // NovaDependencyContainer::make([

            //     Select::make('type ', 'type')->options([
            //         0 => 'alhasala',
            //         1 => 'donation',
            //     ])->displayUsingLabels(),
            //     ])->dependsOn('transactions_type', 0),


            //     NovaDependencyContainer::make([
            //     Select::make('type ', 'type')->options([
            //         0 => 'alhasala',
            //         1 => 'donation',
            //         2 => 'trip',
            //     ])->displayUsingLabels(),
            //     ])->dependsOn('transactions_type', 1),

            //     NovaDependencyContainer::make([
            //     Select::make('alhasala','ref_id')
            //         ->options( function() {
            //     $users =  \App\Models\Alhisalat::all();
            //     $user_type_admin_array =  array();
            //     foreach($users as $user) {
            //     $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
            //     }
            //     return $user_type_admin_array;
            //     }),
            //     ])->dependsOn('type', 0),

            //     NovaDependencyContainer::make([
            //     Select::make('alhasala','ref_id')
            //     ->options( function() {
            //     $users =  \App\Models\Alhisalat::all();

            //     $user_type_admin_array =  array();

            //     foreach($users as $user) {
            //     $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
            //     }

            //     return $user_type_admin_array;
            //     }),
            //     ])->dependsOn('type', 1),

            //     NovaDependencyContainer::make([
            //     Select::make('alhasala','ref_id')
            //     ->options( function() {
            //     $users =  \App\Models\Alhisalat::all();
            //     $user_type_admin_array =  array();
            //     foreach($users as $user) {
            //     $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
            //     }
            //     return $user_type_admin_array;
            //     }),
            //     ])->dependsOn('type', 2),


            //     ID::make(__('ID'), 'id')->sortable(),
            //     Select::make('type')->options([
            //     'S' => 'Small',
            //     'M' => 'Medium',
            //     'L' => 'Large',
            //     ]),
            // Text::make('ref_id'),


            // NovaBelongsToDepend::make('Trip')
            // ->placeholder('Optional Placeholder') // Add this just if you want to customize the placeholder
            // ->options(\App\Models\Trip::all()),

            // NovaBelongsToDepend::make('Role')
            // ->optionsResolve(function ($Trip) {
            // return $Trip->Debenture()->get(['id']);
            // return $Trip->name;
            // return "ff";// [$Trip->id => $Trip->name] ;
            // $users = DB::table($Trip)->get();

            // return [$users->id => ($users->name)] ;
            // $buses =  array();
            // foreach($users as $bus) {
            //     $buses += [$bus['id'] => ($bus['name'])];
            // }
            // return $buses;
            // return $Trip->Cities()->get(['id','name']);
            // })->dependsOn('Trip'),
            // Text::make('Recipient')
            // ->readonly()
            // ->dependsOn(
            // ['type'],
            // function (Text $field, NovaRequest $request, FormData $formData) {
            // if ($formData->type === 'gift') {
            //     $field->readonly(false)->rules(['required', 'email']);
            // }
            // }
            // ),
            // Select::make('ref_id','ref_id')

            // ->options( function($values) {
            //     $ref = DB::table('type')->get();

            //     $buses_db = Transaction::where("status","1")->get();
            //      $buses =  array();

            //     foreach($buses_db as $bus) {
            //         $buses += [$ref['id']];
            //     }

            //     return $buses;
            //    }),
            // Select::make('transactions_type')->options([
            // 'S' => 'Small',
            // 'M' => 'Medium',
            // 'L' => 'Large',
            // ]),
            // Text::make('equivalent_amount'),
            // Select::make('Currency')->options([
            // 'S' => 'Small',
            // 'M' => 'Medium',
            // 'L' => 'Large',
            // ]),
            // // Number::make("transactions_type","transactions_type"),


            Select::make("transactions_type","transactions_type")->options([
                '0' => 'not',
                '1' => 'ok',

                ])->default(0)
                ->hideFromIndex() ,

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
        return [];
    }
}
