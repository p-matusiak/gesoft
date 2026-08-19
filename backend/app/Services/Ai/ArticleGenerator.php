<?php

namespace App\Services\Ai;

use App\Models\Article;
use App\Services\Content\SitemapWriter;
use Illuminate\Support\Str;

class ArticleGenerator
{
    public const MIN_CHARS = 40000;

    public const MIN_CHARS_EN = 28000;

    /** @var list<array{key:string,label:string,projects:list<string>}> */
    public const INDUSTRIES = [
        ['key' => 'horeca', 'label' => 'gastronomia, restauracje i HoReCa', 'projects' => ['restaurant', 'booking', 'posystem']],
        ['key' => 'transport', 'label' => 'transport drogowy, TSL i flota', 'projects' => ['transport', 'fleet', 'logistics']],
        ['key' => 'bdo', 'label' => 'odpady, BDO i gospodarka komunalna', 'projects' => ['inventory', 'fieldService', 'construction']],
        ['key' => 'accounting', 'label' => 'biura rachunkowe, KSeF i e-Doręczenia', 'projects' => ['invoicing', 'crm', 'lawcrm']],
        ['key' => 'staffing', 'label' => 'agencje zatrudnienia i praca tymczasowa', 'projects' => ['hr', 'recruitment', 'timesheet']],
        ['key' => 'beauty', 'label' => 'salony fryzjerskie, kosmetyczne i beauty', 'projects' => ['saloncrm', 'booking']],
        ['key' => 'health', 'label' => 'gabinety lekarskie, stomatologiczne i fizjoterapia', 'projects' => ['medical', 'dental', 'clinicweb']],
        ['key' => 'workshop', 'label' => 'warsztaty samochodowe i serwisy', 'projects' => ['inventory', 'fieldService']],
        ['key' => 'construction', 'label' => 'firmy budowlane i ekipy terenowe', 'projects' => ['construction', 'fieldService', 'timesheet']],
        ['key' => 'housing', 'label' => 'wspólnoty, spółdzielnie i zarządcy nieruchomości', 'projects' => ['property', 'realEstate', 'invoicing']],
        ['key' => 'ecommerce', 'label' => 'lokalny e-commerce i B2B hurtownie', 'projects' => ['wholesale', 'inventory', 'invoicing']],
        ['key' => 'education', 'label' => 'szkoły, kursy, przedszkola i żłobki', 'projects' => ['schoolapp', 'schoollms', 'elearning']],
        ['key' => 'energy', 'label' => 'fotowoltaika i instalatorzy OZE', 'projects' => ['fieldService', 'crm']],
        ['key' => 'cleaning', 'label' => 'firmy sprzątające i facility', 'projects' => ['fieldService', 'timesheet']],
        ['key' => 'legal', 'label' => 'kancelarie prawne', 'projects' => ['lawcrm', 'lawweb']],
        ['key' => 'hospitality', 'label' => 'hotele, pensjonaty i obiekty noclegowe', 'projects' => ['hotel', 'booking']],
        ['key' => 'fitness', 'label' => 'siłownie, kluby fitness i studia treningowe', 'projects' => ['gymmanagement', 'fitness']],
        ['key' => 'security', 'label' => 'bezpieczeństwo aplikacji i RODO w firmie', 'projects' => ['crm', 'monitoring']],
    ];

    public function __construct(
        private GrokClient $grok,
        private SitemapWriter $sitemap
    ) {
    }

