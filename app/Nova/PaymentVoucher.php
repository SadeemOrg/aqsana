<?php

namespace App\Nova;

use Acme\Analytics\Analytics;
use Acme\MultiselectField\Multiselect as Select;
use Acme\ProjectPicker\ProjectPicker;
use App\Nova\Actions\ApprovalRejectTransaction;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select as singleSelect;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Image;
use Epartment\NovaDependencyContainer\HasDependencies;
use Alaqsa\Project\Project;
use App\Models\BusesCompany;
use App\Models\Project as ModelsProject;
use App\Models\Sector;
use App\Models\TelephoneDirectory;
use App\Nova\Actions\BillPdf;
use App\Nova\Actions\ExportPaymentVoucher;
use App\Nova\Filters\Transactionproject;
use App\Nova\Filters\TransactionSectors;
use App\Nova\Metrics\InComeTransaction;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use MyApp\BillingSchedule\BillingSchedule;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
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

        return $query->where('main_type', '2')->orderBy('transaction_date', 'DESC');
    }
    public static function createButtonLabel()
    {
        return 'انشاء سند صرف';
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            // Text::make(__('name'), "name")->rules('required'),


            ProjectPicker::make(__('project'),'ref_id',function(){
                $keyValueArray = ['key1' => $this->ref_id, 'key2' => $this->transaction_date];

                return $keyValueArray ;
            })->hideFromDetail()->hideFromIndex(),


            Date::make(__('date'), 'transaction_date')->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('project'), 'project', \App\Nova\project::class)->hideWhenCreating()->hideWhenUpdating(),


            Flexible::make(__('new project'), 'newproject')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('project_name'), "project_name")->rules('required'),
                    Text::make(__('project_describe'), "project_describe")->rules('required'),
                    DateTime::make(__('projec start'), 'start_date')->rules('required')->hideFromIndex(),
                    DateTime::make(__('projec end'), 'end_date')->hideFromIndex(),
                ])->confirmRemove(),
            Select::make(__("type"), "type")->options([
                '0' => __('the Payment Voucher'),
                '1' => __('project'),
                '2' => __('qawael'),
                '3' => __('trip'),
            ])->hideWhenCreating()->hideWhenUpdating()->singleSelect(),




            Select::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '8')->get();
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
                ->hideWhenCreating()->hideFromIndex()->hideFromDetail()->readonly()->singleSelect(),
            Select::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '8')->get();
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
                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                })->hideFromDetail()->hideFromIndex()->hideWhenUpdating()->singleSelect(),

            Flexible::make(__('add user'), 'add_user')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('tooles'), 'Payment_type_details ', [
                    Text::make(__('name'), "name")->rules('required'),
                    Text::make(__('phone'), "phone")->rules('required'),
                ])->hideWhenUpdating(),

            BelongsTo::make(__('1reference_id'), 'project', \App\Nova\Project::class)->canSee(function () {
                return $this->type != '0';
            })->hideWhenUpdating()->hideWhenCreating()->hideFromIndex(),
            BelongsTo::make(__('2reference_id'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating()->canSee(function () {
                return ($this->transaction_type === '1' && $this->type == '0');
            })->hideFromIndex(),
            BelongsTo::make(__('3reference_id'), 'BusesCompany', \App\Nova\BusesCompany::class)->hideWhenCreating()->hideWhenUpdating()->canSee(function () {
                return ($this->transaction_type === '2' && $this->type == '0');
            })->hideFromIndex(),

            Text::make(__('company_number'), 'company_number')->hideFromDetail()->hideFromIndex(),


            Text::make(__('company_number'), 'company_number', function () {
                if ($this->TelephoneDirectory) {
                    return $this->TelephoneDirectory->name;
                }
            })->hideWhenCreating()->hideFromIndex()->hideWhenUpdating()->canSee(function () {
                return $this->transaction_type === '1';
            }),
            Text::make(__('company_number'), 'company_number', function () {
                if ($this->BusesCompany) {
                    return $this->BusesCompany->company_id;
                }
            })->hideWhenCreating()->hideFromIndex()->hideWhenUpdating()->canSee(function () {
                return $this->transaction_type === '2';
            }),


            Text::make(__('bill_number'), 'bill_number'),
            Text::make(__('description'), 'description')->hideFromIndex(),

            BelongsTo::make(__('Currenc'), 'Currenc', \App\Nova\Currency::class),



            singleSelect::make(__("Payment_type"), "Payment_type")->options([
                '1' => __('cash'),
                '2' => __('shek'),
                '3' => __('bit'),
                '4' => __('hawale'),
                // '5' => __('Other'),
            ])->default('1'),
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
            Files::make(__('voucher'), 'voucher'),
            Files::make(__('file'), 'file'),
            // File::make(__('voucher'), 'voucher')->disk('public')->prunable(),
            // File::make(__('file'), 'file')->disk('public')->prunable(),

            // Select::make(__('approval'), 'approval')->options([
            //     1 => 'approval',
            //     2 => 'reject',
            // ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),
            // Text::make(__("reason_of_reject"), "reason_of_reject")->hideWhenCreating()->hideWhenUpdating(),




            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)


        ];
    }
    public static function beforeSave(Request $request, $model)
    {

        $model->transaction_date = json_decode( $request->ref_id)->key1;
        $model->ref_id = json_decode( $request->ref_id)->key2;
        $model->sector=ModelsProject::where('id',json_decode( $request->ref_id)->key2)->first()->sector;
        $request->request->remove('ref_id');

        if (strpos($request->name, 'T') !== false) {

            $model->transaction_type = '1';
            $str = ltrim($request->name, 'T');
            $model->name = $str;
        } elseif (strpos($request->name, 'B') !== false) {
            $model->transaction_type = '2';
            $str = ltrim($request->name, 'B');
            $model->name = $str;
        }else
        {
            $model->transaction_type = '1';
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
        }
        if (!$request->name) {
            // dd($request->add_user);
            if ($request->add_user) {
                # code...

            if ($request->add_user[0]['attributes']['name'] &&     $request->add_user[0]['attributes']['phone']) {
                $telfone =  new TelephoneDirectory();


                $telfone->name = $request->add_user[0]['attributes']['name'];
                $telfone->type = '8';
                $telfone->phone_number =  $request->add_user[0]['attributes']['phone'];
                $telfone->save();


                $busescompanies= new  BusesCompany();
                $busescompanies->name = $request->add_user[0]['attributes']['name'];
                $busescompanies->phone_number =  $request->add_user[0]['attributes']['phone'];
                $busescompanies->save();
            }
            $model->name=$telfone->id;
            // $request->merge(['name' => ]);


            $request->merge(['transaction_type' => '1']);
        }
        }
        $request->request->remove('add_user');
        if (!$request->ref_id) {
            // dd($request->add_user);
            if ($request->newproject) {
                # code...

            if ($request->newproject[0]['attributes']['project_name'] &&     $request->newproject[0]['attributes']['project_describe'] && $request->newproject[0]['attributes']['start_date'] &&     $request->newproject[0]['attributes']['end_date']) {
                $Project =  new  ModelsProject();


                $Project->project_name = $request->newproject[0]['attributes']['project_name'];
                $Project->project_describe = $request->newproject[0]['attributes']['project_describe'];
                $Project->start_date =  $request->newproject[0]['attributes']['start_date'];
                $Project->end_date =  $request->newproject[0]['attributes']['end_date'];
                $Project->project_type = '1';
                $Project->save();
            }
            $request->merge(['ref_id' => $Project->id]);

        }
        }
        $request->request->remove('newproject');

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
        return [
            new Transactionproject(),
            new TransactionSectors(),
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
            new ApprovalRejectTransaction,
            new BillPdf,
            (new ExportPaymentVoucher)->standalone()->withoutConfirmation(),


        ];
    }
}
