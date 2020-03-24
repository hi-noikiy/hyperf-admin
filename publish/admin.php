<?php declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Hyperf-admin name
    |--------------------------------------------------------------------------
    |
    | This value is the name of Hyperf-admin, This setting is displayed on the
    | login page.
    |
    */
    'name' => '<span style="color:white"> Hyperf-admin </span>',

    /*
    |--------------------------------------------------------------------------
    | Hyperf-admin html title
    |--------------------------------------------------------------------------
    |
    | Html title for all pages.
    |
    */
    'title' => 'Admin',

    /*
    |--------------------------------------------------------------------------
    | Hyperf-admin logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages. You can also set it as an image by using a
    | `img` tag, eg '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo' => '<b>Hyperf</b> admin',

    /*
    |--------------------------------------------------------------------------
    | Hyperf-admin mini logo
    |--------------------------------------------------------------------------
    |
    | The logo of all admin pages when the sidebar menu is collapsed. You can
    | also set it as an image by using a `img` tag, eg
    | '<img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo-mini' => '<b>Hy</b>',

    /*
    |--------------------------------------------------------------------------
    | Hyperf-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'namespace' => 'App\\Admin\\Controller',
        'middleware' => ['web', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Skin
    |--------------------------------------------------------------------------
    |
    | This value is the skin of admin pages.
    | @see https://adminlte.io/docs/2.4/layout
    |
    | Supported:
    |    "skin-blue", "skin-blue-light", "skin-yellow", "skin-yellow-light",
    |    "skin-green", "skin-green-light", "skin-purple", "skin-purple-light",
    |    "skin-red", "skin-red-light", "skin-black", "skin-black-light".
    |
    */
    'skin' => 'skin-purple',

    /*
    |--------------------------------------------------------------------------
    | Application layout
    |--------------------------------------------------------------------------
    |
    | This value is the layout of admin pages.
    | @see https://adminlte.io/docs/2.4/layout
    |
    | Supported: "fixed", "layout-boxed", "layout-top-nav", "sidebar-collapse",
    | "sidebar-mini".
    |
    */
    'layout' => ['sidebar-mini', 'fixed'],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | This value is used to set the background image of login page.
    |
    */
    // 'login_background_image' => 'vendor/hyperf-admin/AdminLTE/dist/img/bg.jpeg',
];
