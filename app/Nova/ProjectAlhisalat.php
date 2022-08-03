<?php

namespace App\Nova;

use App\Models\Area;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Http\Requests\NovaRequest;
use Acme\MultiselectField\Multiselect;
use App\Nova\Actions\ApprovalRejectProjec;
use App\Nova\Actions\ProjectStatu;
use Illuminate\Support\Facades\Auth;
use App\Nova\Filters\ProjectStatus;
use App\Nova\Filters\Projectapproval;
use App\Models\ProjectType;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\hasOne;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Yassi\NestedForm\NestedForm;
use Laravel\Nova\Fields\BelongsToMany;
use AwesomeNova\Cards\FilterCard;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Halimtuhu\ArrayImages\ArrayImages;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Laravel\Nova\Fields\BelongsTo;
use Manogi\Tiptap\Tiptap;
use Waynestate\Nova\CKEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\HasOne as FieldsHasOne;
use Laravel\Nova\Fields\FormData;
use Actengage\Wizard\HasMultipleSteps;
use Actengage\Wizard\Step;


class ProjectAlhisalat extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\project::class;


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
    public static function label()
    {
        return __('ProjectAlhisalat');
    }
    public static function group()
    {
        return __('Project');
    }
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
            Text::make("project describe", "project_describe"),
            Text::make("project purpose", "purpose"),
            BelongsTo::make('Project Type', 'ProjectType', \App\Nova\ProjectType::class),

            Text::make('Financial_Type', function () {
                if ($this->ProjectType) {
                    return $this->ProjectType['type'];
                }
            }),

            Number::make("Budjet", 'Budjet'),
            Select::make('admin', 'admin_id',)
                ->options(function () {
                    $users =  \App\Models\User::where('user_role', '=', 'admin')->get();

                    $user_type_admin_array =  array();

                    foreach ($users as $user) {
                        $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
                    }

                    return $user_type_admin_array;
                }),
            Select::make('Project Status ', 'Project_Status')->options([
                '0' => 'Initial',
                '1' => 'Acceptable',
                '2  in progress' => 'project  in progress',
                '3' => 'locked',
                '4' => 'Collection the project',
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            DateTime::make('projec start', 'start_date'),
            DateTime::make('projec end', 'end_date'),

            Boolean::make('is_has_volunteer','is_has_volunteer'),
            Boolean::make('is_has_Donations','is_has_Donations'),
            Text::make("approval", "approval")->hideWhenCreating()->hideWhenUpdating(),
            Text::make("reason_of_reject", "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),
            Select::make('approval Status  ', 'approval_Status')->options([
                '0' => 'Initial',
                '1' => 'Acceptable',
                '2  in progress' => 'project  in progress',
                '3' => 'locked',
                '4' => 'Collection the project',
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),

            Select::make('is_reported Status ', 'is_reported')->options([
                '1' => 'yes',
                '0' => 'no',
            ])->displayUsingLabels(),


            NovaDependencyContainer::make([
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
                  ->headingLevels([1, 2, 3, 4, 5, 6 ]),


                Image::make('Image', 'report_image')->disk('public')->prunable(),
                ArrayImages::make('Pictures', 'report_pictures')
                    ->disk('public'),
                    Text::make("video link", 'report_video_link'),


            ])->dependsOn('is_reported', '1'),

            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            HasOne::make('buses')->hideWhenCreating()->hideWhenUpdating(),
            // HasOne::make('Alhisalat')->hideWhenCreating()->hideWhenUpdating(),




            NestedForm::make('Alhisalat', 'Alhisalat', 'App\Nova\Alhisalat'),















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
