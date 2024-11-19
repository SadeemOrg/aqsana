<?php

namespace App\Providers;

use Acme\Bill\Bill;
use Illuminate\Support\Facades\Gate;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\User;
use App\Nova\Area;
use App\Nova\project;
use App\Nova\News;
use App\Nova\hisadAljameia;
use Acme\Projecs\Projecs;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use App\Models\Bus;
use Acme\MultiselectField\Multiselect;
use Acme\ReportRegulation\ReportRegulation;
use Averotech\Link\Link;
use Averotech\Tree\Tree;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\file;
use Laravel\Nova\Fields\Trix;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use \OptimistDigital\NovaSettings\NovaSettings;
use Whitecube\NovaFlexibleContent\Flexible;
use Illuminate\Support\Facades\Auth;
use Comodolab\Nova\Fields\Help\Help;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use App\Nova\Metrics\AlmuahadaSum;
use App\Nova\Metrics\DonationsSum;
use App\Nova\Metrics\InComeTransaction;
use App\Nova\Metrics\NewAlhisalat;
use App\Nova\Metrics\NewBus;
use App\Nova\Metrics\NewProject;
use App\Nova\Metrics\NewQawafilAlaqsa;
use App\Nova\Metrics\NewTrip;
use App\Nova\Metrics\OutComeTransaction;
use Chaseconey\ExternalImage\ExternalImage;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;
use Laravel\Nova\Fields\Boolean;
use Gwd\FlexibleContent\FlexibleContent;
use Manogi\Tiptap\Tiptap;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use Zeyad\Notification\Notification;
use Zeyad\Profile\Profile;
use Anaseqal\NovaImport\NovaImport;
use App\Nova\Metrics\CitySum;
use App\Nova\Metrics\DelegateSum;

