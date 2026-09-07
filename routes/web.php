<?php

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\Http\Controllers\PageController;
use Illuminate\Routing\Router;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (config('filament-fabricator.routing.enabled')) {
  // CMS pages live at /{locale}/{region}/{slug}, same as the storefront group
  // in routes/web.php: when the URL names a valid region the group registers
  // under it, otherwise the region-less route matches and regionSessionRedirect
  // 302s to the full URL (region from session → `_region` cookie → geo-IP →
  // default).
  //
  // These routes are NOT in the `web` middleware group (the package loads this
  // file bare), so the cookie/session middleware are listed here explicitly
  // and must come BEFORE the locale/region middleware — both read and write
  // the session. The same classes in `filament-fabricator.middleware` are
  // deduplicated by the router, keeping this early position.
  Route::group([
    'prefix' => trim(LaravelLocalization::setLocale() . '/' . App\Models\Region::urlPrefix(), '/'),
    'middleware' => [
      EncryptCookies::class,
      AddQueuedCookiesToResponse::class,
      StartSession::class,
      'localeSessionRedirect',
      'localizationRedirect',
      'localeViewPath',
      'regionSessionRedirect',
    ],
  ], function (Router $router) {
    Route::middleware(config('filament-fabricator.middleware') ?? [])
      ->prefix(FilamentFabricator::getRoutingPrefix())
      ->group(function () {
        Route::get('/{filamentFabricatorPage?}', PageController::class)
          ->where('filamentFabricatorPage', '.*')
          ->fallback()
          ->name('page');
      });
  });
}