    public function generate(?string $topicKey = null): Article
    {
        if (Article::query()->count() === 0) {
            throw new \RuntimeException('Baza artykułów jest pusta. Najpierw: php artisan articles:import-static');
        }

        $industry = $this->pickIndustry($topicKey);
        $catalog = $this->catalog();
        $news = $this->researchNews($industry);
        $plan = $this->planArticle($industry, $news, $catalog);

        $slug = $this->uniqueSlug((string) ($plan['slug'] ?? Str::slug($plan['pl_title'] ?? $industry['key'])));
        $relatedSlugs = $this->pickRelatedSlugs($plan['related_slugs'] ?? [], $catalog, $slug);

        $plContent = [];
        $plContent = array_merge($plContent, $this->introBlocks($plan, $news, $relatedSlugs));

        foreach ($plan['sections'] as $index => $section) {
            $plContent = array_merge($plContent, $this->sectionBlocks($plan, $section, $index + 1, count($plan['sections']), $news, $relatedSlugs, $catalog));
        }

        $plContent[] = [
            'type' => 'callout',
            'title' => 'Oferta w 24 godziny — bez slajdu o transformacji',
            'text' => 'Napiszcie na [kontakt](/kontakt): branża, liczba lokalizacji albo aut/stanowisk, jaki proces boli dziś, czy macie już SaaS. GESOFT (Paweł Matusiak, Laravel, Vue, Android) wraca z ofertą w 24 godziny. Jeśli gotowiec Wam wystarczy — napiszemy to wprost.',
        ];
        $plContent[] = $this->faqBlock($plan, $news, $relatedSlugs);

        $pl = [
            'title' => $plan['pl_title'],
            'excerpt' => $plan['pl_excerpt'],
            'seoTitle' => $plan['pl_seo_title'],
            'seoDescription' => $plan['pl_seo_description'],
            'keywords' => $plan['pl_keywords'],
            'content' => $plContent,
        ];

        $chars = Article::bodyCharacterCount($pl);
        $guard = 0;
        while ($chars < self::MIN_CHARS && $guard < 6) {
            $pl['content'] = $this->insertBeforeFaq($pl['content'], $this->expansionBlocks($plan, $news, $relatedSlugs, $chars));
            $chars = Article::bodyCharacterCount($pl);
            $guard++;
        }

        if ($chars < self::MIN_CHARS) {
            throw new \RuntimeException("Artykuł ma {$chars} znaków (wymagane ".self::MIN_CHARS.'). Nie zapisuję.');
        }

        $pl['content'] = $this->ensureConversion($pl['content'], $relatedSlugs, $plan['seo_phrase'] ?? $plan['pl_title']);

        $en = $this->englishLocale($plan, $pl, $news);

        $article = Article::query()->create([
            'slug' => $slug,
            'category' => $plan['category'] ?? 'industry',
            'status' => 'published',
            'source' => 'generated',
            'topic_key' => $industry['key'],
            'published_at' => now('Europe/Warsaw')->toDateString(),
            'read_time' => max(20, (int) ceil($chars / 1800)),
            'related_projects' => $industry['projects'],
            'related_slugs' => $relatedSlugs,
            'pl' => $pl,
            'en' => $en,
            'news_url' => $news['url'] ?? null,
            'news_title' => $news['headline'] ?? null,
            'chars_pl' => Article::bodyCharacterCount($pl),
            'generated_at' => now(),
        ]);

        $this->sitemap->write();

        return $article;
    }

    private function pickIndustry(?string $topicKey): array
    {
        if ($topicKey) {
            foreach (self::INDUSTRIES as $industry) {
                if ($industry['key'] === $topicKey) {
                    return $industry;
                }
            }
            throw new \InvalidArgumentException('Nieznany temat: '.$topicKey);
        }

        $recent = Article::query()
            ->where('source', 'generated')
            ->orderByDesc('id')
            ->limit(8)
            ->pluck('topic_key')
            ->all();

        foreach (self::INDUSTRIES as $industry) {
            if (! in_array($industry['key'], $recent, true)) {
                return $industry;
            }
        }

        return self::INDUSTRIES[array_rand(self::INDUSTRIES)];
    }

    private function catalog(): array
    {
        return Article::query()
            ->published()
            ->orderByDesc('published_at')
            ->get(['slug', 'category', 'pl'])
            ->map(fn (Article $article) => [
                'slug' => $article->slug,
                'category' => $article->category,
                'title' => $article->pl['title'] ?? $article->slug,
            ])
            ->all();
    }

