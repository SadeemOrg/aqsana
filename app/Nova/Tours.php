<?php

namespace App\Nova;

use App\Models\TelephoneDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Acme\MultiselectField\Multiselect;
use App\Models\City;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Fields\BelongsToMany;

class Tours extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Tours::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Tours",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static function label()
    {
        return __('Tours');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
    public static function createButtonLabel()
    {
        return 'انشاء جولة';
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('name'), 'name')->rules('required'),
            Date::make(__('DATE'), 'date')->pickerDisplayFormat('d.m.Y')->rules('required'),
            Text::make(__('number_of_people'), 'number_of_people')->rules('required'),

            BelongsToManyField::make(__('Cities'), 'Cities', 'App\Nova\City')
            ->options(City::all())
            ->optionsLabel('name')
            ->hideFromIndex(),

            BelongsToMany::make('Cities'),

            BelongsTo::make(__('Contacts'), 'admin', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),

            Multiselect::make(__('Contacts'), "Contacts")
                ->options(function () {
                    $types =  TelephoneDirectory::whereJsonContains('type',  '6')->get();
                    $type_array =  array();
                    foreach ($types as $type) {
                        $type_array += [$type['id'] => ($type['name'])];
                    }

                    return $type_array;
                })->singleSelect()->hideFromDetail()->hideFromIndex(),



            Flexible::make(__('Contacts'), 'NewContacts')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('name'), 'name'),
                    Text::make(__('phone_number'), 'phone_number'),
                ]),


            BelongsTo::make(__('guide_name'), 'guide', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),

            Multiselect::make(__('tour_guide_name'), "guide_name")
                ->options(function () {
                    $types =  TelephoneDirectory::whereJsonContains('type',  '113')->get();
                    $type_array =  array();
                    foreach ($types as $type) {
                        $type_array += [$type['id'] => ($type['name'])];
                    }

                    return $type_array;
                })->singleSelect()->hideFromDetail()->hideFromIndex(),
            Flexible::make(__(''), 'NewGuide')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('name'), 'name'),
                    Text::make(__('phone_number'), 'phone_number'),
                ]),
            Text::make(__('start Time'), 'start_tour')
                ->placeholder('##:##')
                ->creationRules('date_format:"H:i"')
                ->help('hh:mm'),
            Text::make(__('end Time'), 'end_tour')
                ->placeholder('##:##')
                ->creationRules('date_format:"H:i"')
                ->help('hh:mm'),
            Textarea::make(__('note'), 'note'),
            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }
    protected static function afterValidation(NovaRequest $request, $validator)
    {

        if (!($request->NewGuide  || $request->guide_name)) {
            $validator->errors()->add('guide_name', ' يجب اضافة ');
        }

        if ($request->NewGuide  &&  empty(($request->guide_name))) {
            if (!isset($request->NewGuide[0]['attributes']['name'])) {
                $validator->errors()->add($request->NewGuide[0]['key'] . '__name', 'هذا الحقل مطلوب');
            }
        }
    }
    public static function beforeSave(Request $request, $model)
    {

        if (!$request->Contacts) {


            if ($request->NewContacts   && ($request->NewContacts[0]['attributes']['name'] || $request->NewContacts[0]['attributes']['phone_number'])) {

                $bookt = TelephoneDirectory::create([
                    'name' => $request->NewContacts[0]['attributes']['name'],
                    'phone_number' => $request->NewContacts[0]['attributes']['phone_number'],
                    'type' => 6
                ]);
                // $model->Contacts=$bookt->id;
                // $BookType =  \App\Models\BookType::orderBy('created_at', 'desc')->first();
                $request->merge(['Contacts' => $bookt->id]);
            }
        }
        $request->request->remove('NewContacts');
        if (!$request->guide_name) {


            if ($request->NewGuide   && ($request->NewGuide[0]['attributes']['name'] || $request->NewGuide[0]['attributes']['phone_number'])) {

                $bookt = TelephoneDirectory::create([
                    'name' => $request->NewGuide[0]['attributes']['name'],
                    'phone_number' => $request->NewGuide[0]['attributes']['phone_number'],
                    'type' => ["113"],
                ]);
                $request->merge(['guide_name' => $bookt->id]);
            }
        }
        $request->request->remove('NewGuide');
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
        return [];
    }
}
