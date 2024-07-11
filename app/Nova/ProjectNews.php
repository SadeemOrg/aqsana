<?php

namespace App\Nova;

use App\Nova\Actions\PostProjectNews;
use App\Nova\Filters\PostProjectFilters;
use App\Nova\Filters\ProjectTypeFilters;
use AwesomeNova\Cards\FilterCard;
use Halimtuhu\ArrayImages\ArrayImages;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;
use Pdmfc\NovaFields\ActionButton;

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
        'id','project_name'
    ];
    public static function groupOrder() {
        return 2;
    }
    public static function label()
    {
        return __('ProjectNews');
    }
    public static function group()
    {
        return __('Association website');
    }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public function authorizedToDelete(Request $request)
    {
        return false;
    }
     public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("ProjectNewsparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
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
            Boolean::make(__('posted For App'), 'report_status')->rules('required'),
            Boolean::make(__('is_has_Donations'), 'is_donation'),
            Boolean::make(__('is_has_volunteer'), 'is_volunteer'),




            Select::make(__("project type"), "project_type")->options([
                '1' => __('project'),
                '2' => __('QawafilAlaqsa'),
                '3' => __('Trip'),

            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__("project name"), "project_name")->readonly(true),

                Text::make(__('TITLE'),'report_title')->rules('required'),
                Textarea::make(__('description'), 'report_description')->rules('required'),
                Tiptap::make(__('Contents'), 'report_contents')
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


                Image::make(__('IMAGE'), 'report_image')->disk('public')->prunable(),
                ArrayImages::make(__('PICTURES'),  'report_pictures')
                    ->disk('public'),
                Text::make(__('VIDEO LINK'), 'report_video_link'),
                Image::make(__('video_img_cover'), 'report_video_link_cover')->disk('public')->prunable(),

                Date::make(__('DATE'), 'report_date')->pickerDisplayFormat('d.m.Y')->rules('required'),
                HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)




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
        return [
            // new FilterCard(new PostProjectFسilters()),
            new FilterCard(new ProjectTypeFilters()),
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
            new PostProjectFilters(),
            new ProjectTypeFilters()

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
            (new PostProjectNews)
            ->confirmText('Are you sure you want to read  this Massage?')
            ->confirmButtonText('Read')
            ->cancelButtonText("Don't Read"),
        ];
    }
}
