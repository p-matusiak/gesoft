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

Route::get('/{any?}', SpaController::class)->where('any', '^(?!api).*$');
