<?php

use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

Route::get('/rss.xml', RssFeedController::class);
Route::get('/rss-en.xml', RssFeedController::class);
Route::get('/feed', RssFeedController::class);

Route::get('/inspiracje', function (\Illuminate\Http\Request $request) {
    $query = $request->getQueryString();

    return redirect('/portfolio'.($query ? '?'.$query : ''), 301);
});

Route::get('/inspiracje/{key}', function (string $key, \Illuminate\Http\Request $request) {
    $query = $request->getQueryString();

    return redirect('/portfolio/'.$key.($query ? '?'.$query : ''), 301);
});

Route::get('/portfolio', function (\Illuminate\Http\Request $request, SpaController $spa, \App\Services\Seo\SpaSeoInjector $seo) {
    $key = $request->query('projekt');
    if (is_string($key) && preg_match('/^[A-Za-z0-9_-]+$/', $key)) {
        $query = $request->query();
        unset($query['projekt']);
        $qs = http_build_query($query);

        return redirect('/portfolio/'.$key.($qs !== '' ? '?'.$qs : ''), 301);
    }

    return $spa($request, $seo);
});

Route::get('/{any?}', SpaController::class)->where('any', '^(?!api).*$');
