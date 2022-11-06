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
use Laravel\Nova\Actions\Action;
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
        return __('Alhisalat');
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

        return $query->where([
            ['main_type', 1],
            ['type', 1]
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






        ];
    }
    public static function beforeCreate(Request $request, $model)
    {

        $new = DB::table('currencies')->where('id', $request->Currency)->first();
        $id = Auth::id();
        $model->created_by = $id;
        $model->main_type = '1';
        $model->type = '1';
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
        return redirect('itsolutionstuff/tags');
        // dd($request->add_user);
        if (!$request->name) {
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
            $model->name =  $User->id;
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
