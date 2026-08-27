<?php

namespace App\Services\Content;

class RssFeed
{
    private const BASE_URL = 'https://gesoft.pl';

    public function __construct(private ArticleRepository $articles)
    {
    }

    public function xml(string $locale = 'pl'): string
    {
        $locale = $locale === 'en' ? 'en' : 'pl';
        $items = array_slice($this->articles->listed($locale), 0, 50);
        $channelTitle = $locale === 'en'
            ? 'GESOFT articles'
            : 'GESOFT — artykuły';
        $channelDesc = $locale === 'en'
            ? 'Expert articles for business owners: processes, software and when custom IT is worth it.'
            : 'Artykuły dla właścicieli firm: procesy, oprogramowanie i kiedy własne IT ma sens.';
        $self = self::BASE_URL.($locale === 'en' ? '/rss-en.xml' : '/rss.xml');

        $entries = [];
        foreach ($items as $article) {
            $slug = (string) ($article['slug'] ?? '');
            if ($slug === '') {
                continue;
            }
            $url = self::BASE_URL.'/artykuly/'.$slug.($locale === 'en' ? '?lang=en' : '');
            $published = $article['publishedAt'] ?? date('Y-m-d');
            $pubDate = date('D, d M Y H:i:s O', strtotime((string) $published) ?: time());
            $title = $this->cdata((string) ($article['title'] ?? $slug));
            $description = $this->cdata($this->plain((string) ($article['excerpt'] ?? '')));

            $entries[] = "    <item>\n"
                ."      <title>{$title}</title>\n"
                ."      <link>{$url}</link>\n"
                ."      <guid isPermaLink=\"true\">{$url}</guid>\n"
                ."      <pubDate>{$pubDate}</pubDate>\n"
                ."      <description>{$description}</description>\n"
                .'    </item>';
        }

        return '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n"
            ."  <channel>\n"
            .'    <title>'.$this->cdata($channelTitle)."</title>\n"
            .'    <link>'.self::BASE_URL."/artykuly</link>\n"
            .'    <description>'.$this->cdata($channelDesc)."</description>\n"
            .'    <language>'.($locale === 'en' ? 'en-gb' : 'pl-pl')."</language>\n"
            .'    <lastBuildDate>'.date('D, d M Y H:i:s O')."</lastBuildDate>\n"
            .'    <atom:link href="'.$self.'" rel="self" type="application/rss+xml"/>'."\n"
            .implode("\n", $entries)."\n"
            ."  </channel>\n"
            ."</rss>\n";
    }

    public function write(): string
    {
        $pl = $this->xml('pl');
        $en = $this->xml('en');
        $publicPl = public_path('rss.xml');
        $publicEn = public_path('rss-en.xml');
        file_put_contents($publicPl, $pl);
        file_put_contents($publicEn, $en);

        $frontend = base_path('../frontend/public');
        if (is_dir($frontend)) {
            file_put_contents($frontend.'/rss.xml', $pl);
            file_put_contents($frontend.'/rss-en.xml', $en);
        }

        return $publicPl;
    }

    private function cdata(string $text): string
    {
        $text = str_replace(']]>', ']]&gt;', $text);

        return '<![CDATA['.$text.']]>';
    }

    private function plain(string $text): string
    {
        $text = preg_replace('/\*\*(.+?)\*\*/', '$1', $text) ?? $text;
        $text = preg_replace('/\+\+(.+?)\+\+/', '$1', $text) ?? $text;
        $text = preg_replace('/\*(.+?)\*/', '$1', $text) ?? $text;
        $text = preg_replace('/\[([^\]]+)\]\((\/[^)\s]+|https?:\/\/[^)\s]+)\)/', '$1', $text) ?? $text;

        return trim(html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
