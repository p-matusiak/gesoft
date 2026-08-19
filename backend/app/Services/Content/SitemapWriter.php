<?php

namespace App\Services\Content;

class SitemapWriter
{
    public function __construct(private ArticleRepository $articles)
    {
    }

    public function write(): string
    {
        $static = [
            ['loc' => 'https://gesoft.pl/', 'lastmod' => '2026-01-20', 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => 'https://gesoft.pl/o-nas', 'lastmod' => '2026-01-20', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => 'https://gesoft.pl/uslugi', 'lastmod' => '2026-01-20', 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => 'https://gesoft.pl/technologie', 'lastmod' => '2026-01-20', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => 'https://gesoft.pl/portfolio', 'lastmod' => '2026-01-20', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => 'https://gesoft.pl/kontakt', 'lastmod' => '2026-01-20', 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => 'https://gesoft.pl/artykuly', 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ];

        $urls = array_map(fn (array $page) => $this->urlXml(
            $page['loc'],
            $page['lastmod'],
            $page['changefreq'],
            $page['priority']
        ), $static);

        foreach ($this->articles->all() as $article) {
            $urls[] = $this->urlXml(
                'https://gesoft.pl/artykuly/'.$article['slug'],
                $article['updatedAt'] ?? $article['publishedAt'],
                'weekly',
                ($article['category'] ?? '') === 'industry' ? '0.8' : '0.7'
            );
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'."\n"
            .'        xmlns:xhtml="http://www.w3.org/1999/xhtml">'."\n\n"
            .implode("\n\n", $urls)
            ."\n\n</urlset>\n";

        $public = public_path('sitemap.xml');
        file_put_contents($public, $xml);

        $frontend = base_path('../frontend/public/sitemap.xml');
        if (is_dir(dirname($frontend))) {
            file_put_contents($frontend, $xml);
        }

        return $public;
    }

    private function urlXml(string $loc, ?string $lastmod, string $changefreq, string $priority): string
    {
        $join = str_contains($loc, '?') ? '&amp;' : '?';

        return "  <url>\n"
            ."    <loc>{$loc}</loc>\n"
            ."    <xhtml:link rel=\"alternate\" hreflang=\"pl\" href=\"{$loc}\"/>\n"
            ."    <xhtml:link rel=\"alternate\" hreflang=\"en\" href=\"{$loc}{$join}lang=en\"/>\n"
            ."    <xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"{$loc}\"/>\n"
            .'    <lastmod>'.e((string) $lastmod)."</lastmod>\n"
            ."    <changefreq>{$changefreq}</changefreq>\n"
            ."    <priority>{$priority}</priority>\n"
            .'  </url>';
    }
}