    private function researchNews(array $industry): array
    {
        $today = now('Europe/Warsaw')->toDateString();
        $data = $this->grok->json(
            <<<PROMPT
Jesteś analitykiem rynku dla software house'u GESOFT (Polska, Laravel, Vue, Android).
Dziś jest {$today}. Znajdź JEDEN aktualny news (max 14 dni) dotyczący branży: {$industry['label']}.
News ma dotyczyć problemów firm w Polsce/UE: przepisy, koszty, kadry, KSeF, e-Doręczenia, SENT, BDO, RODO, no-show, prowizje platform, kontrola PIP/WIOŚ/GITD, brak ludzi, ceny energii.
Nie zmyślaj. Podaj prawdziwy tytuł, datę i URL źródła (gov.pl, biznes.gov.pl, GUS, ISAP, PAP, Rzeczpospolita, Puls Biznesu, branżowy związek). Jeśli nie znajdziesz twardego newsa z 14 dni, weź nowelizację/komunikat urzędowy z ostatnich 90 dni i zaznacz to.

JSON:
{
  "headline": "",
  "url": "https://...",
  "source": "",
  "date": "YYYY-MM-DD",
  "summary": "6-10 zdań po polsku",
  "business_pain": "co boli właściciela firmy",
  "it_angle": "jakie oprogramowanie na zamówienie to spina, bez obietnicy cudu",
  "facts": [{"claim": "", "url": "https://..."}]
}
PROMPT,
            true
        );

        if (empty($data['headline']) || empty($data['url'])) {
            throw new \RuntimeException('Grok nie znalazł wiarygodnego newsa dla branży '.$industry['label']);
        }

        return $data;
    }

    private function planArticle(array $industry, array $news, array $catalog): array
    {
        $catalogText = collect($catalog)->take(40)->map(fn ($row) => $row['slug'].' — '.$row['title'])->implode("\n");

        $plan = $this->grok->json(
            <<<PROMPT
Zaplanuj artykuł SEO po polsku dla GESOFT.pl.
Branża: {$industry['label']}
News: {$news['headline']}
URL: {$news['url']}
Data: {$news['date']}
Streszczenie: {$news['summary']}
Ból: {$news['business_pain']}
Kąt IT: {$news['it_angle']}

Zasady:
- Artykuł ma 14-16 nagłówków h2, każdy z 3-4 akapitami w fazie pisania (łącznie ≥ 40 000 znaków ciała BEZ FAQ).
- Inspiracja newsem, ale treść = problemy działalności + rozwiązania IT (Laravel, Vue, Android).
- Uczciwie: SaaS gdy standard; własne gdy model nietypowy. Nie palimy działającego systemu.
- Nie zmyślaj liczb GUS/GITD. Cytuj tylko fakty z newsa i ogólne obowiązki (KSeF 1.02/1.04.2026, e-Doręczenia CEIDG 1.10.2026 / KRS 1.04.2025).
- category: industry (albo business jeśli KSeF/RODO ogólne).
- related_slugs: 3-5 istniejących slugów z katalogu.
- seo_phrase: główna fraza do **pogrubienia**.
- Głos: „Wy/Wasza firma”, druga osoba mnoga.

Katalog wewnętrznych artykułów (slug — tytuł):
{$catalogText}

JSON:
{
  "slug": "program-dla-...-bez-polskich-znakow",
  "category": "industry",
  "seo_phrase": "",
  "pl_title": "",
  "pl_excerpt": "",
  "pl_seo_title": "max 70 znaków | GESOFT",
  "pl_seo_description": "max 155 znaków",
  "pl_keywords": "fraza1, fraza2",
  "en_title": "",
  "en_excerpt": "",
  "en_seo_title": "",
  "en_seo_description": "",
  "en_keywords": "",
  "related_slugs": ["slug"],
  "sections": [
    {"h2": "", "goal": "co ten rozdział ma zrobić", "must_include": ["fakt albo obowiązek"]}
  ]
}
PROMPT
        );

        if (empty($plan['sections']) || count($plan['sections']) < 10) {
            throw new \RuntimeException('Plan artykułu ma za mało sekcji.');
        }

        $plan['pl_title'] = $plan['pl_title'] ?? ('Oprogramowanie dla branży '.$industry['label']);
        $plan['pl_excerpt'] = $plan['pl_excerpt'] ?? ($news['business_pain'] ?? '');
        $plan['pl_seo_title'] = $plan['pl_seo_title'] ?? ($plan['pl_title'].' | GESOFT');
        $plan['pl_seo_description'] = $plan['pl_seo_description'] ?? $plan['pl_excerpt'];
        $plan['pl_keywords'] = $plan['pl_keywords'] ?? $plan['seo_phrase'];
        $plan['category'] = in_array($plan['category'] ?? '', ['industry', 'business', 'laravel', 'security'], true)
            ? $plan['category']
            : 'industry';

        return $plan;
    }

