<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use App\Nova\Actions\ChangeRole;
use Pdmfc\NovaFields\ActionButton;
use Laravel\Nova\Fields\Text;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\Date;
use Illuminate\Support\Facades\DB;
use Acme\MultiselectField\Multiselect;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Actions\PostNews;
use AwesomeNova\Cards\FilterCard;
use App\Nova\Filters\StateFilter;
use App\Nova\Filters\PostNewsFilters;
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
    public static function label()
    {
        return __('News');
    }
    public static function group()
    {
        return __('website');
    }


    public static $title = 'title';
    // public static $group = 'website';
    public static $priority = 1;
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

        return $query->whereNotIn('type', [8]);
    }
    public function fields(Request $request)
    {
        return [





            ID::make(__('ID'), 'id')->sortable(),
            ActionButton::make(__('POST NEWS'))
            ->action((new PostNews) ->confirmText('Are you sure you want to read  this Massage?')
            ->confirmButtonText(__('post'))
            ->cancelButtonText(__('Dont post')), $this->id) ->readonly(function () {
                return $this->status === '1';
            })->text(__('post'))->showLoadingAnimation()
            ->loadingColor('#fff') ->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make(__('is posted'),'status'),
            Text::make("Title", 'title'),
            Textarea::make('description', 'description'),
            Select::make('sector', 'sector')
                ->options(function () {
                    $sectors = nova_get_setting('workplace', 'default_value');
                    $user_type_admin_array =  array();
                    foreach ($sectors as $sector) {
                        $user_type_admin_array += [$sector['data']['searsh_text_workplace'] => ($sector['data']['searsh_text_workplace'] . " (" . $sector['data']['text_main_workplace'] . ")")];
                    }
                    return  $user_type_admin_array;
                }),

                Select::make("have multi category", "mult", function () {

                    $total=  json_decode($this->main_type);
                    // dd(gettype( $total));
                    if( gettype( $total) == "string" ) return "2";
                    else return "1";
                    $coutotal =  count( $total);
                    // if( $coutotal >1) return "1";
                    // else return "2";
                    // // dd($coutotal);
                    // return ($this->main_type );
                })
                ->options([
                    '1' => 'yes',
                    '2' => 'no',

                ])->displayUsingLabels()
                // ->withMeta(['ignoreOnSaving'])
                ->fillUsing(function(NovaRequest $request, $model, $attribute, $requestAttribute) {
                    /*
                        $request->input('unique_key_for_model') // Value of the field
                        $model->unique_key_for_model // DOES NOT exists, so no errors happens
                    */
                    // or just return null;
                    return null;
                })->hideFromIndex()->hideFromDetail(),


            NovaDependencyContainer::make([
                Select::make("main Type", "main_type", function () {

                 $tt=  str_replace('"', "", $this->main_type);
                 return $tt;
                    // dd($tt);
                    $total=  json_decode($this->main_type);
                    // dd(gettype( $total));
                    if( gettype( $total) == "string" ) return "2";
                    else return "1";
                    $coutotal =  count( $total);
                    // if( $coutotal >1) return "1";
                    // else return "2";
                    // // dd($coutotal);
                    // return ($this->main_type );
                })
                    ->options([

                        '1' => 'News',
                        '2' => 'alqudus walmasjid alaqsaa',
                        '3' => 'alqudus walmasjid alaqsaa',
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
            ])->dependsOn('mult', "2"),

            NovaDependencyContainer::make([
                 Multiselect::make("main Type", "main_type")
            ->options([
                '1' => 'News',
                '2' => 'alqudus walmasjid alaqsaa',
                '3' => 'alqudus walmasjid alaqsaa',


            ]),
             ])->dependsOn('mult', "1"),
            // Multiselect::make("main Type", "main_type")
            // ->options([
            //     '1' => 'News',
            //     '2' => 'alqudus walmasjid alaqsaa',
            //     '3' => 'alqudus walmasjid alaqsaa',


            // ]),

            // CKEditor::make('Contents', 'contents')->hidefromindex(),
            Tiptap::make('Contents', 'contents')
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

            Image::make('Image', 'image')->disk('public')->prunable(),
            ArrayImages::make('Pictures', 'pictures')
                ->disk('public'),

            Text::make("video link", 'video_link'),

            // Date::make('date', 'new_date'),
            Date::make('date', 'new_date')->pickerDisplayFormat('d.m.Y'),





        ];
    }
        // public static function fill(NovaRequest $request, $model)
        // {
        //     return static::fillFields(
        //         $request, $model,
        //         (new static($model))->creationFieldsWithoutReadonly($request)->reject(function ($field) use ($request) {
        //             return in_array('ignoreOnSaving', $field->meta);
        //         })
        //     );
        // }
    public static function beforeSave(Request $request, $model)
    {
        // $user = Auth::user();

        // $model->update([
        //     'main_type'=>'1',
        // ]);
    }
 public static function beforeUpdate(Request $request, $model)
    {
        return static::fillFields(
            $request, $model,
            (new static($model))->creationFieldsWithoutReadonly($request)->reject(function ($field) use ($request) {
                return in_array('ignoreOnSaving', $field->meta);
            })
        );
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
            new FilterCard(new PostNewsFilters()),

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
            new PostNewsFilters()
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

            (new PostNews)
            ->confirmText('Are you sure you want to read  this Massage?')
            ->confirmButtonText('Read')
            ->cancelButtonText("Don't Read"),
        ];
    }
}
