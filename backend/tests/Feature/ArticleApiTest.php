<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_published_articles(): void
    {
        $this->seedArticle('program-dla-piekarni');

        $response = $this->getJson('/api/articles');

        $response->assertOk();
        $response->assertJsonPath('data.0.slug', 'program-dla-piekarni');
        $response->assertJsonPath('data.0.title', 'Program dla piekarni');
        $response->assertJsonMissingPath('data.0.content');
    }

    public function test_shows_localized_article_with_related(): void
    {
        $this->seedArticle('program-dla-piekarni', ['related_slugs' => ['ksef-w-piekarni']]);
        $this->seedArticle('ksef-w-piekarni', ['pl' => $this->locale('KSeF w piekarni')]);

        $response = $this->getJson('/api/articles/program-dla-piekarni');

        $response->assertOk();
        $response->assertJsonPath('data.slug', 'program-dla-piekarni');
        $response->assertJsonPath('data.title', 'Program dla piekarni');
        $response->assertJsonPath('data.related.0.slug', 'ksef-w-piekarni');
    }

    public function test_unknown_slug_returns_404(): void
    {
        $this->getJson('/api/articles/brak')->assertNotFound();
    }

    public function test_english_locale_returns_en_copy(): void
    {
        $this->seedArticle('program-dla-piekarni');

        $list = $this->getJson('/api/articles?lang=en');
        $list->assertOk();
        $list->assertJsonPath('data.0.title', 'Bakery software');

        $show = $this->getJson('/api/articles/program-dla-piekarni?lang=en');
        $show->assertOk();
        $show->assertJsonPath('data.title', 'Bakery software');
        $show->assertJsonPath('data.excerpt', 'Excerpt');
    }

    public function test_character_count_skips_faq(): void
    {
        $count = Article::bodyCharacterCount([
            'title' => 'ABC',
            'excerpt' => 'DE',
            'content' => [
                ['type' => 'p', 'text' => '12345'],
                ['type' => 'faq', 'items' => [['q' => 'QQQQQQ', 'a' => 'AAAAAA']]],
            ],
        ]);

        $this->assertSame(10, $count);
    }

    private function seedArticle(string $slug, array $overrides = []): Article
    {
        return Article::query()->create(array_merge([
            'slug' => $slug,
            'category' => 'industry',
            'status' => 'published',
            'source' => 'static',
            'published_at' => '2026-08-19',
            'read_time' => 12,
            'related_projects' => ['crm'],
            'related_slugs' => [],
            'pl' => $this->locale('Program dla piekarni'),
            'en' => $this->locale('Bakery software'),
            'chars_pl' => 100,
        ], $overrides));
    }

    private function locale(string $title): array
    {
        return [
            'title' => $title,
            'excerpt' => 'Excerpt',
            'seoTitle' => $title.' | GESOFT',
            'seoDescription' => 'Desc',
            'keywords' => 'piekarnia',
            'content' => [
                ['type' => 'p', 'text' => 'Treść.'],
            ],
        ];
    }
}
