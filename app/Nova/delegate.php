<?php

namespace App\Nova;

    use App\Nova\Filters\AreaDelegate;
    use Acme\MultiselectField\Multiselect;
    use App\Models\City;
use App\Nova\Actions\ExportDelegates;
use Illuminate\Http\Request;
    use Laravel\Nova\Fields\BelongsTo;
    use Laravel\Nova\Fields\ID;
    use Laravel\Nova\Http\Requests\NovaRequest;
    use Laravel\Nova\Fields\Text;
    use Techouse\SelectAutoComplete\SelectAutoComplete as Select;
    use AwesomeNova\Cards\FilterCard;
    use Illuminate\Support\Facades\DB;
    use Laravel\Nova\Fields\HasMany;
    use Titasgailius\SearchRelations\SearchesRelations;
    use Whitecube\NovaFlexibleContent\Flexible;

    class delegate extends Resource
    {

        use SearchesRelations;

        public static $searchRelations = [
            'AreaDelegate' => ['id', 'name'],
        ];

        public static function createButtonLabel()
        {
            return 'انشاء مندوب';
        }
        /**
         * The model the resource corresponds to.
         *
         * @var string
         */
        public static $model = \App\Models\TelephoneDirectory::class;
        public static function label()
        {
            return __('delegatee');
        }
        public static function group()
        {
            return __('QawafilAlaqsa');
        }
        public static function availableForNavigation(Request $request)
        {
            if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("delegatee",  $request->user()->userrole()))) {
                return true;
            } else return false;
        }
        /**
         * The single value that should be used to represent the resource when being displayed.
         *
         * @var string
         */
        public static $title = 'name';

        /**
         * The columns that should be searched.
         *
         * @var array
         */
        public static $search = [
            'id', 'name', 'phone_number', 'city'
        ];

        /**
         * Get the fields displayed by the resource.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array
         */

        public static function indexQuery(NovaRequest $request, $query)
        {
            return $query->whereJsonContains('type', '3');
        }
        public function fields(Request $request)
        {
            return [
                ID::make(__('ID'), 'id')->sortable(),

                Text::make(__('Name'), 'name')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make(__('email'), 'email')
                    ->sortable(),
                Text::make(__('phone_number'), 'phone_number'),
                Multiselect::make(__('Area'), 'Area')
                    ->options(function () {
                        $Areas =  \App\Models\Area::all();

                        $Area_type_admin_array =  array();

                        foreach ($Areas as $Area) {


                            $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                        }

                        return $Area_type_admin_array;
                    })->singleSelect()->hideFromIndex()->hideFromDetail(),
                BelongsTo::make(__('Area'), 'AreaDelegate', \App\Nova\Area::class)->hideWhenCreating()->hideWhenUpdating(),

                Multiselect::make(__('city'), 'city')
                    ->options(function () {
                        $Areas =  \App\Models\City::all();

                        $Area_type_admin_array =  array();

                        foreach ($Areas as $Area) {


                            $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                        }

                        return $Area_type_admin_array;
                    })->singleSelect()->hideFromIndex()->hideFromDetail(),

                BelongsTo::make(__('city'), 'citeDelegate', \App\Nova\City::class)->hideWhenCreating()->hideWhenUpdating(),
                Flexible::make(__('newcity'), 'newcity')
                    ->limit(1)
                    ->hideFromDetail()->hideFromIndex()
                    ->addLayout(__('Add new type'), 'type', [
                        Text::make(__('name'), 'name'),
                        Multiselect::make(__('admin'), 'admin_id')
                            ->options(function () {
                                $users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '3')->get();

                                $user_type_admin_array =  array();

                                foreach ($users as $user) {



                                    $user_type_admin_array += [$user['id'] => ($user['name'])];
                                }
                                return $user_type_admin_array;
                            })
                            ->singleSelect()
                            ->rules('required')->hideFromDetail()->hideFromIndex(),
                    ])->confirmRemove(),

                Select::make(__('jop'), 'jop')->options([
                    1 => __('مندوب رئيسي'),
                    2 => __('مندوب حصالات'),
                    3 => __('مندوب قوافل'),
                    4 => __('مساعد مندوب'),
                ])->displayUsingLabels(),
                HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

            ];
        }
        public static function beforeSave(Request $request, $model)
        {
            if (!$request->city) {


                if ($request->newcity   && ($request->newcity[0]['attributes']['name'] || $request->newcity[0]['attributes']['admin_id'])) {
                  $citye =  new City();

                    $citye-> name = $request->newcity[0]['attributes']['name'];
                    $citye->admin_id = $request->newcity[0]['attributes']['admin_id'];
                    $citye->Qawafil_admin = $request->newcity[0]['attributes']['admin_id'];
                    $citye->Alhisalat_admin = $request->newcity[0]['attributes']['admin_id'];
                    $citye->save();


                    $request->merge(['city' => $citye->id]);


                }
            }
            $request->request->remove('newcity');
        }
        public static function beforeCreate(Request $request, $model)
        {
            $model->type ="3";
        }
        public static function afterSave(Request $request, $model)
        {
            if (!$request->city) {

                // dd($request->NewContacts[0]['attributes']['admin_id']);
                if ($request->NewContacts   && ($request->NewContacts[0]['attributes']['name'] || $request->NewContacts[0]['attributes']['admin_id'])) {
                    $Citys = new  City();
                    $Citys->name = $request->NewContacts[0]['attributes']['name'];
                    $Citys->admin_id = '1';
                    $Citys->Qawafil_admin = '100';
                    $Citys->Alhisalat_admin = '100';
                    $Citys->save();

                    // $model->Contacts=$bookt->id;
                    // $BookType =  \App\Models\BookType::orderBy('created_at', 'desc')->first();

                    DB::table('telephone_directories')
                        ->where('id', $model->id)
                        ->update(['city' =>  $Citys->id]);
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
            return [
                new FilterCard(new AreaDelegate()),
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
                new AreaDelegate
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
                (new ExportDelegates)->standalone()->withoutConfirmation(),

            ];
        }
    }
