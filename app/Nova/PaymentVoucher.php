<?php

namespace App\Nova;

use Acme\Analytics\Analytics;
use Acme\MultiselectField\Multiselect as Select;
use Acme\MultiselectField\Multiselect;
use Acme\NumberField\NumberField;
use Acme\ProjectPicker\ProjectPicker;
use Acme\SectorPicker\SectorPicker;
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
use App\Models\Currency;
use App\Models\Project as ModelsProject;
use App\Models\Sector;
use App\Models\TelephoneDirectory;
use App\Nova\Actions\BillPdf;
use App\Nova\Actions\ExportPaymentVoucher;
use App\Nova\Filters\PaymentVoucherCompany;
use App\Nova\Filters\Transactionproject;
use App\Nova\Filters\TransactionSectors;
use App\Nova\Metrics\InComeTransaction;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use MyApp\BillingSchedule\BillingSchedule;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Pdmfc\NovaFields\ActionButton;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
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
            ProjectPicker::make(__('تاريخ اخراج سند الصرف'), 'ref_id', function () {
                $keyValueArray = ['key1' => $this->ref_id, 'key2' => $this->transaction_date];

                return $keyValueArray;
            })->hideFromDetail()->hideFromIndex(),
            Flexible::make(__('new project'), 'newproject')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [

                    SectorPicker::make(__('تاريخ المشروع'), 'ref_id', function () {
                        $keyValueArray = ['key1' => $this->sector, 'key2' => $this->start_date];

                        return $keyValueArray;
                    })->hideFromDetail()->hideFromIndex(),
                    Text::make(__("project name"), "project_name"),
                    Textarea::make(__("project describe"), "project_describe")->hideFromIndex(),

                    Multiselect::make(__('city'), 'city')
                        ->options(function () {
                            $Areas =  \App\Models\City::all();

                            $Area_type_admin_array =  array();

                            foreach ($Areas as $Area) {


                                $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                            }

                            return $Area_type_admin_array;
                        })->singleSelect()->hideFromIndex()->hideFromDetail(),

                ]),



            Date::make(__('date'), 'transaction_date')->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('المشروع'), 'project', \App\Nova\project::class)->hideWhenCreating()->hideWhenUpdating(),

            BelongsTo::make(__('company'), 'company', \App\Nova\BusesCompany::class),

            BelongsTo::make(__('Sector name'), 'Sectors', \App\Nova\Sector::class)->hideWhenCreating()->hideWhenUpdating(),


            Flexible::make(__('اضافة  شركة  جديدة'), 'add_user')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('tooles'), 'Payment_type_details ', [
                    Text::make(__('name'), "name")->rules('required'),
                    Text::make(__('phone'), "phone")->rules('required'),
                ])->hideWhenUpdating(),






            Text::make(__('bill_number'), 'bill_number'),
            Text::make(__('description'), 'description')->hideFromIndex(),

            BelongsTo::make(__('Currenc'), 'Currenc', \App\Nova\Currency::class),



            singleSelect::make(__("Payment_type"), "Payment_type")->options([
                '1' => __('cash'),
                '2' => __('shek'),
                '3' => __('bit'),
                '4' => __('hawale'),
            ])->default('1')->displayUsingLabels(),

            NovaDependencyContainer::make([
                NumberField::make(__('transact amount pay'), 'transact_amount')->rules('required'),

            ])->dependsOn("Payment_type", '1')->hideFromIndex(),

            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        NumberField::make(__('Doubt value'), "Doubt_value")->rules('required'),
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
                        NumberField::make(__('value'), "equivelant_amount")->rules('required'),
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
                        NumberField::make(__('value'), "equivelant_amount")->rules('required'),

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
            NumberField::make(__('equivelant_amount'), 'equivelant_amount')->hideWhenCreating()->hideWhenUpdating(),

            Files::make(__('voucher'), 'voucher'),
            Files::make(__('file'), 'file'),

            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $data = json_decode($request->ref_id, true);
        if (!((isset($data['key2']) && !empty($data['key2'])) || $request->newproject)) {
            $validator->errors()->add('ref_id', 'يجب اضافة مشروع');
        }

        $refId = json_decode($request->newproject[0]['attributes']['ref_id']);
        if (!isset($refId->key1) || !isset($refId->key2)) {
            $validator->errors()->add($request->newproject[0]['key'] . '__ref_id', 'هذا الحقل مطلوب');
        }
        if (!isset($request->newproject[0]['attributes']['project_describe'])) {
            $validator->errors()->add($request->newproject[0]['key'] . '__project_describe', 'هذا الحقل مطلوب');
        }
        if (!isset($request->newproject[0]['attributes']['project_name'])) {
            $validator->errors()->add($request->newproject[0]['key'] . '__project_name', 'هذا الحقل مطلوب');
        }
        $date1 = json_decode($request->ref_id)->key1;
        $date2 = json_decode($request->newproject[0]['attributes']['ref_id'])->key1;
        $year1 = date('Y', strtotime($date1));
        $year2 = date('Y', strtotime($date2));
        if (!($year1 == $year2)) {
            $validator->errors()->add('ref_id', 'تاريخ المشروع غير متطابق مع تاريخ السند');
        }

        if ($request->newproject  &&  empty(json_decode($request->ref_id)->key2)) {
            $date1 = json_decode($request->ref_id)->key1;
            $date2 = json_decode($request->newproject[0]['attributes']['ref_id'])->key1;
            $year1 = date('Y', strtotime($date1));
            $year2 = date('Y', strtotime($date2));
            if (!($year1 == $year2)) {
                $validator->errors()->add('ref_id', 'تاريخ المشروع غير متطابق مع تاريخ السند');
            }
        }
    }
    public static function beforeSave(Request $request, $model)
    {


        if ($request->newproject  &&  empty(json_decode($request->ref_id)->key2)) {

            $Project =  new  ModelsProject();
            $model->transaction_date = json_decode($request->ref_id)->key1;
            $Project->start_date = json_decode($request->newproject[0]['attributes']['ref_id'])->key1;
            $Project->sector = json_decode($request->newproject[0]['attributes']['ref_id'])->key2;
            $Project->project_name = $request->newproject[0]['attributes']['project_name'];
            $Project->project_describe = $request->newproject[0]['attributes']['project_describe'];
            $Project->project_type = '1';
            $Project->save();
            $model->ref_id = $Project->id;
            $model->sector = json_decode($request->newproject[0]['attributes']['ref_id'])->key2;
        } else {
            $model->transaction_date = json_decode($request->ref_id)->key1;
            $model->ref_id = json_decode($request->ref_id)->key2;
            $model->sector = ModelsProject::where('id', json_decode($request->ref_id)->key2)->first()->sector;
        }
        $request->request->remove('newproject');
        $request->request->remove('ref_id');

        $model->transaction_type = '2';




        if ($request->Payment_type == '1') {
            $model->Payment_type_details = null;
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
        } elseif ($request->Payment_type == '4') {
            $model->transact_amount = 0;
            $amount = 0;
            foreach ($request->Payment_type_details as $key => $value) {

                $amount += $value['attributes']['equivelant_amount'];
            }

            $model->equivelant_amount = $amount;
        }
        $Currency = Currency::find($request->Currenc);
        $model->equivelant_amount = $model->equivelant_amount * $Currency->rate;
        if (!$request->name) {
            if ($request->add_user) {

                if ($request->add_user[0]['attributes']['name'] &&     $request->add_user[0]['attributes']['phone']) {
                    $telfone =  new TelephoneDirectory();


                    $telfone->name = $request->add_user[0]['attributes']['name'];
                    $telfone->type = '8';
                    $telfone->phone_number =  $request->add_user[0]['attributes']['phone'];
                    $telfone->save();


                    $busescompanies = new  BusesCompany();
                    $busescompanies->name = $request->add_user[0]['attributes']['name'];
                    $busescompanies->phone_number =  $request->add_user[0]['attributes']['phone'];
                    $busescompanies->save();
                }
                $model->name = $busescompanies->id;
                // $request->merge(['name' => ]);


                $request->merge(['transaction_type' => '1']);
            }
        }
        $request->request->remove('add_user');
        if (!$request->ref_id) {
            if ($request->newproject) {
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
            new PaymentVoucherCompany(),
            new DateRangeFilter(__("transaction_date"), "transaction_date"),

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
            // new ApprovalRejectTransaction,
            new BillPdf,
            (new ExportPaymentVoucher)->standalone()->withoutConfirmation(),


        ];
    }
}
