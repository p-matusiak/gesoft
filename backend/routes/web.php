<?php

use Illuminate\Support\Facades\Route;

// SPA fallback - serve the Vue app for all routes except API
Route::get('/{any?}', function () {
    return response(file_get_contents(public_path('index.html')))
        ->header('Content-Type', 'text/html; charset=UTF-8')
        ->header('Cache-Control', 'public, max-age=300, stale-while-revalidate=86400');
})->where('any', '^(?!api).*$');
