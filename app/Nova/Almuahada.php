<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use EricLagarda\SettingsCard\SettingsCard;
use Whitecube\NovaFlexibleContent\Flexible;

class Almuahada extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Almuahada::class;

    public static function label()
    {
        return __('Almuahad');
    }

    public static function group()
    {
        return __('Almuahad');
    }
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
            Text::make(__('Name'), 'name'),
            Text::make(__('city'), 'city'),
            Text::make(__('phone'), 'phone'),
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
        return [
            (new SettingsCard)->fields([
                __('hawl almuahada') => [
                    Text::make(__('main text'), 'text_main'),
                    Text::make(__('title 1'), 'Almuahada_text_1'),
                    Text::make(__('sup text 1'), 'Almuahada_sup_text_1'),
                    Text::make(__('title 2'), 'Almuahada_text_2'),
                    Text::make(__('sup text 2'), 'Almuahada_sup_text_2'),
                    Text::make(__('title 3'), 'Almuahada_text_3'),
                    Text::make(__('sup text 3'), 'Almuahada_sup_text_3'),

                    Text::make(__('Form text'), 'Almuahada_Form_text_3'),
                    Text::make(__('Form sup text'), 'Almuahada_Form_sup_text_3'),
                ],
                // __(__('hawl almuahada 1')) => [


                // ],
                // __(__('hawl almuahada 2')) => [



                // ],
                // __(__('hawl almuahada 3')) => [


                // ]

            ],  )->name(__('Almuahad')),
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
