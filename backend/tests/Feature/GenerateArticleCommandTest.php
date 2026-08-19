<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateArticleCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_rejects_short_article(): void
    {
        $path = storage_path('app/generated-test.json');
        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, json_encode([
            'slug' => 'za-krotki',
            'category' => 'industry',
            'pl' => [
                'title' => 'T',
                'excerpt' => 'E',
                'content' => [['type' => 'p', 'text' => 'krótko']],
            ],
            'en' => ['title' => 'T', 'excerpt' => 'E', 'content' => []],
        ], JSON_UNESCAPED_UNICODE));

        $this->artisan('articles:store', ['path' => $path])->assertFailed();
    }
}
