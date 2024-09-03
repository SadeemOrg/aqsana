<?php

namespace App\Nova;

use Alaqsa\Project\Project;
use App\Models\TelephoneDirectory;
use App\Nova\Actions\BillPdf;
use App\Nova\Metrics\OutComeTransaction;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Techouse\SelectAutoComplete\SelectAutoComplete;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaFields\ActionButton;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Fields\DateTime;
use Acme\MultiselectField\Multiselect;
use Acme\NumberField\NumberField;
use Acme\ProjectPicker\ProjectPicker;
use Acme\SectorPicker\SectorPicker;
use App\Models\Project as ModelsProject;
use App\Models\Sector;
use App\Models\Transaction;
use App\Nova\Actions\DeleteBill;
use App\Nova\Actions\DepositedInBank;
use App\Nova\Actions\ExportDonations;
use App\Nova\Actions\PrintBill;
use App\Nova\Actions\ReceiveDonation;
use App\Nova\Filters\AlhisalatColect;
use App\Nova\Filters\PaymentType;
use App\Nova\Filters\ReportCompany;
use App\Nova\Filters\ReportCreated;
use App\Nova\Filters\Transactionproject;
use App\Nova\Filters\TransactionSectors;
use App\Nova\Metrics\DonationInBank;
use App\Nova\Metrics\DonationInBox;
use App\Nova\Metrics\DonationNotReceive;
use AwesomeNova\Cards\FilterCard;
use Carbon\Carbon;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use NovaButton\Button;
use function Clue\StreamFilter\fun;
use Titasgailius\SearchRelations\SearchesRelations;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use Upline\RowBackground\RowBackground;
use Upline\RowBackground\RowBackgroundData;

