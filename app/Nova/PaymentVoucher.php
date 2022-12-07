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
use Epartment\NovaDependencyContainer\HasDependencies;
use Alaqsa\Project\Project;
use App\Models\TelephoneDirectory;
use App\Nova\Actions\BillPdf;
use Pdmfc\NovaFields\ActionButton;
use Whitecube\NovaFlexibleContent\Flexible;

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
        return __('the Payment Voucher');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public static function groupOrder() {
        return 3;
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("PaymentVoucherparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static $priority = 3;
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
            ActionButton::make(__('POST NEWS'))
            ->action((new BillPdf)->confirmText(__('Are you sure you want to post  this NEWS?'))
                ->confirmButtonText(__('print'))
                ->cancelButtonText(__('Dont print')), $this->id)
            ->text(__('print'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),
            Project::make(__('ref_id'),'ref_id'),


            Select::make(__("type"), "type")->options([
                '0' => __('the Payment Voucher'),
                '1' => __('project'),
                '2' => __('qawael'),
                '3' => __('trip'),
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('reference_id'), 'project', \App\Nova\Project::class)->canSee(function(){
                return $this->type != '0';
            })->hideWhenUpdating()->hideWhenCreating(),


            Text::make(__('reference_id'), 'reference_id')->readonly()->hideWhenCreating()->hideWhenUpdating()->canSee(function(){
                return $this->type === '0';
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
            Select::make(__('name'), "name")
            ->options(function () {
                $Users =  \App\Models\TelephoneDirectory::where('type', '8')->get();
                $i = 0;
                $user_type_admin_array =  array();
                foreach ($Users as $User) {


                    $user_type_admin_array += [($User['id']) => ($User['name'])];
                }

                return $user_type_admin_array;
            })
            ->displayUsingLabels()      ->hideFromDetail()->hideFromIndex(),

        Flexible::make(__('add user'),'add_user')
        ->readonly(true)

            ->hideFromDetail()->hideFromIndex()
            ->addLayout(__('tooles'), 'Payment_type_details ', [
                Text::make(__('name'), "name")->rules('required'),
                Text::make(__('phone'), "phone")->rules('required'),
            ]),

            BelongsTo::make(__('reference_id'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),

            // Text::make(__('name'), 'name'),
            Text::make(__('company_number'), 'company_number'),
            Text::make(__('bill_number'), 'bill_number'),
            Text::make(__('description'), 'description'),
            Text::make(__('transact amount pay'), 'transact_amount'),
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
    public static function beforeSave(Request $request, $model)
    {
        // dd($request->Color);
    }
    public static function beforeCreate(Request $request, $model)
    {

        $new = DB::table('currencies')->where('id', $request->Currenc)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '2';
        $model->type = '0';
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


    public static function aftersave(Request $request, $model)
    {


        if (!$request->name) {
            // dd($request->add_user);
            if ($request->add_user[0]['attributes']['name'] &&     $request->add_user[0]['attributes']['phone']) {
                $telfone=  TelephoneDirectory::create([
                        'name' => $request->add_user[0]['attributes']['name'],
                        'type' => '8',
                        'phone_number' =>  $request->add_user[0]['attributes']['phone']
                    ],
                    );

            }
            // dd( $telfone);
            DB::table('transactions')
            ->where('id', $model->id)
            ->update(['name' => $telfone->id]);
        }
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
            new BillPdf
        ];
    }
}
