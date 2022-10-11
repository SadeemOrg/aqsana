<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Models\BookType;
use App\Nova\Actions\PostNews;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaFields\ActionButton;

class Book extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Book::class;
    public static function label()
    {
        return __('Book');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
    public static $priority = 1;



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
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Boolean::make(__('is posted'),'post'),
            ActionButton::make(__('POST NEWS'))
            ->action((new PostNews)->confirmText(__('Are you sure you want to post  this NEWS?'))
                ->confirmButtonText(__('post'))
                ->cancelButtonText(__('Dont post')), $this->id)
                ->readonly(function () {
                return $this->status === '1';
            })->text(__('post'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('name'),'name')->rules('required', 'max:255'),
            Text::make(__('author'),'author'),
            Text::make(__('description'),'description'),
            Multiselect::make(__('main Type'), "type")
            ->options(function(){
               $types=  BookType::all() ;
               $type_array =  array();
               foreach ($types as $type) {
                $type_array += [$type['id'] => ($type['name'])];
            }

            return $type_array;
            }),
            Image::make(__('cover_photo'), 'cover_photo')->disk('public')->prunable(),
            File::make(__('file'),'file')->disk('public')->deletable(),
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
            new PostNews,
        ];
    }
}
