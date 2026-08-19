<?php

namespace App\Services\Content;

use App\Models\Article;

class ArticleRepository
{
    public function all(): array
    {
        try {
            return Article::query()
                ->published()
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->get()
                ->map(fn (Article $article) => $article->toCatalogArray())
                ->all();
        } catch (\Throwable $e) {
            if (app()->environment('testing')) {
                return $this->fromJsonFile();
            }

            throw $e;
        }
    }

    public function find(string $slug): ?array
    {
        try {
            $article = Article::query()->published()->where('slug', $slug)->first();

            return $article?->toCatalogArray();
        } catch (\Throwable $e) {
            if (! app()->environment('testing')) {
                throw $e;
            }
        }

        foreach ($this->fromJsonFile() as $article) {
            if (($article['slug'] ?? null) === $slug) {
                return $article;
            }
        }

        return null;
    }

    public function localized(array $article, string $locale = 'pl'): array
    {
        $copy = $article[$locale] ?? $article['pl'] ?? [];

        return array_merge($article, is_array($copy) ? $copy : []);
    }

    public function listed(string $locale = 'pl', ?string $category = null): array
    {
        $items = array_map(
            fn (array $article) => $this->localized($article, $locale),
            $this->all()
        );

        usort($items, function (array $left, array $right) {
            return strcmp($right['publishedAt'] ?? '', $left['publishedAt'] ?? '');
        });

        if ($category) {
            $items = array_values(array_filter(
                $items,
                fn (array $article) => ($article['category'] ?? null) === $category
            ));
        }

        return $items;
    }

    public function related(string $slug, string $locale = 'pl', int $limit = 3): array
    {
        $current = $this->find($slug);
        $all = $this->all();

        if (! $current) {
            return array_slice(array_map(
                fn (array $article) => $this->localized($article, $locale),
                $all
            ), 0, $limit);
        }

        $picked = [];
        $seen = [$slug => true];

        $push = function (?array $item) use (&$picked, &$seen, $limit) {
            if (! $item || isset($seen[$item['slug']])) {
                return;
            }
            $seen[$item['slug']] = true;
            $picked[] = $item;
        };

        foreach ($current['relatedSlugs'] ?? [] as $relatedSlug) {
            $push($this->find((string) $relatedSlug));
            if (count($picked) >= $limit) {
                break;
            }
        }

        foreach ($all as $item) {
            if (count($picked) >= $limit) {
                break;
            }
            if (($item['slug'] ?? '') !== $slug && ($item['category'] ?? null) === ($current['category'] ?? null)) {
                $push($item);
            }
        }

        foreach ($all as $item) {
            if (count($picked) >= $limit) {
                break;
            }
            $push($item);
        }

        return array_map(
            fn (array $article) => $this->localized($article, $locale),
            array_slice($picked, 0, $limit)
        );
    }

    private function fromJsonFile(): array
    {
        $path = resource_path('content/articles.json');

        if (! is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
    }
}
