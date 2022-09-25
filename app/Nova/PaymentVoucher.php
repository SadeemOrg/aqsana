<?php

namespace App\Nova;

use App\Nova\Actions\ApprovalRejectTransaction;
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

class PaymentVoucher extends Resource
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
        return __('Payment Voucher');
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
    public static $priority = 2;
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where('main_type', '2');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Select::make(__("type"), "type")->options([
                '0' => __('else'),
                '1' => __('project'),
                '2' => __('qawael'),
                '3' => __('trip'),
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('reference_id'), 'project', \App\Nova\Project::class)->canSee(function(){
                return $this->type != '4';
            })->hideWhenUpdating()->hideWhenCreating(),


            Text::make(__('reference_id'), 'reference_id')->readonly()->hideWhenCreating()->hideWhenUpdating()->canSee(function(){
                return $this->type === '4';
            }),
            // NovaDependencyContainer::make([
            //     Select::make(__('project'), "ref_id")
            //         ->options(function () {
            //             $projects =  \App\Models\project::where('project_type', '1')->get();
            //             $user_type_admin_array =  array();
            //             foreach ($projects as $project) {
            //                 $user_type_admin_array += [$project['id'] => ($project['project_name'])];
            //             }

            //             return $user_type_admin_array;
            //         })
            //         ->displayUsingLabels(),
            // ])->dependsOn('type', '1')->hideFromDetail()->hideFromIndex(),
            // NovaDependencyContainer::make([
            //     Select::make(__('QawafilAlaqsa'), "ref_id")
            //         ->options(function () {
            //             $projects =  \App\Models\project::where('project_type', '2')->get();
            //             $user_type_admin_array =  array();
            //             foreach ($projects as $project) {
            //                 $user_type_admin_array += [$project['id'] => ($project['project_name'])];
            //             }

            //             return $user_type_admin_array;
            //         })
            //         ->displayUsingLabels(),
            // ])->dependsOn('type', '2')->hideFromDetail()->hideFromIndex(),
            // NovaDependencyContainer::make([
            //     Select::make(__('Trip'), "ref_id")
            //         ->options(function () {
            //             $projects =  \App\Models\project::with("City") ->get();
            //                                     $i=0;
            //                                     $user_type_admin_array =  array();
            //                                     foreach ($projects as $project) {

            //                                         foreach ($project['City'] as $projectcite) {

            //                                             $user_type_admin_array += [($project['id']) => ($project['project_name'].'=>'.$projectcite['name'])];
            //                                         }
            //                                 }

            //             return $user_type_admin_array;
            //         })
            //         ->displayUsingLabels(),
            // ])->dependsOn('type', '3')->hideFromDetail()->hideFromIndex(),

            // BelongsTo::make('project' , 'project')->hideWhenCreating()->hideWhenUpdating(),

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
        $model->main_type = '2';
        $model->equivelant_amount=$new->rate*$request->transact_amount;
    }
    public static function beforeUpdate(Request $request, $model)
    {
        // dump();


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
        return [
            new ApprovalRejectTransaction,
        ];
    }
}
