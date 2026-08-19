<?php

namespace App\Http\Controllers;

use App\Services\Seo\SpaSeoInjector;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpaController extends Controller
{
    public function __invoke(Request $request, SpaSeoInjector $seo): Response
    {
        $index = public_path('index.html');

        if (! is_file($index)) {
            abort(500, 'Frontend build is missing.');
        }

        $html = (string) file_get_contents($index);
        [$html, $status] = $seo->inject($html, $request);

        $cache = $status === 200
            ? 'public, max-age=300, stale-while-revalidate=86400'
            : 'no-store, no-cache, must-revalidate';

        return response($html, $status)
            ->header('Content-Type', 'text/html; charset=UTF-8')
            ->header('Cache-Control', $cache);
    }
}
