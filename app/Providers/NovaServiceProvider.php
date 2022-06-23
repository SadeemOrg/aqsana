<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\User;
use App\Nova\Area;
use App\Nova\project;
use App\Nova\News;
use Acme\Projecs\Projecs;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use App\Models\Bus;
use Acme\MultiselectField\Multiselect;
use Averotech\Link\Link;
use Averotech\Tree\Tree;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\file;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use \OptimistDigital\NovaSettings\NovaSettings;
use Whitecube\NovaFlexibleContent\Flexible;
use Illuminate\Support\Facades\Auth;
use Comodolab\Nova\Fields\Help\Help;
use Ajhaupt7\ImageUploadPreview\ImageUploadPreview;
use Chaseconey\ExternalImage\ExternalImage;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;
use Laravel\Nova\Fields\Boolean;
use Gwd\FlexibleContent\FlexibleContent;

class NovaServiceProvider extends NovaApplicationServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {

        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });

        parent::boot();

        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Tabs::make('Home', [
                Tab::make(
                    'navbar ',
                    [
                        Tree::make('Items', 'Items')->fields([
                            Text::make('Name'),
                            Link::make('Link')->resources([
                                News::class,
                                project::class,

                            ])
                        ])->title('name'),

                        Image::make('Logo', 'logo')->disk('public'),




                    ]
                ),
                Tab::make(
                    'Heroo ',
                    [

                        FlexibleContent::make('Heroo', 'Heroo')
                            ->addLayout(
                                [
                                    'label' => 'Heroo',
                                    'name' => 'Heroo',
                                    'fields' => [
                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => 'Image',
                                            'multiple' => false,
                                            'required' => true
                                        ]
                                    ]
                                ]
                            ),



                    ]
                ),
















                //     ]
                // ),

                Tab::make(
                    'Banner 1',
                    [
                        Image::make('main img', 'main_img_Banner_1'),
                        Text::make('main text', 'text_main_Banner_1'),
                        Text::make('sup text ', 'sup_text_Banner_1'),
                        Image::make('Logo', 'logo_Banner_1')->disk('public'),
                        Text::make('text logo', 'text_loga_Banner_1'),
                        Text::make('bottom  text ', 'text_bottom_Banner_1'),
                        Text::make('bottom  link ', 'link_bottom_Banner_1'),





                    ]
                ),
                Tab::make(
                    'Projects News',
                    [
                        FlexibleContent::make('Projects_News', 'Projects_News')
                            ->addLayout(
                                [
                                    'label' => 'Heroo',
                                    'name' => 'Heroo',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'title',
                                            'label' => 'title',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'sup_title',
                                            'label' => 'sup_title',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => 'Image',
                                            'multiple' => false,
                                            'required' => true
                                        ],

                                    ]
                                ]
                            ),
                    ]
                ),

                Tab::make(
                    'Banner 2',
                    [
                        Image::make('main img', 'main_img_Banner_2'),
                        Text::make('main text', 'text_main_Banner_2'),
                        Text::make('sup text ', 'sup_text_Banner_2'),

                        Text::make('bottom view  text ', 'text_view_bottom_Banner_2'),
                        Text::make('bottom view link ', 'link_view_bottom_Banner_2'),

                        Text::make('bottom seen text ', 'text_seen_bottom_Banner_2'),
                        Text::make('bottom seen link ', 'link_seen_bottom_Banner_2'),





                    ]
                ),
                Tab::make(

                    'partner',
                    [
                        FlexibleContent::make('partner', 'partner')
                            ->addLayout(
                                [
                                    'label' => 'partner',
                                    'name' => 'partner',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'title',
                                            'label' => 'title',
                                            'multiple' => false,
                                            'required' => true
                                        ],

                                        [
                                            'type' => 'image',
                                            'name' => 'image',
                                            'label' => 'Image',
                                            'multiple' => false,
                                            'required' => true
                                        ],

                                    ]
                                ]
                            ),






                    ]
                ),
                Tab::make(
                    'Our central work place ',
                    [
                        Text::make('main text', 'text_main_workplace'),
                        Text::make('sup text ', 'sup_text_workplace'),



                        FlexibleContent::make('workplace', 'workplace')
                            ->addLayout(
                                [
                                    'label' => 'workplace',
                                    'name' => 'workplace',
                                    'fields' => [
                                        [
                                            'type' => 'image',
                                            'name' => 'main_img_workplace',
                                            'label' => 'Image',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'text_main_workplace',
                                            'label' => 'title',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'sup_text_workplace',
                                            'label' => 'sup title',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'text',
                                            'name' => 'text_bottom_workplace_',
                                            'label' => 'text bottom_',
                                            'multiple' => false,
                                            'required' => true
                                        ],  [
                                            'type' => 'text',
                                            'name' => 'link_bottom_workplace_',
                                            'label' => 'link bottom',
                                            'multiple' => false,
                                            'required' => true
                                        ],




                                    ]
                                ]
                            ),







                    ]
                ),
                Tab::make(
                    'Connect with us',
                    [
                        Text::make('heder text', 'heder_text_main_Connect'),
                        Text::make('main text', 'text_main_Connect'),
                        Text::make('sup text text', 'sup_text_main_Connect'),
                        Text::make('phone', 'phone_Connect'),
                        Text::make('Email', 'email_Connect'),
                        Text::make('Text bottome', 'text_bottom_Connect'),
                        Text::make('linl bottom', 'linl_bottom'),

                        Text::make('filed 1 ', 'filed1_Connect'),
                        Text::make('filed 2 ', 'filed2_Connect'),
                        Text::make('filed 3 ', 'filed3_Connect'),
                        Text::make('text form bottom', 'text_form_Connect'),








                    ]
                ),

                Tab::make('footer', [

                    Image::make('Logo', 'footer_logo')->disk('public'),

                    Tree::make('Items (EN)', 'Itemsfooter')->fields([
                        Text::make('Name'),
                        Link::make('Link')->resources([
                            User::class,
                            Area::class,

                        ])
                    ])->title('name'),

                ]),
                Tab::make('footer', []),


            ]),
        ], [
            'heroo' => 'array',
            'flexible' => 'array',
            'Projects_News' => 'array',
            'partner' => 'array',
            'workplace' => 'array',
            // ...
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs('who are we', [
                'main section'    => [
                    Text::make('text', 'main_section_text'),
                    Image::make('image', 'main_section_image'),
                ],
                ' our vision' => [

                    Text::make('text', 'vision_section_text'),
                    Image::make('image', 'vision_section_image'),

                ], ' Goals' => [
                    Flexible::make('Goals')
                        ->addLayout('Simple content section', 'wysiwyg', [
                            Text::make('text', 'Goals_section_text'),
                            Text::make('sup text', 'Goals_section_sup_text'),

                        ])



                ],
                ' achievements' => [
                    Image::make('image', 'main_section_image'),
                    Flexible::make('achievements')
                        ->addLayout('Simple content section', 'wysiwyg', [
                            Text::make('text', 'achievements_section_text'),

                        ])



                ],
                ' workplace' => [
                    Text::make('text', 'main_section_image'),
                    Flexible::make('achievements')
                        ->addLayout('Simple content section', 'wysiwyg', [
                            Image::make('main img', 'main_img_workplace'),
                            Text::make('main text', 'text_main_workplace'),
                            Text::make('sup text', 'sup_text_workplace'),

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
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [];
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

            new NovaSettings,
            // ( new NovaSettings)->canSee(function ($request) {
            //     $user = Auth::user();
            //     return  ($user->type() == 'website_admin' ) ;
            // }),
            // new projecs

        ];
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
