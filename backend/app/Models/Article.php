<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'slug',
        'category',
        'status',
        'source',
        'topic_key',
        'published_at',
        'read_time',
        'related_projects',
        'related_slugs',
        'pl',
        'en',
        'news_url',
        'news_title',
        'chars_pl',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'generated_at' => 'datetime',
            'related_projects' => 'array',
            'related_slugs' => 'array',
            'pl' => 'array',
            'en' => 'array',
            'read_time' => 'integer',
            'chars_pl' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function toCatalogArray(): array
    {
        return [
            'slug' => $this->slug,
            'category' => $this->category,
            'publishedAt' => optional($this->published_at)->toDateString(),
            'updatedAt' => optional($this->updated_at)->toDateString() ?: optional($this->published_at)->toDateString(),
            'readTime' => $this->read_time,
            'relatedProjects' => $this->related_projects ?? [],
            'relatedSlugs' => $this->related_slugs ?? [],
            'pl' => $this->pl ?? [],
            'en' => $this->en ?? [],
            'newsUrl' => $this->news_url,
            'newsTitle' => $this->news_title,
        ];
    }

    public static function bodyCharacterCount(array $locale): int
    {
        $count = mb_strlen((string) ($locale['title'] ?? ''))
            + mb_strlen((string) ($locale['excerpt'] ?? ''));

        foreach ($locale['content'] ?? [] as $block) {
            if (($block['type'] ?? '') === 'faq') {
                continue;
            }
            $count += mb_strlen((string) ($block['text'] ?? ''));
            $count += mb_strlen((string) ($block['title'] ?? ''));
            $items = $block['items'] ?? null;
            if (is_array($items) && isset($items[0]) && is_string($items[0])) {
                $count += mb_strlen(implode('', $items));
            }
        }

        return $count;
    }
}
