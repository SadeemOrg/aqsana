<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Image;
class receiptVoucher extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('receipt Voucher');
    }
    public static function group()
    {
        return __('Financial management');
    }
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

        return $query->where('main_type', '1');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Select::make(__("type"), "type")->options([
                '1' => __('Alhisalat'),
                '2' => __('doner'),
                '3' => __('else'),
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('reference_id'), 'Alhisalat', \App\Nova\Alhisalat::class)->canSee(function(){
                return $this->type === '1';
            }),
            BelongsTo::make(__('reference_id'), 'Donations', \App\Nova\Donations::class)->canSee(function(){
                return $this->type === '2';
            }),
          Text::make(__('reference_id'), 'reference_id')->readonly()->hideWhenCreating()->hideWhenUpdating()->canSee(function(){
            return $this->type === '3';
        }),

            NovaDependencyContainer::make([
                Select::make(__('Alhisalat'), "ref_id")
                    ->options(function () {
                        $projects =  \App\Models\Alhisalat::all();
                        $user_type_admin_array =  array();
                        foreach ($projects as $project) {
                            $user_type_admin_array += [$project['id'] => ($project['name'])];
                        }

                        return $user_type_admin_array;
                    })
                    ->displayUsingLabels(),
            ])->dependsOn("type", '1')->hideFromDetail()->hideFromIndex(),
            // NovaDependencyContainer::make([
            //     Select::make(__('Donations'), "ref_id")
            //         ->options(function () {
            //             $projects =  \App\Models\Donations::all();
            //             $user_type_admin_array =  array();
            //             foreach ($projects as $project) {
            //                 $user_type_admin_array += [$project['id'] => ($project['project_name'])];
            //             }

            //             return $user_type_admin_array;
            //         })
            //         ->displayUsingLabels(),
            // ])->dependsOn('type', '2')->hideFromDetail()->hideFromIndex(),


            // BelongsTo::make('project', 'Project')->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('description'), 'description'),
            Text::make(__('transact amount'), 'transact_amount'),
            BelongsTo::make(__('Currenc'), 'Currenc', \App\Nova\Currency::class),




            Text::make(__('equivalent amount'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),

            Image::make(__('voucher'), 'voucher')->disk('public')->prunable(),

            // Select::make(__('approval'), 'approval')->options([
            //     1 => 'approval',
            //     2 => 'reject',
            // ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            // Text::make(__("reason_of_reject"), "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),




            Date::make(__('date'), 'transaction_date'),

        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $new = DB::table('currencies')->where('id', $request->Currenc)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '1';
        $model->type = '1';
        $model->equivelant_amount=$new->rate*$request->transact_amount;
    }
    public static function beforeUpdate(Request $request, $model)
    {

        $currencies = DB::table('currencies')->where('id', $request->Currenc)->first();
        $id = Auth::id();
        $model->update_by = $id;
        if ($model->Currenc->id == $request->Currenc) {
            $rate = ((int)$model->equivelant_amount / (int)$model->transact_amount);
        }
        else  $rate =$currencies->rate ;
        $model->equivelant_amount = $rate * $request->transact_amount;

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
