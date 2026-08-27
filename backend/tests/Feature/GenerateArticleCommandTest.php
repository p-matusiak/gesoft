<?php

namespace Tests\Feature;

use App\Services\Ai\ArticleGenerator;
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

    public function test_minimum_length_matches_expert_article_floor(): void
    {
        $this->assertSame(12000, ArticleGenerator::MIN_CHARS);
        $this->assertSame(8000, ArticleGenerator::MIN_CHARS_EN);
    }

    public function test_voice_prompt_covers_expert_article_brief(): void
    {
        $voice = (string) file_get_contents(resource_path('prompts/article-voice.md'));

        $this->assertStringContainsString('To nie X. To Y.', $voice);
        $this->assertStringContainsString('Kluczowe jest', $voice);
        $this->assertStringContainsString('nie jest to jeszcze obowiązujące prawo', $voice);
        $this->assertStringContainsString('jedną główną tezę', $voice);
        $this->assertStringContainsString('Excel może wystarczyć', $voice);
        $this->assertStringContainsString('Marka GESOFT nie powinna pojawiać się w każdym rozdziale', $voice);
        $this->assertStringContainsString('Nie zaczynaj od technologii', $voice);
        $this->assertStringContainsString('Jedno główne CTA', $voice);
        $this->assertStringContainsString('Nie wymyślaj', $voice);
        $this->assertStringContainsString('Nie opisuj tej kontroli', $voice);
        $this->assertStringContainsString('Nie naśladuj rytmu wcześniejszych wygenerowanych artykułów', $voice);
        $this->assertStringContainsString('bielsko.info', $voice);
        $this->assertStringContainsString('Jeden akapit = jedna informacja', $voice);
        $this->assertStringContainsString('Nie skupiaj się wyłącznie na przepisach', $voice);
        $this->assertStringContainsString('kilka różnych wątków', $voice);
        $this->assertStringContainsString('jak może pomóc usługa IT', $voice);
        $this->assertStringContainsString('Jasność, sens i spójność po polsku', $voice);
        $this->assertStringContainsString('przeczytaj tekst po cichu', $voice);
        $this->assertStringContainsString('Weryfikacja stylu', $voice);
        $this->assertStringContainsString('wymyślony przykład firmy', $voice);
        $this->assertStringContainsString('nie jest prawdziwy klient GESOFT', $voice);
        $this->assertStringNotContainsString('40 000', $voice);
    }

    public function test_generate_article_prompt_requires_editorial_pass(): void
    {
        $prompt = (string) file_get_contents(resource_path('prompts/generate-article.md'));

        $this->assertStringContainsString('Cicha redakcja PL', $prompt);
        $this->assertStringContainsString('Każde zdanie jasne', $prompt);
        $this->assertStringContainsString('Weryfikacja stylu', $prompt);
        $this->assertStringContainsString('Cicha redakcja EN', $prompt);
        $this->assertStringContainsString('article-voice.md', $prompt);
        $this->assertStringContainsString('Akapity **nierównej** długości', $prompt);
        $this->assertStringContainsString('artykuł ekspercki', $prompt);
        $this->assertStringContainsString('12 000', $prompt);
        $this->assertStringContainsString('wątków', $prompt);
        $this->assertStringContainsString('jak może pomóc usługa IT', $prompt);
        $this->assertStringContainsString('wymyślony przykład firmy', $prompt);
        $this->assertStringContainsString('bielsko.info', $prompt);
        $this->assertStringContainsString('Nie skupiaj się wyłącznie na przepisach', $prompt);
        $this->assertStringNotContainsString('14-16 nagłówków', $prompt);
        $this->assertStringNotContainsString('10 FAQ', $prompt);
        $this->assertStringNotContainsString('co zmieniła redakcja', $prompt);
        $this->assertStringNotContainsString('40 000', $prompt);
    }
}
