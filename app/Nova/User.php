<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\TelephoneDirectory;
use App\Nova\Actions\ExportUsers;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Userparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static function groupOrder()
    {
        return 5;
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $priority = 1;
    public static $title = 'name';
    public static function label()
    {
        return __('Administrative users');
    }
    public static function group()
    {
        return __('Public Administration');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];
    public static function createButtonLabel()
    {
        return 'انشاء مستخدم';
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function indexQuery(NovaRequest $request, $query)
    {

        $query->where(function ($query) {
            $query->whereNull('app_user')
                ->orWhere('app_user', '<>', '1');
        });
    }
    public function fields(Request $request)
    {
        $TelephoneDirectory = TelephoneDirectory::find($request->viaResourceId);
        return [
            ID::make(__('ID'), 'id')->sortable(),

            // Gravatar::make()->maxWidth(50),
            Text::make(__('id_number'), 'id_number')
                ->sortable()->rules('required', 'max:255'),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->withMeta(['value' => $TelephoneDirectory ? $TelephoneDirectory->name : '']),

            Text::make(__('email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->withMeta(['value' => $TelephoneDirectory ? $TelephoneDirectory->email : '']),



            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),



            Number::make(__('Phone'), 'phone')
                ->textAlign('left')
                ->withMeta(['value' => $TelephoneDirectory ? $TelephoneDirectory->phone_number : '']),
            Date::make(__('Birth Date'), 'birth_date'),
            Image::make(__('photo'), 'photo')->disk('public'),
            Multiselect::make(__('city'), 'city')
                ->options(function () {
                    $Areas =  \App\Models\City::all();

                    $Area_type_admin_array =  array();

                    foreach ($Areas as $Area) {


                        $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                    }

                    return $Area_type_admin_array;
                })->singleSelect()->hideFromIndex()->hideFromDetail()

                ->withMeta(['value' => $TelephoneDirectory ? $TelephoneDirectory->city : '']),
            BelongsTo::make(__('city'), 'citeDelegate', \App\Nova\City::class)->hideWhenCreating()->hideWhenUpdating()->nullable(),
            BelongsTo::make(__('Role_user'), 'Role', \App\Nova\Role::class),

            Text::make(__('jop'), 'job')
                ->sortable(),
            Multiselect::make(__('Permations'), 'role')
                ->options(
                    [
                        "super-admin" => __("Super Admin"),
                        "Userparmation" => __("Userparmation"),
                        "addressparmation" => __("addressparmation"),
                        "Alhisalatparmation" => __("Alhisalatparmation"),
                        "Areaparmation" => __("Areaparmation"),
                        "Bookparmation" => __("Bookparmation"),
                        "BusesCompanyparmation" => __("BusesCompanyparmation"),
                        "Cityparmation" => __("Cityparmation"),
                        "Currencyparmation" => __("Currencyparmation"),
                        "Donationparmation" => __("Donationparmation"),
                        "eventsparmation" => __("eventsparmation"),
                        "FormMassageparmation" => __("FormMassageparmation"),
                        "Newsparmation" => __("Newsparmation"),
                        "Notificationparmation" => __("Notificationparmation"),
                        "PaymentVoucherparmation" => __("PaymentVoucherparmation"),
                        "projectparmation" => __("projectparmation"),
                        "ProjectNewsparmation" => __("ProjectNewsparmation"),
                        "QawafilAlaqsaparmation" => __("QawafilAlaqsaparmation"),
                        "AppUserparmation" => __("AppUserparmation"),
                        "receiptVoucherparmation" => __("receiptVoucherparmation"),
                        "Reportsparmation" => __("Reportsparmation"),
                        "Sectorparmation" => __("Sectorparmation"),
                        "TelephoneDirectoryparmation" => __("TelephoneDirectoryparmation"),
                        "Volunteerparmation" => __("Volunteerparmation"),
                        "volunteersHowerparmation" => __("volunteersHowerparmation"),
                        "volunteersProjectsparmation" => __("volunteersProjectsparmation"),
                        "EventsArchiveparmation" => __("EventsArchiveparmation"),
                        "budjet" => __("budjet"),
                        "FilemanagerTool" => __("FilemanagerTool"),
                        "NovaSettings" => __("Settings"),
                        "delegatee" => __("delegatee"),
                        "Tours" => __("Tours"),
                        "TripBooking" => __("TripBooking"),
                        "delegatee" => __("delegatee"),
                        "guide" => __("guide"),
                        "sms" => __("Sms"),
                        "Reportparmation" => __("Reportparmation"),
                        "addressTypesparmation" => __("addressTypesparmation"),




                    ]
                )->saveAsJSON()->rules('required'),

            Date::make(__('start_work_date'), 'start_work_date'),
            Select::make(__('martial_status'), 'martial_status')->options([
                1 => __('single'),
                2 => __('married'),
                4 => __('engaged'),
                5 => __('divorced'),
                6 => __('widower'),


            ])->displayUsingLabels(),
            Text::make(__('user_number'), 'user_number')
                ->sortable(),
            Text::make(__('bank_name'), 'bank_name')
                ->sortable(),
            Text::make(__('bank_branch'), 'bank_branch')
                ->sortable(),
            Text::make(__('account_number'), 'account_number')
                ->sortable(),
            // BelongsTo::make('City'),



            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)


        ];
    }
    public static function beforeSave(Request $request, $model)
    {
        $telephoneDirectory = TelephoneDirectory::find($request->viaResourceId);
        if ($telephoneDirectory) {
            $telephoneDirectory->is_user = 1;
            $telephoneDirectory->save();
        }
        $model->user_role = 1;
        $model->app_user = 0;
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

            (new ExportUsers)->standalone()->withoutConfirmation(),

        ];
    }
}
