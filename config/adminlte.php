
<?php

use Illuminate\Support\Facades\Gate;
use JeroenNoten\LaravelAdminLte\AdminLte;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'La Hacienda |',
    'title_postfix' => '',


    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */
    'logo_img' => 'vendor/adminlte/dist/img/logo2.png',
    'use_ico_only' => true,
    'use_full_favicon' => true,


    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Complejo</b> La Hacienda',
    'logo_img' => 'vendor/adminlte/dist/img/logo2.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/inicio',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'Buscar',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'   => 'Panel de control',
            'route'  => 'admin.index',
            'can' => 'admin.index',
            'icon'   => 'fas fa-pager',
        ],
        ['header' => 'PANEL'],
        [
            'text' => 'Usuarios',
            'can' => 'users.index',
            'id' => 'menuUsuarios',
            'icon' => 'fas fa-users',
            'submenu' => [
                [
                    'text' => 'Listado de usuarios',
                    'can' => 'users.index',
                    'icon' => 'fas fa-list-alt',
                    'route'  => 'users.index',
                ],
                [
                    'text' => 'Usuarios inactivos',
                    'can' => 'users.inactivos',
                    'icon' => 'fas fa-stream',
                    'route'  => 'users.inactivos',
                ],
                [
                    'text' => 'Reporte de usuarios',
                    'can' => 'getPD',
                    'icon' => 'fas fa-file-pdf',
                    'route'  => 'getPD',
                ],
            ]
        ],
        [
            'text' => 'Roles',
            'route'  => 'roles.index',
            'id' => 'menuRoles',
            'icon' => 'fa fa-lock',
            'can' => 'roles.index',
            'submenu' => [
                [
                    'text' => 'Listado de roles',
                    'icon' => 'fas fa-list-alt',
                    'can' => 'roles.index',
                    'route'  => 'roles.index',
                ],
                [
                    'text' => 'Listado de roles inactivos',
                    'icon' => 'fas fa-stream',
                    'can' => 'roles.inactivos',
                    'route'  => 'roles.inactivos',
                ],
                [
                    'text' => 'Crear roles',
                    'icon' => 'fas fa-solid fa-plus',
                    'can' => 'roles.create',
                    'route'  => 'roles.create',
                ],
                [
                    'text' => 'Reporte de roles',
                    'icon' => 'fas fa-file-pdf',
                    'can' => 'pdfss',
                    'route'  => 'getPDFR',
                ],
            ]

        ],
        [
            'text' => 'Mascotas',
            'route'  => 'mascotas.index',
            'id' => 'menuMascotas',
            'icon' => 'fa fa-paw',
            'active' => ['admin/mascotas*'],
            'submenu' => [
                [
                    'text' => 'Listado de mascotas',
                    'route'  => 'mascotas.index',
                    'icon' => 'fas fa-list-alt',
                    'data' => [
                        'visible' => true,
                    ],
                ],
                [
                    'text' => 'Mascotas inactivas',
                    'icon' => 'fas fa-stream',
                    'route'  => 'mascotas.inactivos',
                    'data' => [
                        'visible' => true,
                    ],
                ],

                [
                    'text' => 'Crear mascotas',
                    'icon' => 'fas fa-solid fa-plus',
                    'route'  => 'mascotas.create',
                    'data' => [
                        'visible' => true,
                    ],
                ],
                [
                    'text' => 'Reporte de mascotas',
                    'icon' => 'fas fa-file-pdf',
                    'route'  => 'getPDF',
                    'data' => [
                        'visible' => true,
                    ],
                ],
            ]
        ],
        
        [
            'text'    => 'Peluqueria',
            'id' => 'menuPeluqueria',
            'can' => 'reservas_peluqueria.index',
            'icon'    => 'fas fa-fw fa-splotch',
            'submenu' => [
                [
                    'text' => 'Registrar Nueva reserva',
                    'icon' => 'fas fa-fw fa-plus',
                    'url'  => 'admin/reservas_peluqueria/create',
                ],
                [
                    'text' => 'Reservas Activas',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin/reservas_peluqueria',
                ],
                [
                    'text' => 'Reservas completadas',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin/reservas_peluqueria/completadas',
                ],
                [
                    'text' => 'Reservas Canceladas',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin/reservas_peluqueria/canceladas',
                ],
                [
                    'text' => 'Reporte de Reservas Completadas',
                    'icon' => 'fas fa-file-pdf',
                    'route'  => 'getPDFpeluqueria',
                ],
            ],
        ],

        [
            'text' => 'Productos',
            'id' => 'menuProductos',
            'icon'    => 'fas fa-fw fa-shopping-cart',
            'submenu' => [
                [
                    'text'    => 'Categoria',
                    'can' => 'categorias',
                    'id' => 'menuCategorias',
                    'icon'    => 'fas fa-fw fa-cart-plus',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Crear',
                            'icon'    => 'fas fa-fw fa-plus-square',
                            'url'     => 'admin/categorias/create',
                        ],
                        [
                            'text' => 'Inactivos',
                            'icon'    => 'fas fa-fw fa-toggle-off',
                            'url'     => 'admin/categorias/inactivos',
                        ],
                        [
                            'text'    => 'Listar',
                            'icon'    => 'fas fa-list-alt',
                            'url'     => 'admin/categorias',
                        ],
                    ],
                ],
                [
                    'text'    => 'Producto',
                    'id' => 'menuProducto',
                    'icon'    => 'fas fa-fw fa-cart-plus',
                    'submenu' => [
                        [
                            'text' => 'Crear',
                            'can' => 'productos.create',
                            'icon'    => 'fas fa-fw fa-plus-square',
                            'url'     => 'admin/productos/create',
                        ],
                        [
                            'text' => 'Inactivos',
                            'can' => 'productos.inactivos',
                            'route'  => 'productos.inactivos',
                            'icon'    => 'fas fa-fw fa-toggle-off',
                            'url'     => 'admin/productos/inactivos',
                        ],
                        [
                            'text'    => 'Listar',
                            'can'=> 'productos.index',
                            'icon'    => 'fas fa-list-alt',
                            'url'     => 'admin/productos',
                        ],
                    ],
                ],
            ],

        ],
        [
            'text'    => 'Compras',
            'can' => 'compras.index',
            'id' => 'menuCompras',
            'icon'    => 'fas fa-fw fa-shopping-cart',
            'submenu' => [
                [
                    'text'    => 'Proveedor',
                    'can' => 'proveedores',
                    'id' => 'menuProveedor',
                    'icon'    => 'fas fa-fw fa-cart-plus',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Crear',
                            'icon'    => 'fas fa-fw fa-plus-square',
                            'url'     => 'admin/proveedores/create',
                        ],
                        [
                            'text' => 'Inactivos',
                            'icon'    => 'fas fa-fw fa-toggle-off',
                            'url'     => 'admin/proveedores/inactivos',
                        ],
                        [
                            'text'    => 'Listar',
                            'route'  => 'proveedores.index',
                            'icon'    => 'fas fa-list-alt',
                            'url'     => 'admin/proveedores',
                            'active' => ['admin/proveedores*'],
                        ],
                    ],
                ],
                [
                    'text'    => 'Compra',
                    'id' => 'menuCompra',
                    'icon'    => 'fas fa-fw fa-cart-plus',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Crear',
                            'icon'    => 'fas fa-fw fa-plus-square',
                            'can' => 'compras.create',
                            'url'  => 'admin/compras/create',
                        ],
                        [
                            'text'    => 'Listar',
                            'can' => 'compras.index', 
                            'icon'    => 'fas fa-list-alt',
                            'url'     => 'admin/compras',
                        ],
                        [
                            'text' => 'Reporte de compras',
                            'can' => 'compras.getPDFcompras', 
                            'icon' => 'fas fa-file-pdf',
                            'route'  => 'getPDFcompras',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Ventas',
            'icon' => 'fas fa-fw fa-money-check',
            'id' => 'menuVentas',
            'submenu' => [
                [
                    'text' => 'Listado de ventas',
                    'can' => 'ventas.index',
                    'icon' => 'fas fa-list-alt',
                    'url'  => 'admin/ventas',
                ],
                [
                    'text' => 'Crear nueva venta',
                    'can' => 'ventas.create',
                    'icon' => 'fas fa-fw fa-cart-plus',
                    'url'  => 'admin/ventas/create',
                ],
                [
                    'text' => 'Reporte de ventas',
                    'can' => 'ventas.getPDFVentas',
                    'icon' => 'fas fa-file-pdf',
                    'route'  => 'getPDFVentas'
                ],
            ]
        ],

        [
            'text' => ' Reservaciones de Hotel',
            'url'  => 'admin/reservacionHotel',
            'can'=>'admin/reservacionHotel',
            'icon' => 'fas fa-fw fa-hotel',
            'submenu' => [
                [
                'text' => 'Registrar Nueva reserva',
                'icon' => 'fas fa-fw fa-plus',
                'url'  => 'admin/reservacionHotel/create',
            ],
            [
            'text' => 'Reservas sin Confirmar',
                'icon' => 'fas fa-fw fa-list',
                'url'  => 'admin/reservacionHotel',
            ],
            [
                'text' => 'Reservas Activas',
                'icon' => 'fas fa-fw fa-list',
                'url'  => 'admin/reservacionHotel/activas',
            ],
            [
                'text' => 'Reservas Pendientes de Salida',
                'icon' => 'fas fa-fw fa-list',
                'url'  => 'admin/reservacionHotel/pendientes',
            ],
            [
                'text' => 'Reservas Completadas',
                'icon' => 'fas fa-fw fa-list',
                'url'  => 'admin/reservacionHotel/completadas',
            ],
            [
                'text' => 'Reservas Canceladas',
                'icon' => 'fas fa-fw fa-list',
                'url'  => 'admin/reservacionHotel/canceladas',
            ],
            ]
        ],
        [
            'text' => 'Habitaciones de hotel',
            'can' => 'habitacion',
            'id' => 'menuHabitacion',
            'icon' => 'fas fa-fw fa-hotel',
            'submenu' => [
                [
                    'text' => 'Registrar Nueva habitación',
                    'icon' => 'fas fa-fw fa-plus',
                    'url'  => 'admin/habitacion/create',
                ],
                [
                    'text' => 'Habitaciones Activas',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin/habitacion',
                ],
                [
                    'text' => 'Habitaciones Inactivas',
                    'icon' => 'fas fa-fw fa-list',
                    'url'  => 'admin/habitacion/desactivadas',
                ],
            ]
        ],
        [
            'text' => 'Veterinaria',
            'id' => 'menuVeterinaria',
            'icon' => 'fas fa-file-medical',
            'submenu' => [
                [
                    'id' => 'submenusVeterinarias',
                    'text' => 'Registrar Nueva reserva',
                    'icon' => 'fas fa-fw fa-plus',
                    'can' => 'reservas_veterinaria.create',
                    'url'  => 'admin/reservas_veterinaria/create',
                    'data' => [
                        'can' => 'reservas_veterinaria.create' ? 'true' : 'false',
                    ],
                ],
                [
                    'text' => 'Reservas Activas',
                    'icon' => 'fas fa-fw fa-list',
                    'can' => 'reservas_veterinaria.index',
                    'url'  => 'admin/reservas_veterinaria',
                    'data' => [
                        'can' => 'reservas_veterinaria.index' ? 'true' : 'false',
                    ],
                ],
                [
                    'text' => 'Reservas completadas',
                    'icon' => 'fas fa-fw fa-list',
                    'can' => 'reservas_veterinaria.completadas',
                    'url'  => 'admin/reservas_veterinaria/completadas',
                    'data' => [
                        'can' => 'reservas_veterinaria.completadas' ? 'true' : 'false',
                    ],
                ],
                [
                    'text' => 'Reservas Canceladas',
                    'icon' => 'fas fa-fw fa-list',
                    'can' => 'reservas_veterinaria.canceladas',
                    'url'  => 'admin/reservas_veterinaria/canceladas',
                    'data' => [
                        'can' => 'reservas_veterinaria.canceladas' ? 'true' : 'false',
                    ],
                ],
            ],


        ],
        [
            'text' => 'Reportes',
            'id' => 'menuReportes',
            'icon' => 'fas fa-solid fa-file-pdf',
            'can' => 'users.index',
            'submenu' => [
                [
                    'text' => 'Generar reporte',
                    'icon' => 'fas fa-folder-plus',

                    'route'  => 'reportes.index',
                ],
            ]
        ],
        [
            'text' => 'Registro de actividad',
            'icon' => 'fas fa-solid fa-file-pdf',
            'can' => 'users.index',
            'url'  => 'logs',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],

            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,

];
