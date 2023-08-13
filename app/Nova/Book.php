<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Models\BookType;
use App\Nova\Actions\PostBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;
use Pdmfc\NovaFields\ActionButton;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;
use Whitecube\NovaFlexibleContent\Flexible;

class Book extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Book::class;

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Bookparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static function label()
    {
        return __('Book');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
    public static $priority = 1;
    public static function groupOrder()
    {
        return 8;
    }


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
        'id', 'name'
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
            Boolean::make(__('is posted'), 'post'),
            ActionButton::make(__('POST NEWS'))
                ->action((new PostBook)->confirmText(__('Are you sure you want to post  this NEWS?'))
                    ->confirmButtonText(__('post'))
                    ->cancelButtonText(__('Dont post')), $this->id)
                ->readonly(function () {
                    return $this->post === 1;
                })->text(__('post'))->showLoadingAnimation()
                ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('Name'), 'name')->rules('required', 'max:255'),
            Text::make(__('author'), 'author'),
            Tiptap::make(__('description'), 'description')
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
            // Textarea::make(__('description'), 'description'),
            BelongsTo::make(__('Book Type'), 'BookType', \App\Nova\BookType::class)->hideWhenCreating()->hideWhenUpdating(),

            Select::make(__('main Type'), "type")
                ->options(function () {
                    $types =  BookType::all();
                    $type_array =  array();
                    foreach ($types as $type) {
                        $type_array += [$type['id'] => ($type['name'])];
                    }

                    return $type_array;
                })->displayUsingLabels()->hideFromDetail()->hideFromIndex(),
            Flexible::make(__('newtype'), 'newtype')
            ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('name'), 'name'),
                    Text::make(__(__('Description')), 'describtion'),
                ])->confirmRemove(),
            Image::make(__('cover_photo'), 'cover_photo')->disk('public')->prunable()->rules('required'),
            File::make(__('file'), 'file')->disk('public')->deletable()->rules('required'),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }
    public static function beforeSave(Request $request, $model)
    {
        if (!$request->type) {


            if ($request->newtype   && ($request->newtype[0]['attributes']['name'] || $request->newtype[0]['attributes']['describtion'])) {
                BookType::create([
                    'name' => $request->newtype[0]['attributes']['name'],
                    'describtion' => $request->newtype[0]['attributes']['describtion'],
                ]);
                $BookType =  \App\Models\BookType::orderBy('created_at', 'desc')->first();

                $request->merge(['type' => $BookType->id]);
            }
        }
        $request->request->remove('newtype');
    }
    public static function afterSave(Request $request, $model)
    {



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
            new PostBook,
        ];
    }
}
