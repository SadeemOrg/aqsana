<?php

namespace App\Nova;

use App\Models\Alhisalat;
use App\Models\Donations;
use App\Nova\Actions\AlhisalatStatuscompleted;
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
use Acme\MultiselectField\Multiselect;
class receiptVoucher extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Alhisalat::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('Collect Alhisalat');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("receiptVoucherparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
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
    // public function authorizedToDelete(Request $request)
    // {
    //     return false;
    // }
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    // public  function authorizedToUpdate(Request $request)
    // {
    //     return false;
    // }
    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where([
            ['status', '>', 2],

        ]);
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__("number alhisala"), "number_alhisala")
            ->readonly()->hideWhenCreating()->hideWhenUpdating(),

            ActionButton::make(__('colect'))
            ->action((new AlhisalatStatuscompleted)->confirmText(__('Are you sure you want to Surrender  this Alhisalat?'))
                    ->confirmButtonText(__('colect')),
                $this->id
            )
            ->readonly(function () {
                return $this->status > '3';
            })->text(__('colect'))->showLoadingAnimation()
            ->loadingColor('#fff')->svg('VueComponentName')->hideWhenCreating()->hideWhenUpdating(),

            BelongsTo::make(__('saved addresss'), 'address', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),


            Multiselect::make(__("Status"), "status")->options([
                '1' => 'تم  الوضع',
                '2' => 'تم جمع ',
                '3' => 'تم التسليم',
                '4' => 'تم العد',
            ])->singleSelect()->hideWhenCreating()->hideWhenUpdating(),






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
        // return redirect('itsolutionstuff/tags');
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
            new AlhisalatStatuscompleted
        ];
    }
}
