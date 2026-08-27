<?php

namespace App\Services\Ai;

use App\Models\Article;
use App\Services\Content\SitemapWriter;
use Illuminate\Support\Str;

class ArticleGenerator
{
    public const MIN_CHARS = 12000;

    public const MIN_CHARS_EN = 8000;

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
        $angle = $this->pickAngle();
        $news = $this->researchNews($industry, $angle);
        $plan = $this->planArticle($industry, $news, $catalog);

        $slug = $this->uniqueSlug((string) ($plan['slug'] ?? Str::slug($plan['pl_title'] ?? $industry['key'])));
        $relatedSlugs = $this->pickRelatedSlugs($plan['related_slugs'] ?? [], $catalog, $slug);

        $plContent = [];
        $plContent = array_merge($plContent, $this->introBlocks($plan, $news, $relatedSlugs));
        $plContent = array_merge($plContent, $this->storyBlocks($plan, $news, $relatedSlugs));

        foreach ($plan['sections'] as $index => $section) {
            $plContent = array_merge($plContent, $this->sectionBlocks($plan, $section, $index + 1, count($plan['sections']), $news, $relatedSlugs, $catalog));
        }

        $plContent[] = $this->ctaBlock($plan);

        $pl = [
            'title' => $plan['pl_title'],
            'excerpt' => $plan['pl_excerpt'],
            'seoTitle' => $plan['pl_seo_title'],
            'seoDescription' => $plan['pl_seo_description'],
            'keywords' => $plan['pl_keywords'],
            'content' => $plContent,
        ];

        $pl['content'] = $this->editLocaleContent($pl['content'], $plan, 'pl');
        $chars = Article::bodyCharacterCount($pl);

        if ($chars < self::MIN_CHARS) {
            $extra = $this->expansionBlocks($plan, $news, $relatedSlugs, $chars);
            $extra = $this->editLocaleContent($extra, $plan, 'pl');
            $pl['content'] = $this->insertBeforeCta($pl['content'], $extra);
            $chars = Article::bodyCharacterCount($pl);
        }

        if ($chars < self::MIN_CHARS) {
            throw new \RuntimeException("Artykuł ma {$chars} znaków (wymagane ".self::MIN_CHARS.'). Nie zapisuję.');
        }

        $pl['content'] = $this->clarifyPolish($pl['content'], $plan);
        $pl['content'] = $this->verifyAndFixPolish($pl['content'], $plan);
        $pl['content'] = $this->ensureConversion($pl['content'], $relatedSlugs, $plan['seo_phrase'] ?? $plan['pl_title']);

        $en = $this->englishLocale($plan, $pl, $news);
        $en['content'] = $this->editLocaleContent($en['content'], $plan, 'en');

