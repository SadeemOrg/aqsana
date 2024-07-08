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
use App\Models\Sector;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Actions\PostNews;
use AwesomeNova\Cards\FilterCard;
use App\Nova\Filters\StateFilter;
use App\Nova\Filters\PostNewsFilters;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\HasMany;
use Whitecube\NovaFlexibleContent\Flexible;

class News extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\News::class;
    public static function createButtonLabel()
    {
        return 'انشاء خبر';
    }
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
        return __('Association website');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Newsparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static function groupOrder()
    {
        return 2;
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
        'id', 'title'
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





            ID::make(__('ID'), 'id'),
            ActionButton::make(__('POST NEWS'))
                ->action((new PostNews)->confirmText(__('Are you sure you want to post  this NEWS?'))
                    ->confirmButtonText(__('post'))
                    ->cancelButtonText(__('Dont post')), $this->id)
                ->readonly(function () {
                    return $this->status === '1';
                })->text(__('post'))->showLoadingAnimation()
                ->loadingColor('#fff') ->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make(__('is posted'), 'status')->rules('required'),
            Text::make(__('TITLE'), 'title')->rules('required'),
            Textarea::make(__('Sub_text'), 'description')->rules('required'),
            Select::make(__('SECTOR'), 'sector')
                ->options(function () {
                    $sectors = Sector::all();
                    $user_type_admin_array =  array();
                    foreach ($sectors as $sector) {
                        $user_type_admin_array += [$sector['id'] => ($sector['text'])];
                    }
                    return  $user_type_admin_array;
                })->displayUsingLabels(),

            Select::make(__('have multi category'), "mult", function () {
                $total =  json_decode($this->main_type);
                if (gettype($total) == "string") return "2";
                else return "1";
            })
                ->options([
                    '1' => __('yes'),
                    '2' => __('no'),

                ])->displayUsingLabels()->hideFromDetail()->hideFromIndex()
                ->rules('required')
                // ->withMeta(['ignoreOnSaving'])
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    // dd($attribute);
                    return null;
                }),



            NovaDependencyContainer::make([
                Select::make(__('main Type'), "main_type", function () {

                    $tt =  str_replace('"', "", $this->main_type);
                    return $tt;
                    // dd($tt);
                    $total =  json_decode($this->main_type);
                    // dd(gettype( $total));
                    if (gettype($total) == "string") return "2";
                    else return "1";
                    $coutotal =  count($total);
                    // if( $coutotal >1) return "1";
                    // else return "2";
                    // // dd($coutotal);
                    // return ($this->main_type );
                })
                    ->options([

                        '1' => __('News'),
                        '2' => __('alqudus walmasjid alaqsaa'),

                    ])->displayUsingLabels()->rules('required'),

                NovaDependencyContainer::make([
                    Select::make(__('type'), "type")
                        ->options([
                            '1' => __('News'),
                            '2' => __('Blogs'),
                            '3' => __('Report'),
                        ])->displayUsingLabels(),
                ])->dependsOn('main_type', '1')->rules('required'),

                NovaDependencyContainer::make([
                    Select::make(__('type'), "type")
                        ->options([
                            '1' => __('News'),
                            '2' => __('almas alsamel'),
                            '3' => __('Report'),
                        ])->displayUsingLabels(),
                ])->dependsOn('main_type', '2'),
            ])->dependsOn('mult', "2")->rules('required'),

            NovaDependencyContainer::make([
                Multiselect::make(__('main Type'), "main_type")
                    ->options([
                        '1' => __('News'),
                        '2' => __('alqudus walmasjid alaqsaa'),



                    ])->rules('required'),
            ])->dependsOn('mult', "1"),
            // Multiselect::make("main Type", "main_type")
            // ->options([
            //     '1' => 'News',
            //     '2' => 'alqudus walmasjid alaqsaa',
            //     '3' => 'alqudus walmasjid alaqsaa',


            // ]),

            // CKEditor::make('Contents', 'contents')->hidefromindex(),
            Tiptap::make(__('Contents'), 'contents')
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
                ->headingLevels([1, 2, 3, 4, 5, 6])->rules('required'),

            Image::make(__('master image'), 'image')->disk('public'),

            ArrayImages::make(__('PICTURES'), 'pictures')
                ->disk('public'),

            Text::make(__('VIDEO LINK'), 'video_link'),
            Image::make(__('video_img_cover'), 'video_img_cover')->disk('public')->prunable(),
            Flexible::make(__('add videos'), 'videos')
                ->addLayout(__('video'), 'video', [
                    Text::make(__('VIDEO LINK'), 'video_link'),
                    Image::make(__('video_img_cover'), 'video_img_cover')->disk('public')->prunable(),
                ]),
            Date::make(__('DATE'), 'new_date')->pickerDisplayFormat('d.m.Y')->sortable()->rules('required'),


            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)




        ];
    }
    public static function beforeSave(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
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
