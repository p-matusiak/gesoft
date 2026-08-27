<?php

namespace App\Console\Commands;

use App\Services\Content\SitemapWriter;
use Illuminate\Console\Command;

class WriteSitemapCommand extends Command
{
    protected $signature = 'articles:sitemap';

    protected $description = 'Write sitemap.xml and rss.xml from articles in the database';

    public function handle(SitemapWriter $sitemap): int
    {
        $path = $sitemap->write();
        $this->info('Zapisano '.$path);

        return self::SUCCESS;
    }
}
