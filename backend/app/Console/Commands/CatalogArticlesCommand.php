<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\Ai\ArticleGenerator;
use Illuminate\Console\Command;

class CatalogArticlesCommand extends Command
{
    protected $signature = 'articles:catalog';

    protected $description = 'Print existing article slugs and recent generated topics as JSON';

    public function handle(): int
    {
        $articles = Article::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get(['slug', 'category', 'topic_key', 'source', 'published_at', 'pl']);

        $payload = [
            'today' => now('Europe/Warsaw')->toDateString(),
            'industries' => ArticleGenerator::INDUSTRIES,
            'recent_generated_topics' => Article::query()
                ->where('source', 'generated')
                ->orderByDesc('id')
                ->limit(10)
                ->pluck('topic_key')
                ->filter()
                ->values()
                ->all(),
            'articles' => $articles->map(fn (Article $article) => [
                'slug' => $article->slug,
                'category' => $article->category,
                'title' => $article->pl['title'] ?? $article->slug,
                'source' => $article->source,
            ])->all(),
        ];

        $this->line(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        return self::SUCCESS;
    }
}
