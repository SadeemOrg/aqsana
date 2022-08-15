<?php

namespace App\Nova;


use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;

class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;
    public static $displayInNavigation = false;


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('Transaction');
    }
    public static function group()
    {
        return __('Financial management');
    }

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
            Select::make('Transactions Type ', 'type')->options([
                1 => 'Payment voucher',
                2 => 'receipt voucher',
            ])->displayUsingLabels(),


            Select::make("transactions status", "status")->options([
                '0' => 'not',
                '1' => 'ok',

            ])->default(0)
                ->hideWhenCreating()->hideWhenUpdating(),



            Text::make('project', 'project_id'),
            Text::make('transact amount', 'transact_amount'),
            BelongsTo::make('Currency', 'Currenc'),


            Text::make('Rate', function () {
                return $this->Currenc->rate;
            }),
            Text::make('equivalent amount', function () {
                return ($this->Currenc->rate )*$this->transact_amount;
            }),

                Image::make('voucher', 'voucher')->disk('public')->prunable(),

            Select::make('approval ', 'approval')->options([
                1 => 'approval',
                2 => 'reject',
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            Text::make("reason_of_reject", "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),




            Date::make('date', 'transaction_date'),




        ];
    }
    public static function beforeSave(Request $request, $model)
    {
        // $user = Auth::user();

        $model->update([
            'type'=>'1'
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
        return [
            (new Actions\ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
                return ($user->type() == 'admin' || $user->type() == 'financial_user');
            }),
        ];
    }
}
