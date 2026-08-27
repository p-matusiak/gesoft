<?php

namespace App\Http\Controllers;

use App\Services\Content\RssFeed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssFeedController extends Controller
{
    public function __invoke(Request $request, RssFeed $rss): Response
    {
        $locale = $request->query('lang') === 'en' || $request->is('rss-en.xml') ? 'en' : 'pl';

        return response($rss->xml($locale), 200)
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=600');
    }
}