class Donation extends Resource
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

    public static function createButtonLabel()
    {
        return 'انشاء سند قبض';
    }
    public static function label()
    {
        return __('the receipt Voucher');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Donationparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static $priority = 2;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'transaction_date',
        'equivelant_amount'

    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where([
            ['main_type', 1],
            ['type', 2],
            ['is_delete', '<>', '2'],

        ]);
    }
    public function fields(Request $request)
    {
        return [

            Text::make(__('bill_number'), 'bill_number')->hideWhenCreating()->hideWhenUpdating(),


            ProjectPicker::make(__('تاريخ اخراج سند القبض '), 'ref_id', function () {
                $keyValueArray = ['key1' => $this->ref_id, 'key2' => $this->transaction_date];

                return $keyValueArray;
            })->hideFromDetail()->hideFromIndex()->rules('required')->sortable(),

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
            Select::make(__("transaction_type"), "transaction_type")->options([
                '1' => __('handy'),
                '2' => __('automatic'),
                '3' => __('Alhisalat'),
                '4' => __('delet bill'),

            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating()->hideFromIndex(),
            Select::make(__("transaction_status"), "transaction_status")->options([
                '1' => __('Not Receive yet'),
                '2' => __('in a box'),
                '3' => __('in the bank'),

            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),



            Boolean::make(__('Receive Done'), 'ReceiveDonation', function () {
                return ($this->transaction_status > 1) ? true : false;
            })->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                return null;
            }),
            Text::make(__('description'), 'description')->hideFromIndex(),
            Text::make(__('equivalent value'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('الشركة'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),
            Multiselect::make(__(' اسم الشركة او اسم المتبرع'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '2')->get();
                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->singleSelect()->hideFromDetail()->hideFromIndex(),



            Flexible::make(__('اضافة شركة جديد او متبرع'), 'add_user')
                ->readonly(true)
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('tooles'), 'Payment_type_details ', [
                    Text::make(__('name'), "name")->rules('required'),
                    Text::make(__('phone'), "phone"),
                ]),


            Text::make(__('payment_reason'), "payment_reason")->hideFromIndex(),
            Select::make(__("billing language"), "lang")->options([
                '1' => __('ar'),
                '2' => __('en'),
                '3' => __('hr'),
            ])->displayUsingLabels()->hideFromIndex()->default('1')->rules('required'),
            Select::make(__("Payment_type"), "Payment_type")->options(
                [
                    '1' => __('cash'),
                    '2' => __('shek'),
                    '3' => __('bit'),
                    '4' => __('hawale'),
                ]
            )->displayUsingLabels()->default('4')->hideFromDetail()->hideFromIndex(),
            Select::make(__("Payment_type"), "Payment_type")->options(
                [
                    '1' => __('cash'),
                    '2' => __('shek'),
                    '3' => __('bit'),
                    '4' => __('hawale'),
                    '5' => __('حصالة'),
                    '6' => __('التطبيق'),

                ]
            )->displayUsingLabels()->default('4')->hideWhenCreating()->hideWhenUpdating(),
            NovaDependencyContainer::make([
                NumberField::make(__('transact amount'), 'transact_amount')->rules('required'),
            ])->dependsOn("Payment_type", '1')->hideFromDetail()->hideFromIndex(),
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
                                return $value ?? Carbon::now()->format('d/m/Y');
                            })->rules('required'),

                    ])->rules('required'),
            ])->dependsOn("Payment_type", '2')->hideFromDetail()->hideFromIndex(),
            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        NumberField::make(__('value'), "equivelant_amount")->rules('required'),
                        Text::make(__('telephone'), "telephone")->rules('required'),
                        DateTime::make(__('History Of Bit'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value ?? Carbon::now()->format('d/m/Y');
                            })->rules('required'),

                    ]),
            ])->dependsOn("Payment_type", '3')->hideFromDetail()->hideFromIndex(),
            NovaDependencyContainer::make([
                Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                    ->addLayout(__('tooles'), 'Payment_type_details ', [
                        NumberField::make(__('value'), "equivelant_amount")->rules('required'),
                        Text::make(__('bank number'), "bank_number"),
                        Text::make(__('Branch number'), "Branch_number"),
                        Text::make(__('account number'), "account_number"),

                        DateTime::make(__('History of hawale'), 'Date')
                            ->format('DD/MM/YYYY')
                            ->resolveUsing(function ($value) {
                                return $value ?? Carbon::now()->format('d/m/Y');
                            })
                            ->rules('required'),

                    ])->rules('required'),
            ])->dependsOn("Payment_type", '4')->hideFromDetail()->hideFromIndex(),
            NovaDependencyContainer::make([
                NumberField::make(__('transact amount'), 'transact_amount')->rules('required'),
            ])->dependsOn("Payment_type", '5')->hideFromDetail()->hideFromIndex(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            ActionButton::make('')
                ->svg('delete') // Use the Vue component name here

                ->action((new DeleteBill)->confirmText(__('Are you sure you want to delete  this?'))
                    ->confirmButtonText(__('compensation'))
                    ->cancelButtonText(__('cancellation')), [$this->id])
                ->text('compensation')->showLoadingAnimation()->readonly(function () {
                    return $this->is_delete > 0;
                })->buttonColor('#FFFFFF')

                ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),

            Button::make(__('print'))->link('/mainbill/' . $this->id . '?type=bill')->style('custom')->canSee(function () {
                return $this->is_delete == 0;
            }),
            Button::make(__('print'))->link('/mainbill/' . $this->deleted_ref   . '?type=repayment')->style('custom')->canSee(function () {
                return $this->is_delete != 0;
            }),

            Button::make(__('print Pdf'))->link('/generate-pdf/' . $this->id)->style('custom')->canSee(function () {
                return $this->is_delete == 0;
            }),
            Button::make(__('print Pdf'))->link('/generate-pdf/' . $this->deleted_ref . '/2')->style('custom')->canSee(function () {
                return $this->is_delete != 0;
            }),

            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class),
            RowBackground::make(__("Net In Come"), "is_delete", function ($model) {
                if ($this->is_delete != 0) {
                    return new RowBackgroundData("#A9A9A9", "#000000");
                }
            })->onlyOnIndex(),

        ];
    }


    public function cards(Request $request)
    {
        return [
            new DonationNotReceive(),
            new DonationInBox(),
            new DonationInBank(),
            new FilterCard(new AlhisalatColect()),

        ];
    }


    public function filters(Request $request)
    {
        return [
         ];
    }

    public function lenses(Request $request)
    {
        return [];
    }


    public function actions(Request $request)
    {
        return [

        ];
    }
}
