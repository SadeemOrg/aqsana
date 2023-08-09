<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Models\BookType;
use App\Models\TelephoneDirectory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Whitecube\NovaFlexibleContent\Flexible;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\HasMany;

class events extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\events::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("eventsparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = "name";

    /**
     * The columns that should be searched.
     *
     * @var array
     */

    public static function label()
    {
        return __('events');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
    public static $priority = 3;
    public static $search = [
        'id', "name"
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
            Text::make(__('place'), 'place'),

            Textarea::make(__('note'), 'note'),
            Files::make(__('Multiple files'), 'file'),
            Text::make(__('Number of encounters'), 'number_of_encounters')->rules('required'),
            Date::make(__('first_event'), 'first_event')->pickerDisplayFormat('d.m.Y'),

            // File::make(__('file'),'file')->disk('public')->deletable(),
            Flexible::make(__('new event'), 'new_event')

                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new event'), 'type', [
                    Date::make(__('DATE'), 'events_date')->pickerDisplayFormat('d.m.Y'),
                ]),
            Text::make(__('start Time'), 'start_events_date')
                ->placeholder('##:##')
                ->rules('date_format:"H:i"')
                ->help('hh:mm'),
            Text::make(__('end Time'), 'end_events_date')
                ->placeholder('##:##')
                ->rules('date_format:"H:i"')
                ->help('hh:mm'),

            Text::make(__('Budget'), 'Budget')->rules('required'),

            BelongsTo::make(__('Contacts'), 'TelephoneDirectory', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),

            Multiselect::make(__('Contacts'), "Contacts")
                ->options(function () {
                    $types =  TelephoneDirectory::where('type', '=', '6')->get();
                    $type_array =  array();
                    foreach ($types as $type) {
                        $type_array += [$type['id'] => ($type['name'])];
                    }

                    return $type_array;
                })->hideFromDetail()->hideFromIndex()->singleSelect(),




            Flexible::make(__('Contacts'), 'NewContacts')
                ->limit(1)
                ->hideFromDetail()->hideFromIndex()
                ->addLayout(__('Add new type'), 'type', [
                    Text::make(__('name'), 'name'),
                    Text::make(__('phone_number'), 'phone_number'),
                ]),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)


        ];
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
