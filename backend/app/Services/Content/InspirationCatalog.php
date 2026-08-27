<?php

namespace App\Services\Content;

class InspirationCatalog
{
    public function keys(): array
    {
        return array_keys($this->localeCopy('pl')['portfolio']['projects'] ?? []);
    }

    public function has(string $key): bool
    {
        return in_array($key, $this->keys(), true);
    }

    public function all(string $locale = 'pl'): array
    {
        return array_values(array_filter(array_map(
            fn (string $key) => $this->find($key, $locale),
            $this->keys()
        )));
    }

    public function find(string $key, string $locale = 'pl'): ?array
    {
        $copy = $this->localeCopy($locale)['portfolio']['projects'][$key]
            ?? $this->localeCopy('pl')['portfolio']['projects'][$key]
            ?? null;

        if (! is_array($copy)) {
            return null;
        }

        $filters = $this->localeCopy($locale)['portfolio']['filters'] ?? [];

        return [
            'key' => $key,
            'title' => (string) ($copy['title'] ?? $key),
            'description' => (string) ($copy['description'] ?? ''),
            'fullDescription' => (string) ($copy['fullDescription'] ?? ''),
            'image' => '/portfolio/'.strtolower($key).'.png',
            'filters' => $filters,
        ];
    }

    private function localeCopy(string $locale): array
    {
        $locale = $locale === 'en' ? 'en' : 'pl';
        $path = dirname(base_path()).'/frontend/src/i18n/locales/'.$locale.'.json';
        if (! is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);

        return is_array($decoded) ? $decoded : [];
    }
}