    private function introBlocks(array $plan, array $news, array $relatedSlugs): array
    {
        $phrase = $plan['seo_phrase'] ?? $plan['pl_title'];
        $linkList = $this->linkHint($relatedSlugs);

        $data = $this->grok->json(
            <<<PROMPT
Napisz WSTĘP artykułu GESOFT (3-4 akapity type p). Każdy akapit 700-1100 znaków. Poprawna polszczyzna.
Tytuł: {$plan['pl_title']}
Fraza SEO do **pogrubienia**: {$phrase}
News (zlinkuj URL markdown): {$news['headline']} {$news['url']} ({$news['date']})
{$news['summary']}
Wewnętrzne linki do użycia (markdown [tekst](/artykuly/slug)): {$linkList}
Zasady markup: **fraza**, *niuans*, ++data/kara/obowiązek++, [tekst](https://...) i [tekst](/artykuly/slug) oraz [kontakt](/kontakt).
Nie obiecuj „AI samo zaksięguje”. GESOFT = Laravel + Vue + Android, Paweł Matusiak. Oferta 24 h.
JSON: {"blocks":[{"type":"p","text":"..."}]}
PROMPT
        );

        return $this->normalizeBlocks($data['blocks'] ?? []);
    }

    private function sectionBlocks(array $plan, array $section, int $n, int $total, array $news, array $relatedSlugs, array $catalog): array
    {
        $phrase = $plan['seo_phrase'] ?? $plan['pl_title'];
        $h2 = $section['h2'] ?? ('Rozdział '.$n);
        $goal = $section['goal'] ?? '';
        $must = implode('; ', $section['must_include'] ?? []);
        $linkList = $this->linkHint($relatedSlugs);

        $data = $this->grok->json(
            <<<PROMPT
Napisz rozdział {$n}/{$total} artykułu GESOFT.
h2: {$h2}
Cel: {$goal}
Musi zawierać: {$must}
Fraza SEO **pogrubiona** kilka razy: {$phrase}
News w tle: {$news['headline']} {$news['url']}
Linki wewnętrzne: {$linkList}
Każdy rozdział: najpierw block h2, potem 3-5 bloków p (każdy 650-1000 znaków), jeden ul LUB ol (5-8 punktów), opcjonalnie h3 + 1 p.
Markup: **pogrubienie fraz SEO**, *kursywa*, ++podkreślenie dat i ostrzeżeń++, linki markdown.
Głos: Wy/Wasza firma. Poprawna polszczyzna, zero lania wody, zero zmyślonych liczb.
Zachęta do [kontaktu](/kontakt) naturalnie, nie w każdym zdaniu.
JSON: {"blocks":[{"type":"h2","text":"..."},{"type":"p","text":"..."}]}
Dozwolone type: h2, h3, p, ul, ol, callout (callout ma title i text).
PROMPT
        );

        $blocks = $this->normalizeBlocks($data['blocks'] ?? []);
        if (! $blocks) {
            $blocks = [
                ['type' => 'h2', 'text' => $h2],
                ['type' => 'p', 'text' => $goal.' **'.$phrase.'** jest narzędziem operacji, nie slajdem. Szczegóły newsa: ['.$news['headline'].']('.$news['url'].').'],
            ];
        }
        if (($blocks[0]['type'] ?? '') !== 'h2') {
            array_unshift($blocks, ['type' => 'h2', 'text' => $h2]);
        }

        return $blocks;
    }

    private function faqBlock(array $plan, array $news, array $relatedSlugs): array
    {
        $linkList = $this->linkHint($relatedSlugs);
        $data = $this->grok->json(
            <<<PROMPT
10 pytań FAQ do artykułu „{$plan['pl_title']}”.
News: {$news['headline']} {$news['url']}
Odpowiedzi 400-900 znaków, rzeczowe, z linkiem wewnętrznym gdzie pasuje: {$linkList}
Jedno pytanie o KSeF (1 lutego / 1 kwietnia 2026), jedno o to czy GESOFT zastępuje gotowiec (nie z zasady), jedno jak zamówić ([/kontakt], 24 h).
JSON: {"items":[{"q":"...","a":"..."}]}
PROMPT
        );

        $items = [];
        foreach ($data['items'] ?? [] as $item) {
            if (! empty($item['q']) && ! empty($item['a'])) {
                $items[] = ['q' => (string) $item['q'], 'a' => (string) $item['a']];
            }
        }
        if (count($items) < 6) {
            $items[] = [
                'q' => 'Jak zamówić wycenę?',
                'a' => 'Opiszcie branżę i ból procesu na [kontakt](/kontakt). GESOFT wraca z ofertą w 24 godziny. Jeśli SaaS wystarczy — napiszemy to wprost.',
            ];
        }

        return ['type' => 'faq', 'items' => array_slice($items, 0, 10)];
    }

    private function expansionBlocks(array $plan, array $news, array $relatedSlugs, int $current): array
    {
        $need = self::MIN_CHARS - $current;
        $phrase = $plan['seo_phrase'] ?? $plan['pl_title'];
        $linkList = $this->linkHint($relatedSlugs);
        $data = $this->grok->json(
            <<<PROMPT
Artykuł ma {$current} znaków, brakuje jeszcze ok. {$need}. Dopisz 1 h2 i 5-6 długich akapitów p (900-1200 znaków każdy) plus ul.
Temat: {$plan['pl_title']}
Fraza: {$phrase}
News: {$news['headline']} {$news['url']}
Linki: {$linkList}
To ma być konkret: checklista wdrożenia, koszt chaosu, jak rozmawiać z dostawcą, czego GESOFT nie obiecuje.
JSON: {"blocks":[...]}
PROMPT
        );

        return $this->normalizeBlocks($data['blocks'] ?? []);
    }

    private function englishLocale(array $plan, array $pl, array $news): array
    {
        $titles = $this->grok->json(
            <<<PROMPT
Translate to professional British English (not marketing fluff). Keep meaning.
JSON:
{
  "title": "...",
  "excerpt": "...",
  "seoTitle": "...",
  "seoDescription": "...",
  "keywords": "..."
}
PL title: {$pl['title']}
excerpt: {$pl['excerpt']}
seoTitle: {$pl['seoTitle']}
seoDescription: {$pl['seoDescription']}
keywords: {$pl['keywords']}
PROMPT
        );

        $enContent = [];
        $chunk = [];
        foreach ($pl['content'] as $block) {
            $chunk[] = $block;
            if (count($chunk) >= 8 || ($block['type'] ?? '') === 'faq') {
                $enContent = array_merge($enContent, $this->translateBlocks($chunk, $news));
                $chunk = [];
            }
        }
        if ($chunk) {
            $enContent = array_merge($enContent, $this->translateBlocks($chunk, $news));
        }

        return [
            'title' => $titles['title'] ?? ($plan['en_title'] ?? $pl['title']),
            'excerpt' => $titles['excerpt'] ?? ($plan['en_excerpt'] ?? $pl['excerpt']),
            'seoTitle' => $titles['seoTitle'] ?? ($plan['en_seo_title'] ?? $pl['seoTitle']),
            'seoDescription' => $titles['seoDescription'] ?? ($plan['en_seo_description'] ?? $pl['seoDescription']),
            'keywords' => $titles['keywords'] ?? ($plan['en_keywords'] ?? $pl['keywords']),
            'content' => $enContent,
        ];
    }

    private function translateBlocks(array $blocks, array $news): array
    {
        $payload = json_encode($blocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $data = $this->grok->json(
            <<<PROMPT
Translate these article blocks to professional British English. Keep types, keep markdown ** * ++ and [text](/path) and https links. Keep /kontakt. Do not drop blocks.
News context: {$news['headline']}
JSON: {"blocks":[...]}
Input: {$payload}
PROMPT
        );

        $out = $this->normalizeBlocks($data['blocks'] ?? []);

        return $out ?: $blocks;
    }

    private function ensureConversion(array $blocks, array $relatedSlugs, string $phrase): array
    {
        $blob = json_encode($blocks, JSON_UNESCAPED_UNICODE);
        $needKontakt = ! str_contains((string) $blob, '/kontakt');
        $internal = preg_match_all('#\]\(/artykuly/#', (string) $blob) ?: 0;

        if ($needKontakt || $internal < 2) {
            $links = [];
            foreach (array_slice($relatedSlugs, 0, 3) as $slug) {
                $links[] = '['.$slug.'](/artykuly/'.$slug.')';
            }
            $blocks = $this->insertBeforeFaq($blocks, [[
                'type' => 'p',
                'text' => 'Jeśli **'.$phrase.'** ma zejść z slajdu na proces, [opiszcie firmę na kontakcie](/kontakt). GESOFT wraca z ofertą w 24 godziny. Warto zestawić ten tekst z '.implode(', ', $links).' — te wdrożenia spinamy tym samym silnikiem (Laravel, Vue, Android), inną kartą zasobu.',
            ]]);
        }

        return $blocks;
    }

    private function insertBeforeFaq(array $blocks, array $extra): array
    {
        $faqIndex = null;
        foreach ($blocks as $i => $block) {
            if (($block['type'] ?? '') === 'faq') {
                $faqIndex = $i;
                break;
            }
        }
        if ($faqIndex === null) {
            return array_merge($blocks, $extra);
        }

        array_splice($blocks, $faqIndex, 0, $extra);

        return $blocks;
    }

    private function normalizeBlocks(array $blocks): array
    {
        $out = [];
        foreach ($blocks as $block) {
            if (! is_array($block) || empty($block['type'])) {
                continue;
            }
            $type = $block['type'];
            if (! in_array($type, ['h2', 'h3', 'p', 'ul', 'ol', 'callout', 'faq'], true)) {
                continue;
            }
            if ($type === 'ul' || $type === 'ol') {
                $items = array_values(array_filter($block['items'] ?? [], fn ($item) => is_string($item) && $item !== ''));
                if ($items) {
                    $out[] = ['type' => $type, 'items' => $items];
                }
                continue;
            }
            if ($type === 'callout') {
                $out[] = [
                    'type' => 'callout',
                    'title' => (string) ($block['title'] ?? ''),
                    'text' => (string) ($block['text'] ?? ''),
                ];
                continue;
            }
            if ($type === 'faq') {
                $items = [];
                foreach ($block['items'] ?? [] as $item) {
                    if (! empty($item['q']) && ! empty($item['a'])) {
                        $items[] = ['q' => (string) $item['q'], 'a' => (string) $item['a']];
                    }
                }
                if ($items) {
                    $out[] = ['type' => 'faq', 'items' => $items];
                }
                continue;
            }
            $text = (string) ($block['text'] ?? '');
            if ($text !== '') {
                $out[] = ['type' => $type, 'text' => $text];
            }
        }

        return $out;
    }

    private function pickRelatedSlugs(array $suggested, array $catalog, string $self): array
    {
        $valid = [];
        $known = array_column($catalog, 'slug');
        foreach ($suggested as $slug) {
            if (is_string($slug) && $slug !== $self && in_array($slug, $known, true)) {
                $valid[] = $slug;
            }
        }
        foreach ($catalog as $row) {
            if (count($valid) >= 5) {
                break;
            }
            if ($row['slug'] !== $self && ! in_array($row['slug'], $valid, true)) {
                $valid[] = $row['slug'];
            }
        }

        return array_slice($valid, 0, 5);
    }

    private function linkHint(array $slugs): string
    {
        return collect($slugs)->map(fn ($slug) => '/artykuly/'.$slug)->implode(', ');
    }

    private function uniqueSlug(string $slug): string
    {
        $slug = Str::slug($slug);
        if ($slug === '') {
            $slug = 'artykul-'.now('Europe/Warsaw')->format('Ymd-Hi');
        }
        $base = $slug;
        $i = 2;
        while (Article::query()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