        $article = Article::query()->create([
            'slug' => $slug,
            'category' => $plan['category'] ?? 'industry',
            'status' => 'published',
            'source' => 'generated',
            'topic_key' => $industry['key'],
            'published_at' => now('Europe/Warsaw')->toDateString(),
            'read_time' => max(8, (int) ceil($chars / 1500)),
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

    private function pickAngle(): string
    {
        $angles = ['operations', 'staffing', 'costs', 'market', 'service', 'law'];
        $recent = Article::query()
            ->where('source', 'generated')
            ->orderByDesc('id')
            ->limit(5)
            ->get(['news_title', 'pl']);

        $legalHits = 0;
        foreach ($recent as $article) {
            $blob = mb_strtolower((string) ($article->news_title ?? '').' '.($article->pl['title'] ?? ''));
            if (preg_match('/ksef|bdo|sent|pip|rodo|e-doręcz|noweliz|ustaw|kontrola|wioś|gitd|przepis/u', $blob)) {
                $legalHits++;
            }
        }
        if ($legalHits >= 2) {
            $angles = array_values(array_filter($angles, fn (string $angle) => $angle !== 'law'));
        }

        return $angles[array_rand($angles)];
    }

    private function researchNews(array $industry, string $angle): array
    {
        $today = now('Europe/Warsaw')->toDateString();
        $angleHint = match ($angle) {
            'staffing' => 'kadry, grafiki, rotacja, brak ludzi, czas pracy, sezonowi pracownicy — nie przepisy dla zasady',
            'costs' => 'marża, prowizje platform, energia, czynsz, puste kilometry, droższe dostawy — nie taryfikator kar',
            'market' => 'popyt, sezon, no-show, recenzje, konkurencja, zmiana nawyków klientów',
            'service' => 'serwis w terenie, reklamacje, jakość obsługi, terminy u klienta',
            'law' => 'przepis albo kontrola TYLKO jeśli to naprawdę news tygodnia dla tej branży; i tak oś artykułu ma być praca firmy, nie paragraf',
            default => 'codzienny proces: rezerwacje, magazyn, trasa, dokumenty, zmiana na zmianie, kilka systemów obok siebie',
        };

        $data = $this->grok->json(
            <<<PROMPT
Jesteś analitykiem rynku dla software house'u GESOFT. Nie piszesz reklamy.
Dziś jest {$today}. Znajdź JEDEN aktualny materiał (max 14 dni) o branży: {$industry['label']}.

Kąt obowiązkowy: {$angle} — {$angleHint}

Nie skupiaj się wyłącznie na przepisach. KSeF, BDO, SENT, PIP, e-Doręczenia bierz tylko gdy kąt to law albo gdy news bez tego nie istnieje. Preferuj problem operacyjny, koszt, kadry, sezon, platformę albo codzienną pracę firmy.

Źródła: Puls Biznesu, Rzeczpospolita, PAP, GUS, związek branżowy, raport izby, gov.pl gdy naprawdę pasuje. Nie zmyślaj dat, kar, statystyk.
Jeśli nie ma twardego newsa z 14 dni, weź raport/artykuł branżowy z 90 dni o procesie albo kosztach — NIE skacz automatycznie na nowelizację ustawy.
Oddziel fakty od opinii i przewidywań. Jeśli w tle jest projekt ustawy, nazwij go projektem.

JSON:
{
  "headline": "",
  "url": "https://...",
  "source": "",
  "date": "YYYY-MM-DD",
  "angle": "{$angle}",
  "summary": "6-10 zdań po polsku, tylko to, co jest w źródle",
  "audience": "kim jest odbiorca, np. zarządcy nieruchomości",
  "business_pain": "główny problem czytelnika w pracy firmy, nie w kodeksie",
  "thesis": "jedna główna teza artykułu",
  "it_angle": "gdzie technologia może pomóc, bez obietnicy cudu i bez nazwy frameworka",
  "legal_status": "none | in_force | draft | planned | interpretation | opinion",
  "facts": [{"claim": "", "kind": "fact|market|operations|staffing|costs|law|draft|interpretation|opinion|prediction", "url": "https://..."}]
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
Zaplanuj artykuł EKSPERCKI (nie reklamę SEO) po polsku dla GESOFT.pl.
Branża: {$industry['label']}
News: {$news['headline']}
URL: {$news['url']}
Data: {$news['date']}
Status źródła: {$news['legal_status']}
Streszczenie: {$news['summary']}
Odbiorca: {$news['audience']}
Problem: {$news['business_pain']}
Teza: {$news['thesis']}
Gdzie technologia: {$news['it_angle']}

Zasady:
- Jedna główna teza. 6-9 nagłówków h2. Po kontekście zaplanuj 4-6 RÓŻNYCH wątków z pracy tej firmy (kadry, pieniądze, klient, teren, dokumenty, sezon) — nie ten sam problem pod innym tytułem.
- Każdy wątek: proces → zator → it_help (jaka usługa IT pomaga: panel, aplikacja w telefonie, integracja, portal klienta, przypomnienie). Inny wątek = inna pomoc IT.
- Nie skupiaj artykułu na przepisach, chyba że news naprawdę o nich jest.
- Struktura: kontekst → jeden wymyślony przykład firmy (nie klient) + jak IT pomaga w tej historii → wątki z IT (mogą wracać do tej firmy) → SaaS vs dedykowane → GESOFT zbiera wątki → następny krok.
- example_story: typ firmy, skala zaokrąglona, sytuacja, zator, it_help. Bez nazwisk, godzin z minutami i udawanych case studies.
- introduce_gesoft=true TYLKO w sekcji zbierającej wątki. W wątkach pisz o usłudze IT bez marki GESOFT.
- Uczciwie: Excel / SaaS / integracja / własne. Nie palimy działającego systemu.
- Nie zmyślaj liczb. Cytuj tylko fakty ze źródła. Projekt ustawy zawsze oznacz jako projekt. Nie wklejaj KSeF/e-Doręczeń, jeśli temat ich nie dotyczy.
- category: industry (albo business jeśli KSeF/RODO ogólne).
- related_slugs: 3-5 istniejących slugów z katalogu.
- seo_phrase: naturalna fraza; nie twórz sekcji pod słowo kluczowe.
- Ton: reporter jak bielsko.info — rzeczowy tytuł, krótki lead, trzecia osoba. Nie „Wy” w każdym zdaniu.

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
  "gesoft_services": ["dedykowana aplikacja webowa"],
  "example_story": {
    "firm": "typ firmy z branży, bez nazwy własnej",
    "scale": "np. kilkanaście aut / kilkadziesiąt lokali",
    "situation": "co się dzieje w pracy",
    "snag": "gdzie się zacina",
    "it_help": "jak usługa IT pomaga w tej historii"
  },
  "sections": [
    {"h2": "", "thread": "kadry|koszty|klienci|teren|dokumenty|sezon", "reader_question": "", "goal": "", "it_help": "jak usługa IT pomaga w tym wątku", "introduce_gesoft": false, "must_include": ["fakt"]}
  ]
}
PROMPT
        );

        if (empty($plan['sections']) || count($plan['sections']) < 6) {
            throw new \RuntimeException('Plan artykułu ma za mało sekcji.');
        }

        $plan['pl_title'] = $plan['pl_title'] ?? ('Oprogramowanie dla branży '.$industry['label']);
        $plan['example_story'] = is_array($plan['example_story'] ?? null) ? $plan['example_story'] : [];
        $plan['thesis'] = $plan['thesis'] ?? ($news['thesis'] ?? ($news['business_pain'] ?? ''));
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

        $style = $this->styleInstructions();
        $legal = $news['legal_status'] ?? 'fact';
        $audience = $news['audience'] ?? '';
        $thesis = $plan['thesis'] ?? ($news['thesis'] ?? '');
        $data = $this->grok->json(
            <<<PROMPT
Napisz LEAD i początek kontekstu jak w artykule na bielsko.info: 3-5 krótkich akapitów type p (często 1-3 zdania). Jedna informacja na akapit.
To nie jest reklama. Nie wspominaj GESOFT, Laravela, Vue ani Androida we wstępie. Trzecia osoba.
Tytuł: {$plan['pl_title']}
Odbiorca: {$audience}
Teza: {$thesis}
Fraza SEO: {$phrase} — pogrub raz, jeśli brzmi naturalnie.
News (zlinkuj URL raz): {$news['headline']} {$news['url']} ({$news['date']})
Status prawny źródła: {$legal} — jeśli draft/planned, napisz wprost, że to nie obowiązujące prawo.
{$news['summary']}
Linki wewnętrzne tylko gdy pogłębiają temat: {$linkList}
Markup: **fraza**, *niuans*, ++data/obowiązek++, [tekst](https://...) i [tekst](/artykuly/slug).
Lead: kto, co, kiedy. Potem skutek dla odbiorcy w codziennej pracy. Wzorzec gazetowy: fakt, potem „oznacza to, że…”. Bez ogólnego wstępu. Nie zaczynaj od ustawy, jeśli news jest o kadrze, koszcie albo procesie.
{$style}
JSON: {"blocks":[{"type":"p","text":"..."}]}
PROMPT
        );

        return $this->normalizeBlocks($data['blocks'] ?? []);
    }

    private function storyBlocks(array $plan, array $news, array $relatedSlugs): array
    {
        $story = $plan['example_story'] ?? [];
        $firm = $story['firm'] ?? ($news['audience'] ?? 'firma z tej branży');
        $scale = $story['scale'] ?? '';
        $situation = $story['situation'] ?? ($news['business_pain'] ?? '');
        $snag = $story['snag'] ?? '';
        $itHelp = $story['it_help'] ?? ($news['it_angle'] ?? '');
        $style = $this->styleInstructions();
        $linkList = $this->linkHint($relatedSlugs);

        $data = $this->grok->json(
            <<<PROMPT
Napisz JEDEN rozdział-przykład (h2 + 4-7 krótkich akapitów p). To wymyślona historyjka, nie klient GESOFT.
Na początku daj znać, że to przykład albo typowa sytuacja. Bez nazwisk, bez godziny z minutami, bez udawanego reportażu.
Firma: {$firm}
Skala: {$scale}
Sytuacja: {$situation}
Zator: {$snag}
Jak pomaga IT: {$itHelp}
News w tle (nie zmyślaj faktów z newsa): {$news['headline']} {$news['url']}
Linki tylko gdy pasują: {$linkList}
Rytm: jak wygląda praca → gdzie się zacina → skutek → jak w TEJ historii pomaga usługa IT (jedna-dwie funkcje). Nie wspominaj marki GESOFT. Trzecia osoba, polszczyzna gazetowa.
{$style}
JSON: {"blocks":[{"type":"h2","text":"..."},{"type":"p","text":"..."}]}
PROMPT
        );

        $blocks = $this->normalizeBlocks($data['blocks'] ?? []);
        if (! $blocks) {
            $blocks = [
                ['type' => 'h2', 'text' => 'Przykład: jak to wygląda w firmie'],
                ['type' => 'p', 'text' => 'Wyobraźmy sobie '.$firm.($scale !== '' ? ' ('.$scale.')' : '').'. '.$situation.' '.$snag],
                ['type' => 'p', 'text' => $itHelp !== '' ? $itHelp : 'W takiej sytuacji pomaga wspólna lista statusów zamiast kilku zeszytów i komunikatorów.'],
            ];
        }
        if (($blocks[0]['type'] ?? '') !== 'h2') {
            array_unshift($blocks, ['type' => 'h2', 'text' => 'Przykład: jak to wygląda w firmie']);
        }

        return $blocks;
    }

    private function sectionBlocks(array $plan, array $section, int $n, int $total, array $news, array $relatedSlugs, array $catalog): array
    {
        $phrase = $plan['seo_phrase'] ?? $plan['pl_title'];
        $h2 = $section['h2'] ?? ('Rozdział '.$n);
        $goal = $section['goal'] ?? '';
        $must = implode('; ', $section['must_include'] ?? []);
        $linkList = $this->linkHint($relatedSlugs);

        $style = $this->styleInstructions();
        $mentionGesoft = ! empty($section['introduce_gesoft']);
        $thread = $section['thread'] ?? '';
        $itHelp = $section['it_help'] ?? '';
        $services = implode(', ', $plan['gesoft_services'] ?? []);
        $gesoftRule = $mentionGesoft
            ? 'To jest sekcja zbierająca wcześniejsze wątki. Pokaż, jak jedna usługa IT może je spiąć. GESOFT przedstaw jako firmę, która może takie rozwiązanie zaprojektować i wykonać. Laravel/Vue/Android tylko jeśli technologia ma znaczenie. Uczciwie: Excel / SaaS / integracja / dedykowane.'
            : 'NIE wspominaj marki GESOFT, Laravela ani oferty. Wątek: '.$thread.'. Najpierw proces i zator, na końcu rozdziału pokaż JAK MOŻE POMÓC USŁUGA IT: '.$itHelp.'. Konkretna funkcja i rezultat (grafik, status w telefonie, jedna karta dokumentu), nie „system IT”. Usługi, które wolno mieć na uwadze: '.$services.'.';
        $question = $section['reader_question'] ?? '';
        $legal = $news['legal_status'] ?? '';
        $story = $plan['example_story'] ?? [];
        $storyHint = trim(($story['firm'] ?? '').' '.($story['scale'] ?? '').' '.($story['situation'] ?? ''));
        $data = $this->grok->json(
            <<<PROMPT
Napisz rozdział {$n}/{$total} artykułu eksperckiego (nie reklamy).
h2: {$h2}
Wątek: {$thread}
Pytanie czytelnika: {$question}
Cel: {$goal}
Jak IT pomaga w tym wątku: {$itHelp}
Musi zawierać: {$must}
Przykład firmy z artykułu (wymyślony, nie klient): {$storyHint}
Wolno wrócić do tej samej firmy. Nie wymyślaj nowej historyjki ani nazwisk.
Fraza SEO: {$phrase} — tylko gdy brzmi naturalnie, nie wbijaj w każdy akapit.
News: {$news['headline']} {$news['url']}
Status prawny: {$legal}
Linki wewnętrzne gdy naprawdę pasują: {$linkList}
{$gesoftRule}
Najpierw block h2, potem 3-6 krótkich akapitów p jak w bielsko.info (1-3 zdania, jedna myśl). Lista TYLKO gdy wyliczasz kroki, pola, daty albo dokumenty.
Jeśli wracasz do przykładu, napisz „w takiej firmie” / „w tym przykładzie”. Bez nowych scenek.
Markup: **pogrubienie**, *kursywa*, ++daty++, linki markdown.
Trzecia osoba. Fakt, potem skutek. Nie kończ wezwaniem do kontaktu. Nie streszczaj rozdziału. Nie zapowiadaj następnego.
{$style}
JSON: {"blocks":[{"type":"h2","text":"..."},{"type":"p","text":"..."}]}
Dozwolone type: h2, h3, p, ul, ol.
PROMPT
        );

        $blocks = $this->normalizeBlocks($data['blocks'] ?? []);
        if (! $blocks) {
            $blocks = [
                ['type' => 'h2', 'text' => $h2],
                ['type' => 'p', 'text' => $goal.' **'.$phrase.'**. Źródło: ['.$news['headline'].']('.$news['url'].').'],
            ];
        }
        if (($blocks[0]['type'] ?? '') !== 'h2') {
            array_unshift($blocks, ['type' => 'h2', 'text' => $h2]);
        }

        return $blocks;
    }

    private function ctaBlock(array $plan): array
    {
        return [
            'type' => 'callout',
            'title' => 'Następny krok',
            'text' => 'Jeżeli gotowe rozwiązania nie obsługują tego procesu, możemy przeanalizować obecny obieg danych i określić, czy lepsza będzie integracja, rozbudowa obecnego systemu czy dedykowana aplikacja. Opis sytuacji wystarczy wysłać przez [kontakt](/kontakt).',
        ];
    }

    private function expansionBlocks(array $plan, array $news, array $relatedSlugs, int $current): array
    {
        $need = self::MIN_CHARS - $current;
        $phrase = $plan['seo_phrase'] ?? $plan['pl_title'];
        $linkList = $this->linkHint($relatedSlugs);
        $style = $this->styleInstructions();
        $data = $this->grok->json(
            <<<PROMPT
Artykuł ma {$current} znaków, brakuje jeszcze ok. {$need} do pokrycia tematu. Dopisz 1 h2 o problemie operacyjnym i 3-5 akapitów p. Nie parafrazuj wstępu. Nie wspominaj GESOFT, chyba że to jedyny sposób nazwać dostawcę — lepiej opisać proces.
Temat: {$plan['pl_title']}
Fraza: {$phrase} — nie wbijaj.
News: {$news['headline']} {$news['url']}
Linki gdy pasują: {$linkList}
Pogłęb: konkretny proces w firmie, pola dokumentów, decyzja Excel vs SaaS vs integracja. Przykład jako „przykładowo…”, bez fikcyjnej scenki z godziną.
{$style}
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
Translate these expert-article blocks to professional British English. Keep types, keep markdown ** * ++ and [text](/path) and https links. Keep /kontakt. Do not drop blocks.
Do not turn this into marketing copy. Do not calque slogans. Avoid “This isn’t X. It’s Y.”, “Here’s the thing”, and LinkedIn closers. Vary sentence length. Keep GESOFT only where it already appears.
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

        if ($needKontakt) {
            $blocks[] = [
                'type' => 'p',
                'text' => 'Jeżeli gotowe narzędzia nie pokrywają tego procesu, można [opisać obieg danych przez kontakt](/kontakt) i sprawdzić, czy wystarczy integracja, rozbudowa obecnego systemu, czy osobna aplikacja.',
            ];
        } elseif ($internal < 2 && $relatedSlugs) {
            $links = [];
            foreach (array_slice($relatedSlugs, 0, 2) as $slug) {
                $links[] = '['.$slug.'](/artykuly/'.$slug.')';
            }
            $blocks = $this->insertBeforeCta($blocks, [[
                'type' => 'p',
                'text' => 'Szerzej o pokrewnych procesach: '.implode(' oraz ', $links).'.',
            ]]);
        }

        return $blocks;
    }

    private function insertBeforeCta(array $blocks, array $extra): array
    {
        $ctaIndex = null;
        foreach ($blocks as $i => $block) {
            $type = $block['type'] ?? '';
            if ($type === 'callout' || $type === 'faq') {
                $ctaIndex = $i;
                break;
            }
        }
        if ($ctaIndex === null) {
            return array_merge($blocks, $extra);
        }

        array_splice($blocks, $ctaIndex, 0, $extra);

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

    private function styleInstructions(): string
    {
        return <<<'TEXT'
STYL — reporter portalu jak bielsko.info, nie copywriter SEO:
- Czytelność gazety: rzeczowy tytuł, krótki lead (kto/co/kiedy), krótkie akapity 1–3 zdań, jedna myśl na akapit.
- Trzecia osoba: „firma”, „zarządca”, „biuro”, nie „Wy” w każdym zdaniu.
- Fakt, potem skutek: data, liczba, nazwa — potem „oznacza to, że…”.
- Polszczyzna gazetowa, jasna na pierwszy odczyt. Podmiot + orzeczenie. Jedna myśl w zdaniu. Bez kali: „adresować wyzwanie”, „w ramach zapewnienia”, „implementować rozwiązanie”.
- Spójność: kolejny akapit wynika z poprzedniego. Ta sama rzecz — ta sama nazwa. Puste zdania („sytuacja wymaga odpowiedniego podejścia”) — wyciąć.
- Jeśli zwykłe zdanie wystarcza, użyj zwykłego zdania.
- Najpierw problem i proces (kadry, koszt, sezon, magazyn, trasa), potem technologia. Nie oś na przepisach, chyba że news naprawdę o nich jest.
- Nie schemat „teza – zastrzeżenie – doprecyzowanie”. Nie seryjne „To nie X. To Y.”
- Nie używaj: „W dzisiejszych czasach”, „W dynamicznie zmieniającym się świecie”, „Warto pamiętać, że”, „Kluczowe jest”, „Co istotne”, „Podsumowując”, „warto zauważyć”, „należy podkreślić”.
- Nie lista w każdym rozdziale. Nie pytania retoryczne na otwarcie każdej sekcji.
- Nie powtarzaj frazy SEO. Nie streszczaj rozdziału. Nie zapowiadaj następnego.
- Przykłady jako „przykładowo…”, bez fikcyjnych scenek z godziną.
- Nie wymyślaj dat, kar, statystyk, klientów GESOFT.
- Projekt ustawy zawsze nazwij projektem.
- Jeden wymyślony przykład firmy (jasno jako przykład, nie klient). Potem wątki mogą do niego wracać.
- W każdym wątku: proces, zator, potem jak usługa IT może pomóc (funkcja, nie marka). Inny wątek — inna pomoc.
- Marka GESOFT i Laravel/Vue/Android tylko gdy ta sekcja ma je wprowadzić.
- Excel / SaaS / integracja mogą wystarczyć.
- Nagłówki informują, jak w prasie: „Jak ograniczyć…”, nie „Co X, a czego Y”.
- Nie naśladuj wcześniejszych wygenerowanych artykułów.
TEXT;
    }

    private function editLocaleContent(array $blocks, array $plan, string $locale): array
    {
        $out = [];
        $chunk = [];
        foreach ($blocks as $block) {
            $chunk[] = $block;
            $flush = count($chunk) >= 8 || ($block['type'] ?? '') === 'faq';
            if ($flush) {
                $out = array_merge($out, $this->editChunk($chunk, $plan, $locale));
                $chunk = [];
            }
        }
        if ($chunk) {
            $out = array_merge($out, $this->editChunk($chunk, $plan, $locale));
        }

        return $out ?: $blocks;
    }

    private function editChunk(array $chunk, array $plan, string $locale): array
    {
        $payload = json_encode($chunk, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $style = $this->styleInstructions();
        $title = $plan['pl_title'] ?? '';
        $lang = $locale === 'en'
            ? 'British English, you/your firm. Do not calque slogans. Do not add a run of “This isn’t X. It’s Y.”'
            : 'polszczyzna gazetowa, trzecia osoba, krótkie akapity jak bielsko.info';

        try {
            $data = $this->grok->json(
                <<<PROMPT
Jesteś doświadczonym polskim redaktorem branżowym. To redakcja szkicu eksperckiego, nie pisanie reklamy od nowa.

Artykuł: {$title}
Język: {$lang}

W głowie (NIE w JSON): usuń powtórzenia, parafrazy, „nie X tylko Y”, punchline'y, reklamę, zbędne GESOFT, puste frazesy, kalę z angielskiego. Każde zdanie musi mieć jasny podmiot i sens przy pierwszym czytaniu. Kolejny akapit ma wynikać z poprzedniego. Ta sama rzecz — ta sama nazwa. Sprawdź, czy przypuszczenie nie udaje faktu.

Popraw bloki na spokojną, poprawną polszczyznę prasową. Zachowaj fakty, daty, nazwy, cytaty, linki markdown, ** * ++, type, liczbę bloków i kolejność. Nie dodawaj faktów. Zdanie zostaje tylko jeśli niesie treść.

Cicha kontrola: nie opisuj, co wyciąłeś.

{$style}

Nie wklejaj audytu ani komentarza redaktora. Zwróć WYŁĄCZNIE te same bloki po redakcji, ta sama liczba, te same type.
JSON: {"blocks":[...]}
Input: {$payload}
PROMPT
            );
        } catch (\Throwable) {
            return $chunk;
        }

        $edited = $this->normalizeBlocks($data['blocks'] ?? []);

        return $this->sameBlockShape($chunk, $edited) ? $edited : $chunk;
    }

    private function groupByHeading(array $blocks): array
    {
        $groups = [];
        $current = [];
        foreach ($blocks as $block) {
            if (($block['type'] ?? '') === 'h2' && $current) {
                $groups[] = $current;
                $current = [];
            }
            $current[] = $block;
        }
        if ($current) {
            $groups[] = $current;
        }

        return $groups;
    }

    private function sameBlockShape(array $original, array $edited): bool
    {
        if (count($edited) !== count($original)) {
            return false;
        }
        foreach ($edited as $i => $block) {
            if (($block['type'] ?? '') !== ($original[$i]['type'] ?? '')) {
                return false;
            }
        }

        return true;
    }

    private function clarifyPolish(array $blocks, array $plan): array
    {
        $out = [];
        foreach ($this->groupByHeading($blocks) as $group) {
            $out = array_merge($out, $this->clarifyPolishChunk($group, $plan));
        }

        return $out ?: $blocks;
    }

    private function verifyAndFixPolish(array $blocks, array $plan): array
    {
        $out = [];
        foreach ($this->groupByHeading($blocks) as $group) {
            $current = $group;
            for ($attempt = 0; $attempt < 2; $attempt++) {
                $check = $this->verifyPolishStyle($current, $plan);
                if ($check['pass']) {
                    break;
                }
                $current = $this->fixPolishStyle($current, $plan, $check['issues']);
            }
            $out = array_merge($out, $current);
        }

        return $out ?: $blocks;
    }

    private function verifyPolishStyle(array $chunk, array $plan): array
    {
        $payload = json_encode($chunk, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $title = $plan['pl_title'] ?? '';

        try {
            $data = $this->grok->json(
                <<<PROMPT
Oceń styl językowy fragmentu artykułu. Jesteś surowym polskim redaktorem. Nie poprawiaj tekstu — tylko ocena.

Artykuł: {$title}

Zalicz (pass=true) TYLKO gdy:
- każde zdanie da się zrozumieć za pierwszym razem,
- każde ma jasny podmiot i orzeczenie,
- akapity się spajają,
- nie ma kali („adresować wyzwanie”, „w ramach zapewnienia”, „implementować rozwiązanie”, „w kontekście rosnących wyzwań”),
- nie ma pustych frazesów,
- polszczyzna jest poprawna.

Jeśli cokolwiek jest niejasne, niezgrabne albo brzmi jak AI — pass=false i wypisz konkretne usterki po polsku (cytat albo opis).

JSON:
{"pass": true, "issues": ["..."]}
Fragment: {$payload}
PROMPT
            );
        } catch (\Throwable) {
            return ['pass' => true, 'issues' => []];
        }

        $issues = [];
        foreach ($data['issues'] ?? [] as $issue) {
            if (is_string($issue) && $issue !== '') {
                $issues[] = $issue;
            }
        }

        $pass = ($data['pass'] ?? false) === true || ($data['pass'] ?? '') === 'true';
        if ($issues !== [] || ! $pass) {
            return [
                'pass' => false,
                'issues' => $issues ?: ['tekst niejasny albo brzmi jak wygenerowany'],
            ];
        }

        return ['pass' => true, 'issues' => []];
    }

    private function fixPolishStyle(array $chunk, array $plan, array $issues): array
    {
        $payload = json_encode($chunk, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $title = $plan['pl_title'] ?? '';
        $issueText = $issues ? implode("\n- ", $issues) : 'tekst niejasny, brzmi jak wygenerowany';

        try {
            $data = $this->grok->json(
                <<<PROMPT
Fragment nie przeszedł weryfikacji stylu. Popraw tak, by był zrozumiały za pierwszym czytaniem. Prosta, poprawna polszczyzna gazetowa.

Artykuł: {$title}

Usterki:
- {$issueText}

Zasady poprawki:
- jasny podmiot i orzeczenie,
- jedna myśl w zdaniu,
- spójne akapity,
- bez kali i pustych frazesów,
- zachowaj fakty, daty, linki, ** * ++, type, liczbę i kolejność bloków.
- nie dodawaj treści.

JSON: {"blocks":[...]}
Input: {$payload}
PROMPT
            );
        } catch (\Throwable) {
            return $chunk;
        }

        $edited = $this->normalizeBlocks($data['blocks'] ?? []);

        return $this->sameBlockShape($chunk, $edited) ? $edited : $chunk;
    }

    private function clarifyPolishChunk(array $chunk, array $plan): array
    {
        $payload = json_encode($chunk, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $title = $plan['pl_title'] ?? '';

        try {
            $data = $this->grok->json(
                <<<PROMPT
Jesteś polskim redaktorem językowym w gazecie. Nie piszesz od nowa. Poprawiasz jasność i spójność.

Artykuł: {$title}

Dla każdego zdania:
- da się je zrozumieć za pierwszym razem,
- jest podmiot i orzeczenie,
- jedna myśl,
- poprawna polszczyzna (przypadek, rodzaj, przyimek),
- zero kali („adresować wyzwanie”, „w ramach zapewnienia”, „implementować rozwiązanie”).

Dla akapitów:
- następny wynika z poprzedniego,
- ta sama rzecz ma tę samą nazwę,
- wyciąć puste frazesy.

Zachowaj fakty, daty, linki, ** * ++, type, liczbę bloków i kolejność. Nie dodawaj treści.

JSON: {"blocks":[...]} te same type, ta sama liczba.
Input: {$payload}
PROMPT
            );
        } catch (\Throwable) {
            return $chunk;
        }

        $edited = $this->normalizeBlocks($data['blocks'] ?? []);

        return $this->sameBlockShape($chunk, $edited) ? $edited : $chunk;
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
