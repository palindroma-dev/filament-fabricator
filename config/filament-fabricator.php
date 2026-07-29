<?php

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Z3d0X\FilamentFabricator\Models\Page;
use Z3d0X\FilamentFabricator\Resources\PageResource;

// config for Z3d0X/FilamentFabricator
return [
    'routing' => [
        'enabled' => true,
        'prefix' => null, //    /pages
    ],

    'layouts' => [
        'namespace' => 'App\\Filament\\Fabricator\\Layouts',
        'path' => app_path('Filament/Fabricator/Layouts'),
        'register' => [
            //
        ],
    ],

    'page-blocks' => [
        'namespace' => 'App\\Filament\\Fabricator\\PageBlocks',
        'path' => app_path('Filament/Fabricator/PageBlocks'),
        'register' => [
            //
        ],
    ],

    'middleware' => [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
    ],

    'page-model' => Page::class,

    'page-resource' => PageResource::class,

    'enable-view-page' => false,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the above page-model shipped with this package.
     */
    'table_name' => 'pages',
];