class NovaServiceProvider extends NovaApplicationServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Nova::resources([
            User::class,

        ]);

        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });

        parent::boot();
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Tabs::make(__('Home page'), [
                Tab::make(
                    __('Navigation Bar'),
                    [
                        Tree::make(__('Items'), 'Items')->fields([
                            Text::make(__('Name'), 'name'),
                            Link::make(__('Link'), 'link')->resources([
                                Project::class,

                            ]),
                            Boolean::make(__('external link'), 'external_link')
                        ])->title('name'),
                        Image::make(__('Logo'), 'logo')->disk('public'),
                        Image::make(__('qawafelLogo'), 'qawafelLogo')->disk('public'),
                        Image::make(__('Header Logo Manzomeh'), 'Headerlogo')->disk('public'),
                        Image::make(__('Header qawafelLogo'), 'HeaderqawafelLogo')->disk('public'),


                    ]
                ),
                Tab::make(
                    __('pop up modal'),
                    [
                        Image::make(__('Image mobile'), 'image_mobile_pop_up')->disk('public'),
                        Image::make(__('Image web'), 'image_web_pop_up')->disk('public'),
                        Text::make(__('link'), 'link_pop_up'),
                        Text::make(__('button  text'), 'text_pop_up'),

                        Boolean::make(__('active'), 'active_pop_up')


                    ]
                ),
                Tab::make(
                    __('Heroo'),
                    [
                        FlexibleContent::make(__('Heroo'), 'Heroo')
                            ->addLayout(
                                [
                                    'label' => __('Heroo'),
                                    'name' => 'Heroo',
                                    'fields' => [
                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => __('Image'),

                                            'multiple' => false,
                                            'required' => true
                                        ],

                                        [
                                            'type' => 'text',
                                            'name' => 'image_alt_Heroo',
                                            'label' => __('image description'),
                                            'multiple' => false,
                                            'required' => false
                                        ],

                                        [
                                            'type' => 'text',
                                            'name' => 'link',
                                            'label' => __('button link'),
                                            'multiple' => false,
                                            'required' => false
                                        ]
                                    ]
                                ]
                            ),
                    ]
                ),
                Tab::make(
                    __('Banner 1'),
                    [
                        Image::make(__('main img'), 'main_img_Banner_1'),
                        Text::make(__('image description'), 'image_alt_Banner_1'),
                        Text::make(__('main text'), 'text_main_Banner_1'),
                        Text::make(__('sup text'), 'sup_text_Banner_1'),
                        Image::make(__('Logo'), 'logo_Banner_1')->disk('public'),
                        Text::make(__('text logo'), 'text_loga_Banner_1'),
                        Text::make(__('button  text'), 'text_bottom_Banner_1'),
                        Text::make(__('button  link'), 'link_bottom_Banner_1'),
                    ]
                ),
                Tab::make(
                    __('Projects News'),
                    [
                        Text::make(__('main text Projects News'), 'text_main_projects_news'),
                        FlexibleContent::make(__('Projects News'), 'Projects_News')
                            ->addLayout(
                                [
                                    'label' => __('Projects News'),
                                    'name' => 'Heroo',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'title',
                                            'label' => __('title'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'sup_title',
                                            'label' => __('sup_title'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => __('Image'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                    ]
                                ]
                            ),
                    ]
                ),
                Tab::make(
                    __('Banner 2'),
                    [
                        Image::make(__('main img'), 'main_img_Banner_2'),
                        Text::make(__('main text'), 'text_main_Banner_2'),
                        Text::make(__('sup text'), 'sup_text_Banner_2'),
                        Text::make(__('button  text'), 'text_view_bottom_Banner_2'),
                        Text::make(__('button  link'), 'link_view_bottom_Banner_2'),
                        // Text::make('bottom seen text ', 'text_seen_bottom_Banner_2'),
                        // Text::make('bottom seen link ', 'link_seen_bottom_Banner_2'),
                    ]
                ),
                Tab::make(
                    __('partner'),
                    [
                        FlexibleContent::make(__('partner'), 'partner')
                            ->addLayout(
                                [
                                    'label' => __('partner'),
                                    'name' => 'partner',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'title',
                                            'label' => __('title'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => __('Image'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'link',
                                            'label' => __('link'),
                                            'multiple' => false,
                                            'required' => false
                                        ],
                                    ]
                                ]
                            ),
                    ]
                ),

                Tab::make(
                    __('video'),
                    [
                        FlexibleContent::make(__('video'), 'videohome')
                            ->addLayout(
                                [
                                    'label' => __('video'),
                                    'name' => 'videohome',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'link',
                                            'label' => __('link'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'Title',
                                            'label' => __('title'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'image',
                                            'name' => 'cover',
                                            'label' => __('cover'),
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                    ]
                                ]
                            ),
                    ]
                ),

                Tab::make(__('footer'), [
                    Image::make(__('Logo'), 'footer_logo')->disk('public'),
                    Tree::make(__('Items'), 'Itemsfooter')->fields([
                        Text::make('Name'),
                        Link::make('Link')->resources([
                            User::class,
                            Area::class,
                        ])
                    ])->title('name'),
                ]),

            ]),
        ], [
            'heroo' => 'array',
            'flexible' => 'array',
            'Projects_News' => 'array',
            'partner' => 'array',
            'workplace' => 'array',
            'videohome' => 'array',
            // ...
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Tabs::make(__('workplace'), [
                Tab::make(__('workplace'), [
                    Text::make(__('main text'), 'text_main_workplace'),
                    Text::make(__('sup text'), 'sup_text_workplace'),
                    FlexibleContent::make(__('workplace'), 'workplace')
                        ->addLayout(
                            [
                                'label' => __('workplace'),
                                'name' => 'workplace',
                                'fields' => [
                                    [
                                        'type' => 'image',
                                        'name' => 'main_img_workplace',
                                        'label' => __('Image'),
                                        'multiple' => false,
                                        'required' => false
                                    ],
                                    [
                                        'type' => 'text',
                                        'name' => 'searsh_text_workplace',
                                        'label' => __('searsh text'),
                                        'multiple' => false,
                                        'required' => false
                                    ],
                                    [
                                        'type' => 'text',
                                        'name' => 'text_main_workplace',
                                        'label' => __('title'),
                                        'multiple' => false,
                                        'required' => false
                                    ],
                                    [
                                        'type' => 'text',
                                        'name' => 'sup_text_workplace',
                                        'label' => __('sup_title'),
                                        'multiple' => false,
                                        'required' => false
                                    ],
                                    [
                                        'type' => 'text',
                                        'name' => 'text_bottom_workplace_',
                                        'label' => __('button  text'),
                                        'multiple' => false,
                                        'required' => false
                                    ],

                                    [
                                        'type' => 'text',
                                        'name' =>  'link bottom',
                                        'label' => __('button link'),
                                        'multiple' => false,
                                        'required' => false
                                    ],
                                ]
                            ]
                        ),
                ]),

            ], [
                'workplace' => 'array',
            ])
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs(__('about us'), [
                __('main section')    => [
                    Text::make(__('title'), 'main_section_text'),
                    Textarea::make(__('sup text'), 'sup_text_main_aboutus'),
                    Image::make(__('IMAGE'), 'main_section_image'),
                    Text::make(__('image description'), 'image_alt_main_section_about_us'),
                ],
                __('our vision') => [
                    Text::make(__('title'), 'vision_section_text'),
                    Textarea::make(__('sup text'), 'sup_text_vision_aboutus'),
                    Image::make(__('IMAGE'), 'vision_section_image'),
                    Text::make(__('image description'), 'image_alt_our_vision_about_us'),

                ], __('Goals') => [
                    Flexible::make(__('Goals'), 'Goals')
                        ->addLayout(__('Goals'), 'wysiwyg', [
                            Text::make(__('title'), 'Goals_section_text'),
                            Text::make(__('sup text'), 'Goals_section_sup_text'),
                        ])
                ],
                __('achievements') => [
                    Image::make(__('IMAGE'), 'main_section_image_achievements'),
                    Text::make(__('image description'), 'image_alt_achievements_about_us'),

                    Flexible::make(__('achievements'), 'achievements')
                        ->addLayout(__('achievements'), 'wysiwyg', [
                            Text::make(__('title'), 'achievements_section_text'),
                        ])
                ],

            ]),
        ], [
            'workplaceabout' => 'array',
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs(__('Connect with us'), [
                __('Connect with us')    => [
                    Text::make(__('heder text'), 'heder_text_main_Connectus'),
                    Text::make(__('title'), 'text_main_Connectus'),
                    Text::make(__('sup text'), 'sup_text_main_Connectus'),
                    Text::make(__('phone'), 'phone_Connectus'),
                    Text::make(__('whatsapp'), 'whatsapp_Connectus'),
                    Text::make(__('Email'), 'email_Connectus'),
                    Text::make(__('address'), 'address'),

                    Text::make(__('button  text'), 'text_bottom_Connectus'),
                    Text::make(__('button  link'), 'linlk_bottom_Connectus'),
                ],
                __('FORM')    => [
                    Text::make(__('filed 1'), 'filed1_Connectus'),
                    Text::make(__('filed 2'), 'filed2_Connectus'),
                    Text::make(__('filed 3'), 'filed3_Connectus'),
                    Text::make(__('button  text'), 'text_form_Connectus'),
                ],
            ]),
        ]);


        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs(__('donations'), [
                Text::make(__('check box text'), 'checkbox_donation'),

            ]),
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs(__('work hours'), [
                __('Reasons to stop')    => [
                    Flexible::make(__('Reasons to stop'), 'Reasons_to_stop')
                        ->addLayout(__('Reasons to stop'), 'Reasons_to_stop', [
                            Text::make(__('title'), 'Reasons_to_stop'),
                        ])
                ],
                __('time departure')    => [
                    Flexible::make(__('time departure'), 'time_departure')
                        ->addLayout(__('time departure'), 'time_departure', [
                            Text::make(__('title'), 'title_departure'),
                            Text::make(__('time in minet'), 'time_departure'),
                        ])
                ],
                __('Summer time')    => [
                    Boolean::make(__('Summer time'), 'summer_time'),

                ],

            ]),
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs(__('vacations'), [
                __('Reasons to Vacations')    => [
                    Flexible::make(__('Reasons to Vacations'), 'Reasons_to_vacations')
                        ->addLayout(__('Reasons to Vacations'), 'Reasons_to_vacations', [
                            Text::make(__('title'), 'Reasons_to_vacations'),
                        ])
                ],


            ]),
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            if ($user->app_user!=1) {
                return true;
            }
        });
    }
    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [

            (new InComeTransaction())->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),
            (new OutComeTransaction())->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),

            (new   NewAlhisalat())->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),
            (new NewQawafilAlaqsa())
            ->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),
            (new DelegateSum())
            ->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),
            (new CitySum())
            ->canSee(function () {
                $user = Auth::user();
                if ($user->type() == 'admin') return true;
                return false;
            }),

            //'''''''''''''''


            // (new NewProject())
            //     ->canSee(function () {
            //         $user = Auth::user();
            //         if ($user->type() == 'admin') return true;
            //         return false;
            //     }),

            // (new   NewAlhisalat())->canSee(function () {
            //     $user = Auth::user();
            //     if ($user->type() == 'admin') return true;
            //     return false;
            // }),



        //


            // (new NewTrip())
            // ->canSee(function () {
            //     $user = Auth::user();
            //     if ($user->type() == 'admin') return true;
            //     return false;
            // }),

            // (new DonationsSum())->canSee(function () {
            //     $user = Auth::user();
            //     if ($user->type() == 'admin') return true;
            //     return false;
            // }),
            // (new AlmuahadaSum())->canSee(function () {
            //     $user = Auth::user();
            //     if ($user->type() == 'Almuahada_admin') return true;
            //     return false;
            // }),
        ];
    }
    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }
    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

            (new NovaSettings)->canSee(function ($request) {
                if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("NovaSettings",  $request->user()->userrole()))) {
                    return true;
                } else return false;
            }),
            new ReportRegulation,

            (new \Infinety\Filemanager\FilemanagerTool())->canSee(function ($request) {
                if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("FilemanagerTool",  $request->user()->userrole()))) {
                    return true;
                } else return false;
            }),

            // ( new NovaSettings)->canSee(function ($request) {
            //     $user = Auth::user();
            //     return  ($user->type() == 'website_admin' ) ;
            // }),
            (new projecs)->canSee(function ($request) {
                if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("budjet",  $request->user()->userrole()))) {
                    return true;
                } else return false;
            }),
            new Notification,
            new Bill,
            new NovaImport,
        ];
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginController::class, \App\Http\Controllers\LoginController::class);
    }
}
