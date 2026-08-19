<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\Ai\ArticleGenerator;
use App\Services\Content\SitemapWriter;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class StoreArticleCommand extends Command
{
    protected $signature = 'articles:store {path : Ścieżka do JSON artykułu}';

    protected $description = 'Validate and save a generated article JSON into the database';

    public function handle(SitemapWriter $sitemap): int
    {
        $path = (string) $this->argument('path');
        if (! is_file($path)) {
            $this->error('Nie ma pliku: '.$path);

            return self::FAILURE;
        }

        $data = json_decode((string) file_get_contents($path), true);
        if (! is_array($data)) {
            $this->error('Plik nie jest poprawnym JSON-em.');

            return self::FAILURE;
        }

        $pl = $data['pl'] ?? null;
        $en = $data['en'] ?? null;
        if (! is_array($pl) || ! is_array($en)) {
            $this->error('Artykuł musi mieć osobne obiekty pl i en. Nie zapisuję samej polszczyzny.');

            return self::FAILURE;
        }

        foreach (['title', 'excerpt', 'seoTitle', 'seoDescription', 'content'] as $field) {
            if (empty($pl[$field]) || empty($en[$field])) {
                $this->error("Brak pola {$field} w pl albo en.");

                return self::FAILURE;
            }
        }

        if (! is_array($pl['content']) || ! is_array($en['content'])) {
            $this->error('pl.content i en.content muszą być tablicami bloków.');

            return self::FAILURE;
        }

        $chars = Article::bodyCharacterCount($pl);
        $charsEn = Article::bodyCharacterCount($en);
        if ($chars < ArticleGenerator::MIN_CHARS) {
            $this->error("Ciało PL bez FAQ ma {$chars} znaków, wymagane ".ArticleGenerator::MIN_CHARS.'.');

            return self::FAILURE;
        }
        if ($charsEn < ArticleGenerator::MIN_CHARS_EN) {
            $this->error("Ciało EN bez FAQ ma {$charsEn} znaków, wymagane ".ArticleGenerator::MIN_CHARS_EN.'.');

            return self::FAILURE;
        }
        if (($en['title'] ?? '') === ($pl['title'] ?? '') || ($en['excerpt'] ?? '') === ($pl['excerpt'] ?? '')) {
            $this->error('Wersja EN nie może być kopią PL (ten sam title/excerpt).');

            return self::FAILURE;
        }

        $slug = Str::slug((string) ($data['slug'] ?? ''));
        if ($slug === '') {
            $this->error('Brak sluga.');

            return self::FAILURE;
        }
        if (Article::query()->where('slug', $slug)->exists()) {
            $slug .= '-'.now('Europe/Warsaw')->format('YmdHi');
        }

        $article = Article::query()->create([
            'slug' => $slug,
            'category' => in_array($data['category'] ?? '', ['industry', 'business', 'laravel', 'security'], true)
                ? $data['category']
                : 'industry',
            'status' => 'published',
            'source' => 'generated',
            'topic_key' => $data['topic_key'] ?? null,
            'published_at' => $data['publishedAt'] ?? now('Europe/Warsaw')->toDateString(),
            'read_time' => max(20, (int) ceil($chars / 1800)),
            'related_projects' => $data['relatedProjects'] ?? [],
            'related_slugs' => $data['relatedSlugs'] ?? [],
            'pl' => $pl,
            'en' => $en,
            'news_url' => $data['newsUrl'] ?? $data['news_url'] ?? null,
            'news_title' => $data['newsTitle'] ?? $data['news_title'] ?? null,
            'chars_pl' => $chars,
            'generated_at' => now(),
        ]);

        $sitemap->write();

        $this->info('Zapisano /artykuly/'.$article->slug.' (PL '.$chars.', EN '.$charsEn.' znaków bez FAQ).');

        return self::SUCCESS;
    }
}
