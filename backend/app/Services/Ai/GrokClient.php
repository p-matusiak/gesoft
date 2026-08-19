<?php

namespace App\Services\Ai;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class GrokClient
{
    public function complete(string $prompt, bool $search = false, int $maxTokens = 12000): string
    {
        $key = (string) config('services.xai.key');
        if ($key === '') {
            throw new \RuntimeException('Brak XAI_API_KEY w .env. Dodaj klucz z https://console.x.ai i uruchom ponownie.');
        }

        $model = (string) config('services.xai.model', 'grok-4.6');
        $base = rtrim((string) config('services.xai.base_url', 'https://api.x.ai/v1'), '/');

        try {
            return $this->responses($base, $key, $model, $prompt, $search);
        } catch (\Throwable $e) {
            if ($search) {
                try {
                    return $this->responses($base, $key, $model, $prompt, false);
                } catch (\Throwable) {
                    // fall through to chat completions
                }
            }

            return $this->chatCompletions($base, $key, $model, $prompt, $maxTokens);
        }
    }

    public function json(string $prompt, bool $search = false, int $maxTokens = 12000): array
    {
        $raw = $this->complete($prompt."\n\nZwróć WYŁĄCZNIE poprawny JSON, bez markdown i bez komentarza.", $search, $maxTokens);

        return $this->decodeJson($raw);
    }

    public function decodeJson(string $text): array
    {
        $text = trim($text);
        if (preg_match('/```(?:json)?\s*(.*?)\s*```/s', $text, $match)) {
            $text = trim($match[1]);
        }

        $decoded = json_decode($text, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        $start = strpos($text, '{');
        $end = strrpos($text, '}');
        if ($start !== false && $end !== false && $end > $start) {
            $decoded = json_decode(substr($text, $start, $end - $start + 1), true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        $start = strpos($text, '[');
        $end = strrpos($text, ']');
        if ($start !== false && $end !== false && $end > $start) {
            $decoded = json_decode(substr($text, $start, $end - $start + 1), true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        throw new \RuntimeException('Grok nie zwrócił poprawnego JSON. Fragment: '.mb_substr($text, 0, 400));
    }

    private function responses(string $base, string $key, string $model, string $prompt, bool $search): string
    {
        $payload = [
            'model' => $model,
            'input' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ];

        if ($search) {
            $payload['tools'] = [['type' => 'web_search']];
        }

        $response = Http::withToken($key)
            ->timeout(180)
            ->acceptJson()
            ->post($base.'/responses', $payload);

        $response->throw();
        $data = $response->json();

        $text = $this->extractResponsesText($data);
        if ($text === '') {
            throw new \RuntimeException('Pusta odpowiedź z /v1/responses');
        }

        return $text;
    }

    private function chatCompletions(string $base, string $key, string $model, string $prompt, int $maxTokens): string
    {
        $payload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => 'Jesteś starszym copywriterem SEO GESOFT. Piszesz poprawną polszczyzną, bez zmyślonych statystyk.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.4,
            'max_tokens' => $maxTokens,
        ];

        $response = Http::withToken($key)
            ->timeout(180)
            ->acceptJson()
            ->post($base.'/chat/completions', $payload);

        $response->throw();

        $text = (string) data_get($response->json(), 'choices.0.message.content', '');
        if ($text === '') {
            throw new RequestException($response);
        }

        return $text;
    }

    private function extractResponsesText(array $data): string
    {
        if (! empty($data['output_text']) && is_string($data['output_text'])) {
            return $data['output_text'];
        }

        $chunks = [];
        foreach ($data['output'] ?? [] as $item) {
            if (($item['type'] ?? '') !== 'message') {
                continue;
            }
            foreach ($item['content'] ?? [] as $content) {
                if (in_array($content['type'] ?? '', ['output_text', 'text'], true) && ! empty($content['text'])) {
                    $chunks[] = $content['text'];
                }
            }
        }

        return trim(implode("\n", $chunks));
    }
}
