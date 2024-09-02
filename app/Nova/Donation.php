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
        'id', 'name', 'transaction_date', 'equivelant_amount'

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

            ID::make(__('ID'), 'id')->sortable(),

        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {

        $data = json_decode($request->ref_id, true);
        if (!((isset($data['key2']) && !empty($data['key2'])) || $request->newproject)) {
            $validator->errors()->add('ref_id', 'يجب اضافة مشروع');
        }
        if ($request->newproject  &&  empty(json_decode($request->ref_id)->key2)) {



            //
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
        }

        if (!($request->name || $request->add_user)) {
            $validator->errors()->add('name', 'يجب اضافة شركة');
        }
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/bill?location=' . $resource->id . '&type=1';
    }


    public static function beforeCreate(Request $request, $model)
    {



        $id = Auth::id();
        $model->created_by = $id;
        $model->transaction_type = '1';
        $model->main_type = '1';
        $model->type = '2';

        $largestBillNumber = Transaction::where([
            ['main_type', 1],
            ['type', 2],
            ['is_delete', '<>', '2'],
        ])
            ->orderBy('bill_number', 'desc')
            ->value('bill_number');
        if (is_null($largestBillNumber)) {
            $largestBillNumber = 999;
        }
        $model->bill_number = $largestBillNumber + 1;

        if ($request->Payment_type==4) $model->transaction_status = '3';
        elseif ($request->ReceiveDonation == 1 && $request->Payment_type!=4) $model->transaction_status = '2';
        else  $model->transaction_status = '1';
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
        if ($request->Payment_type==4) $model->transaction_status = '3';
        elseif ($request->ReceiveDonation == 1 && $request->Payment_type!=4) $model->transaction_status = '2';
        else  $model->transaction_status = '1';
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

            #  // $model->equivelant_amount
        } elseif ($request->Payment_type == '4') {
            $model->transact_amount = 0;
            $amount = 0;
            foreach ($request->Payment_type_details as $key => $value) {

                $amount += $value['attributes']['equivelant_amount'];
            }

            $model->equivelant_amount = $amount;
        }
    }
    public static function aftersave(Request $request, $model)
    {
        if (!$request->name && !$request->add_user) {
            DB::table('transactions')
                ->where('id', $model->id)
                ->update(['name' => 192]);
        }
        if (!$request->name && $request->add_user) {
            if ($request->add_user[0]['attributes']['name']) {
                $telfone =  TelephoneDirectory::create(
                    [
                        'name' => $request->add_user[0]['attributes']['name'],
                        'type' => '2',
                        'phone_number' =>  $request->add_user[0]['attributes']['phone']
                    ],
                );
            }
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
            (new DeleteBill)->onlyOnDetail(),
            (new PrintBill)->withoutConfirmation(),
            (new ExportDonations)->standalone(),
        ];
    }
}
