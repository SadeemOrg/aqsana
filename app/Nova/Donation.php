<?php

namespace App\Nova;

use App\Nova\Actions\BillPdf;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaFields\ActionButton;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Fields\DateTime;
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


    public static function label()
    {
        return __('Donations');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public static $priority = 2;
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

        return $query->where([
            ['main_type', 1],
            ['type', 2]
        ]);
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            ActionButton::make(__('print'))
            ->action((new BillPdf)->confirmText(__('Are you sure you want to print  this?'))
                ->confirmButtonText(__('print'))
                ->cancelButtonText(__('Dont print')), $this->id)
            ->text(__('print'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),





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


                    Select::make(__('name'), "name")
                        ->options(function () {
                            $Users =  \App\Models\User::where('user_role', 'company')->get();;
                            $i = 0;
                            $user_type_admin_array =  array();
                            foreach ($Users as $User) {


                                $user_type_admin_array += [($User['id']) => ($User['name'])];
                            }

                            return $user_type_admin_array;
                        })
                        ->displayUsingLabels(),
                    Flexible::make(__('add user'),'add_user')
                    ->readonly(true)

                        ->hideFromDetail()->hideFromIndex()
                        ->addLayout(__('tooles'), 'Payment_type_details ', [
                            Text::make(__('name'), "name")->rules('required'),
                            Text::make(__('email'), "email")->rules('required'),
                            Text::make(__('phone'), "phone")->rules('required'),
                        ]),


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
                                Text::make(__('value'), "equivelant_amount")->rules('required'),

                                Select::make(__('card type'), "card_type")  ->options([
                                    '1' => 'אמירקן אקספרס',
                                    '2' => 'שראכרט, ויזה',
                                    '3' => 'מסטרקארד',
                                    '4' => 'דיינרס',

                                ]),

                                Text::make(__('card number'), "equivelant_amount"),
                                Text::make(__('number of installments'), "equivelant_amount"),

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

                                Text::make(__('bank number'), "equivelant_amount"),
                                Text::make(__('Branch number'), "equivelant_amount"),
                                Text::make(__('account number'), "equivelant_amount"),

                                DateTime::make(__('History'), 'Date')
                                    ->format('DD/MM/YYYY HH:mm')
                                    ->resolveUsing(function ($value) {
                                        return $value;
                                    })->rules('required'),

                                ]),
                    ])->dependsOn("Payment_type", '4')->hideFromDetail()->hideFromIndex(),

                    NovaDependencyContainer::make([
                        Flexible::make(__('Payment_type_details'), 'Payment_type_details')

                            ->addLayout(__('tooles'), 'Payment_type_details ', [
                                Text::make(__('value'), "equivelant_amount")->rules('required'),

                                Select::make(__('type'), "type")->options([
                                    '1' => 'paybox',
                                    '2' => 'bit',
                                    '3' => 'פייפאל',
                                ])->displayUsingLabels()->rules('required'),


                                DateTime::make(__('History'), 'Date')
                                    ->format('DD/MM/YYYY HH:mm')
                                    ->resolveUsing(function ($value) {
                                        return $value;
                                    })->rules('required'),

                            ]),
                    ])->dependsOn("Payment_type", '5')->hideFromDetail()->hideFromIndex(),

                    // BelongsTo::make(__('reference_id'), 'Alhisalat', \App\Nova\Alhisalat::class),


            Text::make(__('equivalent amount'), "equivelant_amount")->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('description'), 'description'),
            Date::make(__('date'), 'transaction_date'),

        ];
    }
    public static function beforeCreate(Request $request, $model)
    {

        $new = DB::table('currencies')->where('id', $request->Currency)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '1';
        $model->type = '2';
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
    public static function aftersave(Request $request, $model)
    {


        if (!$request->name) {
            // dd($request->add_user);
            if ($request->add_user[0]['attributes']['name'] &&    $request->add_user[0]['attributes']['email'] && $request->add_user[0]['attributes']['phone']) {
                DB::table('users')
                    ->insert(
                        [
                            'name' => $request->add_user[0]['attributes']['name'],
                            'email' =>  $request->add_user[0]['attributes']['email'],
                            'password' => '10203040',
                            'user_role' => 'company',
                            'phone' =>  $request->add_user[0]['attributes']['phone']
                        ],

                    );

            }
            $User =  \App\Models\User::where('email',  $request->add_user[0]['attributes']['email'])->first();
            DB::table('transactions')
            ->where('id', $model->id)
            ->update(['name' => $User->id]);
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
            new BillPdf,
        ];
    }
}
