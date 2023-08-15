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
use App\Nova\Actions\DeleteBill;
use App\Nova\Actions\DepositedInBank;
use App\Nova\Actions\PrintBill;
use App\Nova\Actions\ReceiveDonation;
use App\Nova\Filters\AlhisalatColect;
use App\Nova\Metrics\DonationInBank;
use App\Nova\Metrics\DonationInBox;
use App\Nova\Metrics\DonationNotReceive;
use AwesomeNova\Cards\FilterCard;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use NovaButton\Button;
use function Clue\StreamFilter\fun;
use Titasgailius\SearchRelations\SearchesRelations;

class Donation extends Resource
{

    use SearchesRelations;

    public static $searchRelations = [
        'TelephoneDirectory' => ['id', 'name'],
    ];
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
    // public function authorizedToUpdate(Request $request)
    // {
    //     dd($request->all());
    // }
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
        'id', 'name'
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
            ['type', 2]
        ]);
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
                Button::make(__('print'))->link('/mainbill/' .$this->id)->style('primary'),

            Select::make(__("transaction_type"), "transaction_type")->options([
                '1' => __('handy'),
                '2' => __('automatic'),
                '3' => __('Alhisalat'),
                '4' => __('delet bill'),

            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating()->hideFromIndex()   ,
            Select::make(__("transaction_status"), "transaction_status")->options([
                '1' => __('Not Receive yet'),
                '2' => __('in a box'),
                '3' => __('in the bank'),

            ])->displayUsingLabels()->hideWhenCreating()->hideWhenUpdating(),

            // BelongsTo::make(__('project'), 'project')->hideWhenCreating()->readonly(),
            // Project::make(__('ref_id'), 'ref_id')->hideFromIndex(),
            BelongsTo::make(__('Sector'), 'Sectors', \App\Nova\Sector::class)->nullable()->hideFromIndex(),
            BelongsTo::make(__('project'), 'project', \App\Nova\project::class)->nullable()->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
            Multiselect::make(__('project'), "ref_id")
            ->options(function () {
                $Users =  \App\Models\Project::all();

                $i = 0;
                $user_type_admin_array =  array();
                foreach ($Users as $User) {


                    $user_type_admin_array += [($User['id']) => ($User['project_name'])];
                }

                return $user_type_admin_array;
            })
            ->singleSelect(),




            Boolean::make(__('Receive Done'), 'ReceiveDonation', function () {
                return ($this->transaction_status > 1) ? true : false;
            })

                ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                    return null;
                }),
            Text::make(__('description'), 'description')->hideFromIndex(),

            // ->canSee(function () {
            //     return ($this->transaction_status  < 3) ? true : false;
            // }),


            Text::make(__('equivalent value'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),


            Multiselect::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '2')->get();

                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->singleSelect(),



            Flexible::make(__('add user'), 'add_user')
                ->readonly(true)

                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('tooles'), 'Payment_type_details ', [
                    Text::make(__('name'), "name")->rules('required'),
                    Text::make(__('phone'), "phone"),
                ]),

            BelongsTo::make(__('reference_id'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating()->hideFromIndex(),

            Text::make(__('payment_reason'), "payment_reason")->hideFromIndex(),

            Select::make(__("billing language"), "lang")->options([
                '1' => __('ar'),
                '2' => __('en'),
                '3' => __('hr'),
            ])->displayUsingLabels()->rules('required'),
            Select::make(__("Payment_type"), "Payment_type")->options([
                '1' => __('cash'),
                '2' => __('shek'),
                '3' => __('bit'),
                '4' => __('hawale'),
                '5' => __('pay pal'),
            ])->displayUsingLabels()->default('1'),
            NovaDependencyContainer::make([
                Text::make(__('transact amount'), 'transact_amount')->rules('required'),
            ])->dependsOn("Payment_type", '1')->hideFromDetail()->hideFromIndex(),

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
            ])->dependsOn("Payment_type", '2')->hideFromDetail()->hideFromIndex(),
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
            ])->dependsOn("Payment_type", '3')->hideFromDetail()->hideFromIndex(),

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
            ])->dependsOn("Payment_type", '4')->hideFromDetail()->hideFromIndex(),
            NovaDependencyContainer::make([
                Text::make(__('transact amount'), 'transact_amount')->rules('required'),
            ])->dependsOn("Payment_type", '5')->hideFromDetail()->hideFromIndex(),
            // BelongsTo::make(__('reference_id'), 'Alhisalat', \App\Nova\Alhisalat::class),

            ActionButton::make(__('delete'))
            ->action((new DeleteBill)->confirmText(__('Are you sure you want to delete  this?'))
                ->confirmButtonText(__('delete'))
                ->cancelButtonText(__('Dont delete')), $this->id)
            ->text(__('delete'))->showLoadingAnimation() ->readonly(function () {
                return $this->is_delete > 0;
            })->buttonColor('#FF0000')->svg('_Delete2')
            ->loadingColor('#fff')->hideWhenCreating()->hideWhenUpdating(),

            Button::make(__('print Pdf'))->link('/generate-pdf/' .$this->id)->style('info'),
            Date::make(__('date'), 'transaction_date')->rules('required'),

            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class),

        ];
    }
    // public static function redirectAfterUpdate(NovaRequest $request, $resource)
    // {
    //     return '/resources/'.static::uriKey().'/'.$resource->getKey();

    // }
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/bill?location='. $resource->id.'&type=1';
    }
    // public static function afterCreate(Request $request, $model)
    // {
    //     return Action::redirect("/mainbill/" . $model->id);
    // }

    public static function beforeCreate(Request $request, $model)
    {



        // $new = DB::table('currencies')->where('id', $request->Currency)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->transaction_type = '1';
        $model->main_type = '1';
        $model->type = '2';
        // dd($request->ReceiveDonation );
        if ($request->ReceiveDonation == 1) $model->transaction_status = '2';
        else  $model->transaction_status = '1';


        // $model->equivelant_amount = $new->rate * $request->transact_amount;
    }
    public static function beforesave(Request $request, $model)
    {



        if ($request->ReceiveDonation == 1) $model->transaction_status = '2';
        else  $model->transaction_status = '1';
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

        // $currencies = DB::table('currencies')->where('id', $request->Currency)->first();
        // $id = Auth::id();
        // $model->update_by = $id;
        // if ($model->Currenc->id == $request->Currenc) {
        //     $rate = ((int)$model->equivelant_amount / (int)$model->transact_amount);
        // } else  $rate = $currencies->rate;
        // $model->equivelant_amount = $rate * $request->transact_amount;
    }
    public static function aftersave(Request $request, $model)
    {

        if (!$request->name && $request->add_user) {
            if ($request->add_user[0]['attributes']['name'] ) {
                $telfone =  TelephoneDirectory::create(
                    [
                        'name' => $request->add_user[0]['attributes']['name'],
                        'type' => '2',
                        'phone_number' =>  $request->add_user[0]['attributes']['phone']
                    ],
                );
            }
            // dd( $telfone);
            DB::table('transactions')
                ->where('id', $model->id)
                ->update(['name' => $telfone->id]);
        }
        // return Action::openInNewTab("/mainbill/". $model->id);
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
            // new OutComeTransaction()
            new DonationNotReceive(),
            new DonationInBox(),
            new DonationInBank(),
            new FilterCard(new AlhisalatColect()),
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
            new AlhisalatColect(),
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
            new ReceiveDonation,
            new DepositedInBank,
            new BillPdf,
            new DeleteBill,
           ( new PrintBill)->withoutConfirmation(),

        ];
    }
}
