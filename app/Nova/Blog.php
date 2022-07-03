<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
class blog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\News::class;
    public static $group = 'website';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $priority = 6;
    public static $displayInNavigation = false;


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

        return $query->where('main_type', '1');

     }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Title",'title'),
          BelongsTo::make("newsType",'newsTypes'),
            Textarea::make('description', 'description'),
            CKEditor::make('Contents', 'contents')->hidefromindex(),


            Image::make('Image','image')->disk('public')->prunable(),
            ArrayImages::make('Pictures', 'pictures')
            ->disk('public'),

        ];
    }

    public static function afterCreate(Request $request, $model)
    {
        // $user = Auth::user();

        $model->update([
            'main_type'=>'1',
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
