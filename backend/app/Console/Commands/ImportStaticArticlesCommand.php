<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\Content\SitemapWriter;
use Illuminate\Console\Command;

class ImportStaticArticlesCommand extends Command
{
    protected $signature = 'articles:import-static {--fresh : Delete generated rows stay, replace static slugs}';

    protected $description = 'Import existing articles.json into the articles table';

    public function handle(SitemapWriter $sitemap): int
    {
        $path = resource_path('content/articles.json');
        if (! is_file($path)) {
            $this->error('Brak pliku '.$path);

            return self::FAILURE;
        }

        $items = json_decode((string) file_get_contents($path), true);
        if (! is_array($items)) {
            $this->error('articles.json nie jest tablicą.');

            return self::FAILURE;
        }

        $count = 0;
        foreach ($items as $item) {
            $slug = $item['slug'] ?? null;
            if (! is_string($slug) || $slug === '') {
                continue;
            }

            Article::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category' => $item['category'] ?? 'industry',
                    'status' => 'published',
                    'source' => 'static',
                    'published_at' => $item['publishedAt'] ?? now()->toDateString(),
                    'read_time' => $item['readTime'] ?? 12,
                    'related_projects' => $item['relatedProjects'] ?? [],
                    'related_slugs' => $item['relatedSlugs'] ?? [],
                    'pl' => $item['pl'] ?? [],
                    'en' => $item['en'] ?? [],
                    'chars_pl' => Article::bodyCharacterCount($item['pl'] ?? []),
                ]
            );
            $count++;
        }

        $sitemap->write();
        $this->info("Zaimportowano {$count} artykułów i odświeżono sitemap.");

        return self::SUCCESS;
    }
}
