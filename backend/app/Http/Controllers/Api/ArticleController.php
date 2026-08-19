<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Content\ArticleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(private ArticleRepository $articles)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $locale = $request->query('lang') === 'en' ? 'en' : 'pl';
        $category = $request->query('kategoria');
        $category = is_string($category) ? $category : null;

        $items = $this->articles->listed($locale, $category);

        $summary = array_map(function (array $article) {
            return [
                'slug' => $article['slug'] ?? null,
                'category' => $article['category'] ?? null,
                'publishedAt' => $article['publishedAt'] ?? null,
                'updatedAt' => $article['updatedAt'] ?? null,
                'readTime' => $article['readTime'] ?? null,
                'title' => $article['title'] ?? null,
                'excerpt' => $article['excerpt'] ?? null,
                'seoTitle' => $article['seoTitle'] ?? null,
                'seoDescription' => $article['seoDescription'] ?? null,
                'keywords' => $article['keywords'] ?? null,
            ];
        }, $items);

        return response()->json(['data' => $summary]);
    }

    public function show(Request $request, string $slug): JsonResponse
    {
        $locale = $request->query('lang') === 'en' ? 'en' : 'pl';
        $article = $this->articles->find($slug);

        if (! $article) {
            return response()->json(['message' => 'Nie znaleziono artykułu'], 404);
        }

        $localized = $this->articles->localized($article, $locale);
        $localized['related'] = $this->articles->related($slug, $locale, 3);

        return response()->json(['data' => $localized]);
    }
}
