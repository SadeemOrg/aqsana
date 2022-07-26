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
use Laravel\Nova\Fields\Date;
use Illuminate\Support\Facades\DB;

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
            Tiptap::make('FieldName')
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
                  '|',
                  'editHtml',
              ])
              ->headingLevels([2, 3, 4]),
            Select::make('admin', 'admin_id')
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

            Text::make("video link", 'video_link'),

            Date::make('date', 'new_date'),




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
