<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;

use Laravel\Nova\Fields\Text;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class News extends Resource
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
    public static $title = 'title';
    public static $group = 'website';
    public static $priority = 4;
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

        return $query->where('main_type', '0');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Title", 'title'),
            //   BelongsTo::make("newsType",'newsTypes'),
            Textarea::make('description', 'description'),

            Select::make("main Type", "main_type")
                ->options([
                    '1' => 'News',
                    '2' => 'alqudus walmasjid alaqsaa',
                    '3' => 'alqudus walmasjid alaqsaa',
                    '4' => 'hisad aljameia',

                ])->displayUsingLabels(),


            NovaDependencyContainer::make([
                Select::make(" type", "type")
                    ->options([
                        '1' => 'News',
                        '2' => 'Blogs',
                        '3' => 'Report',
                    ])->displayUsingLabels(),
            ])->dependsOn('main_type', '1'),


            NovaDependencyContainer::make([
                Select::make(" type", "type")
                    ->options([
                        '1' => 'News',
                        '2' => 'Blogs',
                        '3' => 'Report',
                    ])->displayUsingLabels(),
            ])->dependsOn('main_type', '2'),


            NovaDependencyContainer::make([
                Select::make(" type", "type")
                    ->options([
                        '1' => 'News',
                        '2' => 'almas alsamel',
                    ])->displayUsingLabels(),
            ])->dependsOn('main_type', '3'),



            CKEditor::make('Contents', 'contents')->hidefromindex(),


            Image::make('Image', 'image')->disk('public')->prunable(),
            ArrayImages::make('Pictures', 'pictures')
                ->disk('public'),



            NovaDependencyContainer::make([])->dependsOn('is_reported', '1'),

        ];
    }
    public static function afterCreate(Request $request, $model)
    {
        // $user = Auth::user();

        // $model->update([
        //     'main_type'=>'1',
        // ]);
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
