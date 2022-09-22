<?php

namespace App\Nova;

use App\Nova\Actions\AlhisalatColect;
use App\Nova\Actions\AlhisalatStatus;
use App\Nova\Actions\AlhisalatStatuscompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaFields\ActionButton;

class AlhisalatAmount extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Alhisalat::class;

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
    public static $priority = 3;
    public static function label()
    {
        return __('Alhisalat');
    }

    public static function group()
    {
        return __('Financial management');
    }
    public static function availableForNavigation(Request $request)
    {
        $user = Auth::user();
        if ($user->type() == 'admin' || $user->type() == 'financial_user') {
            return true;
        } else return false;
    }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where('status','>','2');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Alhisalat'), 'Alhisalat', \App\Nova\Alhisalat::class),

            // Number::make(__("number alhisala"), "number_alhisala")->readonly(),
            // BelongsTo::make(__('address'), 'address', \App\Nova\address::class)->readonly(),



            // BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            // BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            ActionButton::make(__('Complet'))
            ->action((new AlhisalatStatuscompleted)
            ->confirmText(__('Are you sure you want to Complet  this Alhisalat?'))
            ->confirmButtonText(__('Complet'))
            ->cancelButtonText(__('not collected')), $this->id)
            ->canSee(function () {
                return $this->status < '3';
            })->readonly()->text(__('not collected'))->showLoadingAnimation()->buttonColor('#070707')
            ->loadingColor('#000000')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

        ActionButton::make(__('Complet'))
            ->action((new AlhisalatStatuscompleted)
            ->confirmText(__('Are you sure you want to Complet  this Alhisalat?'))
            ->confirmButtonText(__('collected'))
            ->cancelButtonText(__('Dont collected')), $this->id)
            ->canSee(function () {
                return $this->status === '3';
            })->text(__('collect'))->showLoadingAnimation()
            ->loadingColor('#FF5733')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),




        ActionButton::make(__('Finish'))
            ->action((new AlhisalatStatuscompleted)->confirmText('Are you sure you want to read  this Massage?')
                ->confirmButtonText(__('Finish'))
                ->cancelButtonText(__('Dont Finish')), $this->id)
            ->canSee(function () {
                return $this->status === '4 ';
            })
            ->readonly()
            ->text(__('Finish'))->showLoadingAnimation()->buttonColor('#21b970')
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

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
        return [
            new AlhisalatStatuscompleted,
            new AlhisalatColect
        ];
    }
}
