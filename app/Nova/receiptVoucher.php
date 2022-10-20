<?php

namespace App\Nova;

use App\Models\Alhisalat;
use App\Models\Donations;
use App\Nova\Actions\BillPdf;
use Benjacho\BelongsToManyField\BelongsToManyField;
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
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Pdmfc\NovaFields\ActionButton;
use Whitecube\NovaFlexibleContent\Flexible;

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

    protected $casts = [
        'shek_date' => 'date',
        'Payment_type_details' => FlexibleCast::class,

    ];
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
            ActionButton::make(__('POST NEWS'))
                ->action((new BillPdf)->confirmText(__('Are you sure you want to post  this NEWS?'))
                    ->confirmButtonText(__('print'))
                    ->cancelButtonText(__('Dont print')), $this->id)
                ->text(__('print'))->showLoadingAnimation()
                ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            Select::make(__("type"), "type")->options([
                '1' => __('Alhisalat'),
                '2' => __('Donations'),
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([
                Select::make(__('Alhisalat'), "ref_id")
                    ->options(function () {
                        $Alhisalats =  \App\Models\Alhisalat::all();
                        $user_type_admin_array =  array();
                        foreach ($Alhisalats as $Alhisalat) {
                            $user_type_admin_array += [$Alhisalat['id'] => ($Alhisalat['address_id'])];
                        }

                        return $user_type_admin_array;
                    })
                    ->displayUsingLabels(),




            ])->dependsOn("type", '1')->hideFromDetail()->hideFromIndex(),


            Text::make(__('transact amount'), 'transact_amount'),
            Select::make(__('Currenc'), "Currency")
                ->options(function () {
                    $Alhisalats =  \App\Models\Currency::all();
                    $user_type_admin_array =  array();
                    foreach ($Alhisalats as $Alhisalat) {
                        $user_type_admin_array += [$Alhisalat['id'] => ($Alhisalat['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->displayUsingLabels(),
            Text::make(__('equivalent amount'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('description'), 'description'),
            Date::make(__('date'), 'transaction_date'),


            NovaDependencyContainer::make([
                Select::make(__('name'), "name")
                ->options(function () {
                    $Users =  \App\Models\User::where('user_role', 'company')->get();;
                                            $i=0;
                                            $user_type_admin_array =  array();
                                            foreach ($Users as $User) {


                                                    $user_type_admin_array += [($User['id']) => ($User['name'])];

                                        }

                    return $user_type_admin_array;
                })
                ->displayUsingLabels(),
                // Select::make(__('project'), "ref_id")
                //     ->options(function () {
                //         $Alhisalats =  \App\Models\User::all();
                //         $user_type_admin_array =  array();
                //         foreach ($Alhisalats as $Alhisalat) {
                //             $user_type_admin_array += [$Alhisalat['id'] => ($Alhisalat['name'])];
                //         }

                //         return $user_type_admin_array;
                //     })
                //     ->displayUsingLabels(),

                Select::make(__("billing language"), "lang")->options([
                    '1' => __('ar'),
                    '2' => __('en'),
                    '3' => __('hr'),
                ])->displayUsingLabels(),
                Select::make(__("Payment_type"), "Payment_type")->options([
                    '1' => __('cash'),
                    '2' => __('shek'),
                    '3' => __('visa'),
                    '4' => __('hawale'),
                    '5' => __('Other'),
                ])->displayUsingLabels(),



                NovaDependencyContainer::make([
                    Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                        ->addLayout(__('tooles'), 'Payment_type_details ', [
                            Text::make(__('Doubt value'), "equivelant_amount")->rules('required'),
                            Text::make(__('bank number'), "equivelant_amount"),
                            Text::make(__('Branch number'), "equivelant_amount"),
                            Text::make(__('account number'), "equivelant_amount"),
                            Text::make(__('Doubt number'), "equivelant_amount"),

                            DateTime::make(__('History of doubt'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                        ]),
                ])->dependsOn("Payment_type", '2')->hideFromDetail()->hideFromIndex(),

                NovaDependencyContainer::make([
                    Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                        ->addLayout(__('tooles'), 'Payment_type_details ', [
                            Text::make(__('Doubt value'), "equivelant_amount")->rules('required'),

                            Text::make(__('card type'), "equivelant_amount"),
                            Text::make(__('card number'), "equivelant_amount"),
                            Text::make(__('number of installments'), "equivelant_amount"),

                            DateTime::make(__('History of doubt'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                        ]),
                ])->dependsOn("Payment_type", '3')->hideFromDetail()->hideFromIndex(),

                NovaDependencyContainer::make([
                    Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                        ->addLayout(__('tooles'), 'Payment_type_details ', [
                            Text::make(__('Doubt value'), "equivelant_amount")->rules('required'),

                            Text::make(__('bank number'), "equivelant_amount"),
                            Text::make(__('Branch number'), "equivelant_amount"),
                            Text::make(__('account number'), "equivelant_amount"),

                            DateTime::make(__('History of doubt'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                        ])->stacked(),
                ])->dependsOn("Payment_type", '4')->hideFromDetail()->hideFromIndex(),

                NovaDependencyContainer::make([
                    Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                        ->addLayout(__('tooles'), 'Payment_type_details ', [
                            Text::make(__('Doubt value'), "equivelant_amount")->rules('required'),

                            Text::make(__('type'), "equivelant_amount1")->rules('required'),


                            DateTime::make(__('History of doubt'), 'Date')
                            ->format('DD/MM/YYYY HH:mm')
                            ->resolveUsing(function ($value) {
                                return $value;
                            })->rules('required'),

                        ]),
                ])->dependsOn("Payment_type", '5')->hideFromDetail()->hideFromIndex(),

                // BelongsTo::make(__('reference_id'), 'Alhisalat', \App\Nova\Alhisalat::class),

            ])->dependsOn("type", '2')->hideFromDetail()->hideFromIndex(),



        ];
    }
    public static function beforeCreate(Request $request, $model)
    {

        $new = DB::table('currencies')->where('id', $request->Currency)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '1';
        $model->type = '3';
        $model->equivelant_amount = $new->rate * $request->transact_amount;
    }
    public static function beforeUpdate(Request $request, $model)
    {


        $currencies = DB::table('currencies')->where('id', $request->Currency)->first();
        $id = Auth::id();
        $model->update_by = $id;
        if ($model->Currenc->id == $request->Currenc) {
            $rate = ((int)$model->equivelant_amount / (int)$model->transact_amount);
        } else  $rate = $currencies->rate;
        $model->equivelant_amount = $rate * $request->transact_amount;
    }
    public static function beforesave(Request $request, $model)
    {
        // dd(date('Y-m-d'));
        // $new = DB::table('currencies')->where('id', $request->Currency)->first();
        // if ($request->type == 2) {
        //     DB::table('donations')
        //         ->Insert(

        //             [
        //                 'project_id' => $request->ref_id,
        //                 'donor_name' => $request->name,
        //                 'amount' => $new->rate * $request->transact_amount,
        //                 'created_at' =>  date('Y-m-d'),
        //             ]
        //         );
        // }
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
            new BillPdf,
        ];
    }
}
