<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;


class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $priority = 1 ;
    public static $title = 'name';
    public static function label()
    {
        return __('delegate');
    }
    public static function group()
    {
        return __('address');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
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

            Gravatar::make()->maxWidth(50),
            Text::make(__('id_number'),'id_number')
            ->sortable()
            ->rules('required', 'max:255'),
            Text::make(__('Name'),'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('email'),'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Password'),'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),



            Number::make(__('Phone'), 'phone')
                ->textAlign('left'),
            Date::make('Birth Date', 'birth_date'),
            Image::make(__('photo'), 'photo')->disk('public'),
            Text::make(__('city'),'city')
            ->sortable()
            ->rules('required', 'max:255'),
            BelongsTo::make(__('Role'),'Role',\App\Nova\Role::class),
            Date::make('start_work_date', 'start_work_date'),
            Select::make(__('martial_status'), 'martial_status')->options([
                1 => __('single'),
                2 => __('married'),
                3 => __('separated'),
                4 => __('engaged'),
                5 => __('divorced'),
                6 => __('widower'),


            ])->displayUsingLabels(),
            Text::make(__('user_number'),'user_number')
            ->sortable()
            ->rules('required', 'max:255'),
            Text::make(__('bank_name'),'bank_name')
            ->sortable()
            ->rules('required', 'max:255'),
            Text::make(__('bank_branch'),'bank_branch')
            ->sortable()
            ->rules('required', 'max:255'),
            Text::make(__('account_number'),'account_number')
            ->sortable()
            ->rules('required', 'max:255'),
            // BelongsTo::make('City'),





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
