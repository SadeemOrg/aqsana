<?php

namespace App\Nova;

use Halimtuhu\ArrayImages\ArrayImages;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;

class ProjectNews extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Project::class;

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
            Text::make("project name", "project_name"),

                Text::make("Title", 'report_title'),
                Textarea::make('description', 'report_description'),
                Tiptap::make('Contents', 'report_contents')
                    ->buttons([
                        'heading',
                        '|',
                        'italic',
                        'bold',
                        '|',
                        'link',
                        'code',
                        'strike',
                        'underline',
                        'highlight',
                        '|',
                        'bulletList',
                        'orderedList',
                        'br',
                        'codeBlock',
                        'blockquote',
                        '|',
                        'horizontalRule',
                        'hardBreak',
                        '|',
                        'table',
                        '|',
                        'image',
                        '|',
                        'textAlign',
                        '|',
                        'rtl',
                        '|',
                        'history',
                    ])
                    ->headingLevels([1, 2, 3, 4, 5, 6]),


                Image::make('Image', 'report_image')->disk('public')->prunable(),
                ArrayImages::make('Pictures', 'report_pictures')
                    ->disk('public'),
                Text::make("video link", 'report_video_link'),
                Date::make(__('DATE'), 'report_date')->pickerDisplayFormat('d.m.Y'),




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
