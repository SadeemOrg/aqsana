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
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Laravel\Nova\Fields\Image;
use \OptimistDigital\NovaSettings\NovaSettings;
use Whitecube\NovaFlexibleContent\Flexible;
use Illuminate\Support\Facades\Auth;
use Comodolab\Nova\Fields\Help\Help;

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
                        Flexible::make('heroo', 'heroo')
                            ->addLayout('Simple content section', 'heroo', [
                                Image::make('img'),

                            ])






                    ]
                ),
                // Tab::make(
                //     'Sup Heroo ',
                //     [
                //         Flexible::make('supheroo')
                //             ->addLayout('Simple content section', 'wysiwyg', [
                //                 Text::make('Text'),
                //                 Text::make('SupText'),
                //                 Image::make('img'),


                //             ])






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
                        Flexible::make('Projects News','ProjectsNews')
                            ->addLayout('Simple content section','ProjectsNews', [
                                Text::make('main text', 'text_main'),
                                Text::make('sup text ', 'sup_text'),
                                Image::make('img'),

                            ])
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
                        Flexible::make('partner','partner')
                            ->addLayout('Simple content section', 'partner', [
                                Image::make('img'),
                                text::make('link'),

                            ])






                    ]
                ),
                Tab::make(
                    'Our central work place ',
                    [
                        Text::make('main text', 'text_main_workplace'),
                        Text::make('sup text ', 'sup_text_workplace'),


                        Flexible::make('heroo', 'workplace')
                        ->addLayout('Simple content section', 'workplace', [
                            Image::make('main img ', 'main_img_workplace_'),
                            Text::make('main text ', 'text_main_workplace_'),
                            Text::make('sup text ', 'sup_text_workplace'),
                            Text::make('bottom  text ', 'text_bottom_workplace_'),
                            Text::make('bottom  link ', 'link_bottom_workplace_'),

                        ]),



                        // Image::make('main img 1', 'main_img_workplace_1'),
                        // Text::make('main text 1', 'text_main_workplace_1'),
                        // Text::make('sup text 1', 'sup_text_workplace_1'),
                        // Text::make('bottom  text 1', 'text_bottom_workplace_1'),
                        // Text::make('bottom  link 1', 'link_bottom_workplace_1'),


                        // Image::make('main img 2', 'main_img_workplace_2'),
                        // Text::make('main text 2', 'text_main_workplace_2'),
                        // Text::make('sup text 2', 'sup_text_workplace_2'),
                        // Text::make('bottom  text 2', 'text_bottom_workplace_2'),
                        // Text::make('bottom  link 2', 'link_bottom_workplace_2'),


                        // Image::make('main img 3', 'main_img_workplace_3'),
                        // Text::make('main text 3', 'text_main_workplace_3'),
                        // Text::make('sup text 3', 'sup_text_workplace_3'),
                        // Text::make('bottom  text 3', 'text_bottom_workplace_3'),
                        // Text::make('bottom  link 3', 'link_bottom_workplace_3'),



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

        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs('website Settings', [
                'website SEO'    => [
                    Text::make('Site name', 'Site_name')->help('enter the site name'),
                    Text::make('Site description', 'Site_description'),
                    Text::make('Site keywords', 'Site_keywords'),
                    Text::make('Open Graph site name', 'og_site_name'),
                    Text::make('Open Graph description', 'og_description'),
                    Image::make('Open Graph image', 'og_image'),



                ],
                'website Soshal Midia ' => [
                    Text::make('Facebook', 'Facebook'),
                    Text::make('Instagram', 'Instagram'),
                    Text::make('whatsapp', 'whatsapp'),
                    Text::make('youtube', 'youtube'),


                ], 'website settings' => [
                    Text::make('phone', 'phone'),
                    Text::make('email', 'email'),
                    Text::make('address', 'address'),



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
