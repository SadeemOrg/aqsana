<?php

namespace App\Nova;

use Acme\Analytics\Analytics;
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
use App\Nova\Metrics\InComeTransaction;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use MyApp\BillingSchedule\BillingSchedule;
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
    public static function groupOrder()
    {
        return 3;
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("PaymentVoucherparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
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
            // ActionButton::make(__('POST NEWS'))
            // ->action((new BillPdf)->confirmText(__('Are you sure you want to post  this NEWS?'))
            //     ->confirmButtonText(__('print'))
            //     ->cancelButtonText(__('Dont print')), $this->id)
            // ->text(__('print'))->showLoadingAnimation()
            // ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Sector'), 'Sectors', \App\Nova\Sector::class)->nullable(),
            BelongsTo::make(__('project'), 'project', \App\Nova\project::class)->nullable(),

            Select::make(__("type"), "type")->options([
                '0' => __('the Payment Voucher'),
                '1' => __('project'),
                '2' => __('qawael'),
                '3' => __('trip'),
            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('reference_id'), 'project', \App\Nova\Project::class)->canSee(function () {
                return $this->type != '0';
            })->hideWhenUpdating()->hideWhenCreating(),


            // Text::make(__('reference_id'), 'reference_id')->readonly()->hideWhenCreating()->hideWhenUpdating()->canSee(function(){
            //     return $this->type === '0';
            // }),
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

            BelongsTo::make('project', 'project')->hideWhenCreating()->hideWhenUpdating(),
            Select::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::where('type', '8')->get();
                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['name'])];
                    }
                    $Users =  \App\Models\BusesCompany::all();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->displayUsingLabels()->hideWhenCreating()->hideFromIndex()->hideFromDetail()->readonly(),
            Select::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::where('type', '8')->get();
                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += ['T' . ($User['id']) => ($User['name'])];
                    }
                    $Users =  \App\Models\BusesCompany::all();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [('B' . $User['id']) => ($User['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->displayUsingLabels()->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->hideFromDetail()->hideFromIndex()->hideWhenUpdating(),

            Flexible::make(__('add user'), 'add_user')
                ->readonly(true)

                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('tooles'), 'Payment_type_details ', [
                    Text::make(__('name'), "name")->rules('required'),
                    Text::make(__('phone'), "phone")->rules('required'),
                ])->hideWhenUpdating(),

            BelongsTo::make(__('reference_id'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating()->canSee(function () {
                return $this->transaction_type === '1';
            }),
            BelongsTo::make(__('reference_id'), 'BusesCompany', \App\Nova\BusesCompany::class)->hideWhenCreating()->hideWhenUpdating()->canSee(function () {
                return $this->transaction_type === '2';
            }),

            // Text::make(__('name'), 'name'),
            Text::make(__('company_number'), 'company_number'),
            Text::make(__('bill_number'), 'bill_number'),
            Text::make(__('description'), 'description'),

            // BelongsTo::make(__('Currenc'), 'Currenc', \App\Nova\Currency::class),



            Select::make(__("Payment_type"), "Payment_type")->options([
                '1' => __('cash'),
                '2' => __('shek'),
                '3' => __('bit'),
                '4' => __('hawale'),
                // '5' => __('Other'),
            ])->displayUsingLabels()->default('1'),
            NovaDependencyContainer::make([
                Text::make(__('transact amount pay'), 'transact_amount')->rules('required'),
                // Select::make(__('Currenc'), "Currency")
                //     ->options(function () {
                //         $Alhisalats =  \App\Models\Currency::all();
                //         $user_type_admin_array =  array();
                //         foreach ($Alhisalats as $Alhisalat) {
                //             $user_type_admin_array += [$Alhisalat['id'] => ($Alhisalat['name'])];
                //         }

                //         return $user_type_admin_array;
                //     })
                //     ->displayUsingLabels(),
            ])->dependsOn("Payment_type", '1')->hideFromIndex(),

            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        Text::make(__('Doubt value'), "Doubt_value")->rules('required'),
                        Text::make(__('bank number'), "bank_number"),
                        Text::make(__('Branch number'), "Branch_number"),
                        Text::make(__('account number'), "account_number"),
                        Text::make(__('Doubt number'), "Doubt_number"),

                        DateTime::make(__('History of doubt'), 'Date')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                    ]),
            ])->dependsOn("Payment_type", '2')->hideFromIndex(),
            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        Text::make(__('value'), "equivelant_amount")->rules('required'),
                        Text::make(__('telephone'), "telephone")->rules('required'),
                        // Text::make(__('number of installments'), "number_of_installments"),

                        DateTime::make(__('History'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                    ]),
            ])->dependsOn("Payment_type", '3')->hideFromIndex(),

            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        Text::make(__('value'), "equivelant_amount")->rules('required'),

                        Text::make(__('bank number'), "bank_number"),
                        Text::make(__('Branch number'), "Branch_number"),
                        Text::make(__('account number'), "account_number"),

                        DateTime::make(__('History'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                    ])->rules('required'),
            ])->dependsOn("Payment_type", '4')->hideFromIndex(),
            // Text::make(__('equivalent amount'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),
            Files::make('voucher', 'voucher'),
            Files::make('file', 'file'),
            // File::make(__('voucher'), 'voucher')->disk('public')->prunable(),
            // File::make(__('file'), 'file')->disk('public')->prunable(),

            // Select::make(__('approval'), 'approval')->options([
            //     1 => 'approval',
            //     2 => 'reject',
            // ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            // Text::make(__("reason_of_reject"), "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),




            Date::make(__('date'), 'transaction_date')->rules('required'),

        ];
    }
    public static function beforeSave(Request $request, $model)
    {

        if (strpos($request->name, 'T') !== false) {
            $model->transaction_type = '1';
            $str = ltrim($request->name, 'T');
            $model->name = $str;
        } elseif (strpos($request->name, 'B') !== false) {
            $model->transaction_type = '2';
            $str = ltrim($request->name, 'B');
            $model->name = $str;
        }

        if ($request->Payment_type == '1') {
            $model->Payment_type_details = null;
            // dd($request->transact_amount);
            $model->equivelant_amount = $request->transact_amount;
        } elseif ($request->Payment_type == '2') {
            $model->transact_amount = 0;
            $amount = 0;
            foreach ($request->Payment_type_details as $key => $value) {

                $amount += $value['attributes']['Doubt_value'];
            }

            $model->equivelant_amount = $amount;
        } elseif ($request->Payment_type == '3') {
            $model->transact_amount = 0;
            $amount = 0;
            foreach ($request->Payment_type_details as $key => $value) {

                $amount += $value['attributes']['equivelant_amount'];
            }

            $model->equivelant_amount = $amount;

            #  // $model->equivelant_amount
        } elseif ($request->Payment_type == '4') {
            $model->transact_amount = 0;
            $amount = 0;
            foreach ($request->Payment_type_details as $key => $value) {

                $amount += $value['attributes']['equivelant_amount'];
            }

            $model->equivelant_amount = $amount;
            #  // $model->equivelant_amount
        }
        // $str = 'T190';
        // $str = ltrim($str, 'T');
        // dd($str);

        // dd(strpos($request->name, 'T') !== false);
    }
    public static function beforeCreate(Request $request, $model)
    {


        // $new = DB::table('currencies')->where('id', $request->Currenc)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '2';
        $model->type = '0';
        // $model->equivelant_amount = $new->rate * $request->transact_amount;
    }
    public static function beforeUpdate(Request $request, $model)
    {
        // dump();


        // $currencies = DB::table('currencies')->where('id', $request->Currenc)->first();
        // $id = Auth::id();
        // $model->update_by = $id;
        // if ($model->Currenc->id == $request->Currenc) {
        //     $rate = ((int)$model->equivelant_amount / (int)$model->transact_amount);
        // } else  $rate = $currencies->rate;
        // $model->equivelant_amount = $rate * $request->transact_amount;
    }


    public static function aftersave(Request $request, $model)
    {


        if (!$request->name) {
            // dd($request->add_user);
            if ($request->add_user[0]['attributes']['name'] &&     $request->add_user[0]['attributes']['phone']) {
                $telfone =  TelephoneDirectory::create(
                    [
                        'name' => $request->add_user[0]['attributes']['name'],
                        'type' => '8',
                        'phone_number' =>  $request->add_user[0]['attributes']['phone']
                    ],
                );
            }
            // dd( $telfone);
            DB::table('transactions')
                ->where('id', $model->id)
                ->update([
                    'name' => $telfone->id,
                    'transaction_type' => '1'
                ]);
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
        return [
            new InComeTransaction(),
            new Analytics(),

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
