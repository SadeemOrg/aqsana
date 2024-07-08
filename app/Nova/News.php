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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Title", 'title'),
            //   BelongsTo::make("newsType",'newsTypes'),
            Textarea::make('description', 'description'),
            // Select::make("main sector", "sector")
            // ->options([
            //     '1' => 'قطاع الاغاثة',
            //     '2' => 'قطاع التنمية والدعم الاقتصادي',
            //     '3' => 'قوافل الأقصى',
            //     '4' => 'قطاع الأوقاف والمقدسات',
            //     '5' => 'قطاع الصحة ',
            // ])->displayUsingLabels(),

            Select::make('sector', 'sector')
                ->options(function () {
                    // // $users =  \App\Models\User::where('user_role', '=', 'regular_area')->get();
                    //     $user = DB::table('nova_settings')
                    //     ->where('key', 'address')
                    //     ->first();
                    $sectors = nova_get_setting('workplace', 'default_value');
                    $user_type_admin_array =  array();
                    foreach ($sectors as $sector) {
                        $user_type_admin_array += [$sector['data']['searsh_text_workplace'] => ($sector['data']['searsh_text_workplace']. " (". $sector['data']['text_main_workplace'] .")")];
                        // $user_type_admin_array += $sector['data']['text_main_workplace'];
                    }


                    // foreach($users as $user) {
                    //     if ($user->Area == null  ) {


                    //     $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_role'] .")")];
                    // }
                    // }
                    return  $user_type_admin_array;
                    // return $user->value;
                })->hideFromIndex()->hideFromDetail(),
            Select::make("main Type", "main_type")
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



            // CKEditor::make('Contents', 'contents')->hidefromindex(),


            Tiptap::make(__('Contents'), 'contents')
                ->buttons([
                    'heading',
                    'italic',
                    'bold',
                    'link',
                    'code',
                    'strike',
                    'underline',
                    'highlight',
                    'bulletList',
                    'orderedList',
                    'br',
                    'codeBlock',
                    'blockquote',
                    'horizontalRule',
                    'hardBreak',
                    'table',
                    'image',
                    'textAlign',
                    'rtl',
                                        'history',
                ])
                ->headingLevels([1, 2, 3, 4, 5, 6])->rules('required'),
            Image::make('Image', 'image')->disk('public')->prunable(),
            ArrayImages::make('Pictures', 'pictures')
                ->disk('public'),

            Text::make("video link", 'video_link'),

            // Date::make('date', 'new_date'),
            Date::make('date', 'new_date')->pickerDisplayFormat('d.m.Y'),





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
