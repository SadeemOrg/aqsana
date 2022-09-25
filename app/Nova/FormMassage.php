<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\ReadMessage;
use AwesomeNova\Cards\FilterCard;
use App\Nova\Filters\StateFilter;
use App\Nova\Filters\ReadMessageFilters;
use Pdmfc\NovaFields\ActionButton;

class FormMassage extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\FormMassage::class;

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
    public static function label()
{
    return __('Form Massage');
}
public static function group()
{
    return __('Email');
}
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
            Text::make(__('Name'),'name')->readonly(),
            Text::make(__('phone'),'phone')->readonly(),
            Text::make(__('message'),'message')->readonly(),

            // ActionButton::make(__('ReadMessage'))

            //  ->readonly(function () {
            //     return $this->is_read === '1';
            // })->text(__('read done'))->showLoadingAnimation()
            // ->buttonColor('#21b970'),



            ActionButton::make(__('ReadMessage'))
            ->action((new ReadMessage) ->confirmText(__('Are you sure you want to read this Message?'))
            ->confirmButtonText('Read')
           , $this->id) ->canSee(function () {
                return $this->is_read === '0';
            })
            ->text(__('Read'))->showLoadingAnimation()
            ->loadingColor('#fff') ->svg('VueComponentName'),


            ActionButton::make(__('ReadMessage'))


            ->canSee(function () {
                return $this->is_read === '1';
            })->text(__('read done'))->readonly() ->buttonColor('#070707')
           ,


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
            new FilterCard(new ReadMessageFilters()),

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

            new ReadMessageFilters()

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

            (new ReadMessage)
            ->confirmText('Are you sure you want to read  this Massage?')
            ->confirmButtonText('Read')
            ->cancelButtonText("Don't Read"),
        ];
    }
}
