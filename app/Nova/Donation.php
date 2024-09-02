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

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [

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

        ];
    }
}
