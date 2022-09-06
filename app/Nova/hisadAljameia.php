<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;

class hisadAljameia extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\News::class;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function label()
    {
        return __('Hisad Aljameias');
    }
    public static function group()
{
    return __('website');
}
    public static $title = 'title';

    public static $priority = 2;
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

        return $query->where('type', '8');
    }
    public function fields(Request $request)
    {
        return [

            ID::make(__('ID'), 'id')->sortable(),
            // Text::make('اخبار','main_type')->withMeta([
            //     'type' => 'hidden',
            //     'value' => '4'
            // ])->hideFromIndex(),
            // Text::make('حصاد الجمعية','type')->withMeta([
            //     'type' => 'hidden',
            //     'value' => '8'
            // ])->hideFromIndex(),
            Text::make(__("Title"), 'title'),
            Text::make(__("link"), 'description'),
        ];
    }
    public static function beforeSave(Request $request, $model)
    {

        $model->main_type='4';
        $model->type='8';
        $model->new_date='8';
        $model->image='0rZDE0SPjZB4ZUBbfROleA7kx6DXuggG0RQGawNX.webp';
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
