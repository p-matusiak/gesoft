<?php

namespace App\Services\Content;

class ServiceCatalog
{
    public function keys(): array
    {
        return array_keys($this->raw());
    }

    public function has(string $slug): bool
    {
        return isset($this->raw()[$slug]);
    }

    public function all(string $locale = 'pl'): array
    {
        return array_values(array_filter(array_map(
            fn (string $slug) => $this->find($slug, $locale),
            $this->keys()
        )));
    }

    public function find(string $slug, string $locale = 'pl'): ?array
    {
        $page = $this->raw()[$slug] ?? null;
        if (! is_array($page)) {
            return null;
        }

        $locale = $locale === 'en' ? 'en' : 'pl';
        $copy = $page[$locale] ?? $page['pl'] ?? null;
        if (! is_array($copy)) {
            return null;
        }

        return array_merge($copy, ['slug' => $slug]);
    }

    public function relatedForArticle(array $article, string $locale = 'pl'): ?array
    {
        $slug = strtolower((string) ($article['slug'] ?? ''));
        $category = (string) ($article['category'] ?? '');

        $mapped = match (true) {
            (bool) preg_match('/android|terenow|serwis-teren|pomoc-drogowa|laweta|sprzatajac/', $slug) => 'aplikacje-android',
            (bool) preg_match('/ksef|integr/', $slug) => 'integracje-api',
            (bool) preg_match('/crm|b2b|hurtown|erp|magazyn/', $slug) => 'systemy-b2b',
            (bool) preg_match('/google-wizytowka|strona-internetowa|sklep-internetowy/', $slug) => 'strony-internetowe',
            in_array($category, ['laravel', 'security'], true)
                || (bool) preg_match('/laravel|bezpieczen|rodo|wordpress-vs|audyt|2fa|uwierzyteln/', $slug) => 'laravel-vue',
            (bool) preg_match('/gotowy-program|oprogramowanie-na-zamowienie/', $slug) => 'oprogramowanie-na-zamowienie',
            $category === 'industry' || $category === 'business' => 'oprogramowanie-na-zamowienie',
            default => 'aplikacje-webowe',
        };

        return $this->find($mapped, $locale);
    }

    private function raw(): array
    {
        $path = dirname(base_path()).'/frontend/src/data/service-pages.json';
        if (! is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
    }
}
