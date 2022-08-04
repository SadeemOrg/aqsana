<?php

namespace App\Providers;

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
use Chaseconey\ExternalImage\ExternalImage;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\ActionHasDependencies;
use Laravel\Nova\Fields\Boolean;
use Gwd\FlexibleContent\FlexibleContent;
use Manogi\Tiptap\Tiptap;

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
                            Link::make('Link')->resources([])
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
                                        ],

                                        [
                                            'type' => 'text',
                                            'name' => 'image_alt_Heroo',
                                            'label' => 'image description',
                                            'multiple' => false,
                                            'required' => true
                                        ]
                                    ]
                                ]
                            ),
                    ]
                ),
                Tab::make(
                    'Banner 1',
                    [
                        Image::make('main img', 'main_img_Banner_1'),
                        Text::make('image description ', 'image_alt_Banner_1'),
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
                        Text::make('main text Projects News', 'text_main_projects_news'),
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
                        // Text::make('bottom seen text ', 'text_seen_bottom_Banner_2'),
                        // Text::make('bottom seen link ', 'link_seen_bottom_Banner_2'),
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
                    'video',
                    [
                        FlexibleContent::make('video', 'videohome')
                            ->addLayout(
                                [
                                    'label' => 'video',
                                    'name' => 'videohome',
                                    'fields' => [
                                        [
                                            'type' => 'text',
                                            'name' => 'link',
                                            'label' => 'link',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                        [
                                            'type' => 'image',
                                            'name' => 'cover',
                                            'label' => 'cover',
                                            'multiple' => false,
                                            'required' => true
                                        ],
                                    ]
                                ]
                            ),
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
            Tabs::make('workplace', [
                Tab::make('workplace', [
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
                            'required' => false
                        ],
                        [
                            'type' => 'text',
                            'name' => 'searsh_text_workplace',
                            'label' => 'searsh text',
                            'multiple' => false,
                            'required' => false
                        ],
                        [
                            'type' => 'text',
                            'name' => 'text_main_workplace',
                            'label' => 'title',
                            'multiple' => false,
                            'required' => false
                        ],
                        [
                            'type' => 'text',
                            'name' => 'sup_text_workplace',
                            'label' => 'sup title',
                            'multiple' => false,
                            'required' => false
                        ],
                        [
                            'type' => 'text',
                            'name' => 'text_bottom_workplace_',
                            'label' => 'text bottom_',
                            'multiple' => false,
                            'required' => false
                        ],
                        [
                            'type' => 'text',
                            'name' => 'valuo00',
                            'label' => 'Image',
                            'multiple' => false,
                            'required' => false,
                            'value' => '3487'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'link_bottom_workplace_',
                            'label' => 'link bottom',
                            'multiple' => false,
                            'required' => false
                        ],
                    ]
                ]
            ),]),

        ], [
            'workplace' => 'array',
        ])
    ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs('about us', [
                'main section'    => [
                    Text::make('text', 'main_section_text'),
                    Textarea::make('sup text', 'sup_text_main_aboutus'),
                    Image::make('image', 'main_section_image'),
                    Text::make('image description', 'image_alt_main_section_about_us'),
                ],
                'our vision' => [
                    Text::make('text', 'vision_section_text'),
                    Textarea::make('sup text', 'sup_text_vision_aboutus'),
                    Image::make('image', 'vision_section_image'),
                    Text::make('image description', 'image_alt_our_vision_about_us'),

                ], ' Goals' => [
                    Flexible::make('Goals')
                        ->addLayout('Simple content section', 'wysiwyg', [
                            Text::make('text', 'Goals_section_text'),
                            Text::make('sup text', 'Goals_section_sup_text'),
                        ])
                ],
                ' achievements' => [
                    Image::make('image', 'main_section_image_achievements'),
                    Text::make('image description', 'image_alt_achievements_about_us'),

                    Flexible::make('achievements')
                        ->addLayout('Simple content section', 'wysiwyg', [
                            Text::make('text', 'achievements_section_text'),
                        ])
                ],

            ]),
        ], [
            'workplaceabout' => 'array',
        ]);
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            new Tabs('Connect with us', [
                'Connect with us'    => [

                    Text::make('heder text', 'heder_text_main_Connectus'),
                    Text::make('main text', 'text_main_Connectus'),
                    Text::make('sup text text', 'sup_text_main_Connectus'),
                    Text::make('phone', 'phone_Connectus'),
                     Text::make('whatsapp', 'whatsapp_Connectus'),
                    Text::make('Email', 'email_Connectus'),
                    Text::make('Text bottome', 'text_bottom_Connectus'),
                    Text::make('linlk bottom', 'linlk_bottom_Connectus'),
                ],
                'FORM'    => [
                    Text::make('filed 1 ', 'filed1_Connectus'),
                    Text::make('filed 2 ', 'filed2_Connectus'),
                    Text::make('filed 3 ', 'filed3_Connectus'),
                    Text::make('text form bottom', 'text_form_Connectus'),
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
                    Text::make('Open Graph description', 'description'),
                    Text::make('Site link', 'Site_link'),
                    Image::make('Open Graph image', 'og_image'),
                    Image::make('logo', 'main_logo'),
                ],
                'website Soshal Midia ' => [
                    Text::make('Facebook', 'Facebook'),
                    Text::make('Instagram', 'Instagram'),
                    Text::make('whatsapp', 'whatsapp'),
                    Text::make('Twitter', 'twitter'),
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
            new \Infinety\Filemanager\FilemanagerTool(),
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
