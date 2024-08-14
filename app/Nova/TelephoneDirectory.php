<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use Acme\Smssend\Smssend;
use App\Models\SmsType;
use App\Nova\Filters\Reportcity;
use App\Nova\Filters\UserType;
use AwesomeNova\Cards\FilterCard;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Ncus\InlineIndex\InlineIndex;
use OptimistDigital\NovaDetachedFilters\NovaDetachedFilters;

class TelephoneDirectory extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $title = 'name';

    public static $model = \App\Models\TelephoneDirectory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function createButtonLabel()
    {
        return 'انشاء مستخدم';
    }
    public static function label()
    {
        return __('SMS');
    }
    public static function group()
    {
        return __('address');
    }

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("TelephoneDirectoryparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'phone_number', 'email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('name'), 'name')
                ->sortable()
                ->creationRules('unique:telephone_directories', 'required', 'max:255'),

            Text::make(__('email'), 'email')
                ->sortable(),
            Multiselect::make(__('type'), 'type')
                ->options(function () {
                    $Areas =  \App\Models\SmsType::all();

                    $Area_type_admin_array =  array();

                    foreach ($Areas as $Area) {


                        $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                    }

                    return $Area_type_admin_array;
                })->saveAsJSON()->hideFromIndex(),
            // Text::make(__('type'),'type'),
            //     ->options([
            //     1 => __('متبرعين سجب ثابت'),
            //     2 => __('متبرعين لمرة واحدة '),
            //     3 => __('مندوبين'),
            //     4 => __('متطوعين'),
            //     5 => __('جهات اتصال عامة'),
            //     6 => __('مرشدين'),
            //     7 => __('منح'),
            //     8 => __('شركات'),
            //     9 => __('Sms'),
            //     10 => __('Test'),


            // ])

            Flexible::make(__('newType'), 'newType')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('name'), 'name'),
                    Text::make(__('describtion'), 'describtion'),

                ]),

            InlineIndex::make(__('phone_number'), 'phone_number')
                ->options([
                    'event' => 'blur',
                    'type' => 'text',
                ])->sortable(),

            Multiselect::make(__('city'), 'city')
                ->options(function () {
                    $Areas =  \App\Models\City::all();

                    $Area_type_admin_array =  array();

                    foreach ($Areas as $Area) {


                        $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                    }

                    return $Area_type_admin_array;
                })->singleSelect()->hideFromIndex()->hideFromDetail(),
            BelongsTo::make(__('city'), 'citeDelegate', \App\Nova\City::class)->hideWhenCreating()->hideWhenUpdating()->nullable(),

            // Text::make(__('phone_number'), 'phone_number')->rules('unique:telephone_directories'),

            Text::make(__('note'), 'note')->hideFromIndex(),
            Text::make(__('jop'), 'jop')->hideFromIndex(),
            Text::make(__('id_number'), 'id_number')->hideFromIndex(),


            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class),

            Date::make(__('birth_date'), 'birth_date')->pickerDisplayFormat('d.m.Y')->sortable()->hideFromIndex(),



        ];
    }
    public static function beforeSave(Request $request, $model)
    {

        if (!$request->type) {


            if ($request->newType   && ($request->newType[0]['attributes']['name'] || $request->newType[0]['attributes']['describtion'])) {
                $SmsType =  new SmsType();

                $SmsType->name = $request->newType[0]['attributes']['name'];
                $SmsType->describtion = $request->newType[0]['attributes']['describtion'];
                $SmsType->save();

                // $request->type=$SmsType->id;
                $request->merge(['type' => "[" . $SmsType->id . "]"]);
                //   dd( $request->type);

            }
        }

        $request->request->remove('newType');

        $phoneNumber = $request->input('phone_number');

        if ($phoneNumber) {
            $phoneNumber = str_replace('-', '', $phoneNumber);
            $phoneNumber = preg_replace('/^\+972/', '0', $phoneNumber);
            $phoneNumber = preg_replace('/^\+970/', '0', $phoneNumber);
            $phoneNumber = preg_replace('/^\0970/', '0', $phoneNumber);
            $phoneNumber = preg_replace('/^\0972/', '0', $phoneNumber);

            $request->merge(['phone_number' => $phoneNumber]);
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
            new Smssend(),
            (new NovaDetachedFilters([
                (new UserType())->withMeta(['width' => 'w-full']),
            ]))->width('full'),
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
            new UserType,
            new Reportcity(),

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
            (new Actions\ImportTelephoneDirectory)->standalone(),
        ];
    }
}
