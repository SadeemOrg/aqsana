<?php

namespace App\Nova;

use App\Models\TelephoneDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

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
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("Tours",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    public static function label()
    {
        return __('Tours');
    }
    public static function group()
    {
        return __('Cultural Section');
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
            Text::make(__('name'),'name')->rules('required'),
            Date::make(__('DATE'), 'date')->pickerDisplayFormat('d.m.Y')->rules('required'),
            Text::make(__('number_of_people'),'number_of_people')->rules('required'),
            Select::make(__('Contacts'), "Contacts")
            ->options(function () {
                $types =  TelephoneDirectory::where('type', '=', '6')->get();
                $type_array =  array();
                foreach ($types as $type) {
                    $type_array += [$type['id'] => ($type['name'])];
                }

                return $type_array;
            })->displayUsingLabels() ->hideFromDetail()->hideFromIndex(),



            Flexible::make(__('Contacts'), 'NewContacts')
            ->readonly(true)
            ->hideFromDetail()->hideFromIndex()
            ->addLayout(__('Add new type'), 'type', [
                Text::make(__('name'), 'name'),
                Text::make(__('phone_number'), 'phone_number'),
            ]),
            Text::make(__('guide_name'),'guide_name')->rules('required'),
            Date::make(__('start Time'), 'start_tour')->pickerDisplayFormat('d.m.Y')->rules('required'),
            Date::make(__('end Time'), 'end_tour')->pickerDisplayFormat('d.m.Y')->rules('required'),
            Textarea::make(__('note'),'note'),
        ];
    }
    public static function afterSave(Request $request, $model)
    {

        if (!$request->Contacts) {


            if ($request->NewContacts   &&($request->NewContacts[0]['attributes']['name'] || $request->NewContacts[0]['attributes']['phone_number'])) {

                $bookt= TelephoneDirectory::create([
                    'name' => $request->NewContacts[0]['attributes']['name'],
                    'phone_number' => $request->NewContacts[0]['attributes']['phone_number'],
                    'type'=>6
                ]);
                // $model->Contacts=$bookt->id;
                // $BookType =  \App\Models\BookType::orderBy('created_at', 'desc')->first();

                DB::table('events')
                ->where('id', $model->id)
                ->update(['Contacts' => $bookt->id]);


            }
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
        return [];
    }
}
