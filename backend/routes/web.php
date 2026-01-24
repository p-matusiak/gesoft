<?php

use Illuminate\Support\Facades\Route;

// SPA fallback - serve the Vue app for all routes except API
Route::get('/{any?}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '^(?!api).*$');
