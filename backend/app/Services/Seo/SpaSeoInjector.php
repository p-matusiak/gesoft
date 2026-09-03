<?php

namespace App\Services\Seo;

use App\Services\Content\ArticleRepository;
use App\Services\Content\InspirationCatalog;
use App\Services\Content\ServiceCatalog;
use Illuminate\Http\Request;

class SpaSeoInjector
{
    private const BASE_URL = 'https://gesoft.pl';

    public function __construct(
        private ArticleRepository $articles,
        private InspirationCatalog $inspirations,
        private ServiceCatalog $services,
    ) {
    }

    public function inject(string $html, Request $request): array
    {
        $locale = $request->query('lang') === 'en' ? 'en' : 'pl';
        $path = '/'.ltrim($request->path(), '/');
        if ($path === '/index.php') {
            $path = '/';
        }

        $seo = $this->resolve($path, $locale, $request->query('kategoria'));

        if ($seo === null) {
            return [$html, 200];
        }

        $html = $this->replaceTitle($html, $seo['title']);
        $html = preg_replace('/<html lang="[^"]*">/', '<html lang="'.$locale.'">', $html, 1) ?? $html;
        $html = $this->replaceMeta($html, 'description', $seo['description']);
        $html = $this->replaceMeta($html, 'keywords', $seo['keywords']);
        $html = $this->replaceMeta($html, 'robots', $seo['robots']);
        $html = $this->replaceMeta($html, 'og:title', $seo['title'], true);
        $html = $this->replaceMeta($html, 'og:description', $seo['description'], true);
        $html = $this->replaceMeta($html, 'og:type', $seo['ogType'], true);
        $html = $this->replaceMeta($html, 'og:url', $seo['url'], true);
        if (! empty($seo['image'])) {
            $html = $this->replaceMeta($html, 'og:image', $seo['image'], true);
            $html = $this->replaceMeta($html, 'twitter:image', $seo['image']);
        }
        $html = $this->replaceMeta($html, 'twitter:title', $seo['title']);
        $html = $this->replaceMeta($html, 'twitter:description', $seo['description']);
        $html = $this->replaceLink($html, 'canonical', $seo['url']);
        $html = $this->replaceHreflang($html, $seo['path']);
        $html = $this->replaceJsonLd($html, $seo['jsonLd']);
        $html = $this->replaceNoscript($html, $seo['noscript']);

        return [$html, $seo['status']];
    }

    private function resolve(string $path, string $locale, mixed $category): ?array
    {
        if (str_starts_with($path, '/admin')) {
            return [
                'title' => 'GESOFT',
                'description' => '',
                'keywords' => 'GESOFT',
                'path' => $path,
                'url' => $this->localeUrl('/', 'pl'),
                'ogType' => 'website',
                'robots' => 'noindex, nofollow',
                'status' => 200,
                'jsonLd' => $this->organizationJsonLd($locale),
                'noscript' => $this->defaultNoscript($locale),
            ];
        }

        if (preg_match('#^/artykuly/([a-z0-9-]+)$#', $path, $matches)) {
            return $this->articleSeo($this->baseSeo('/artykuly', $locale, $path), $matches[1], $locale);
        }

        if ($path === '/artykuly') {
            return $this->listingSeo($this->baseSeo($path, $locale), $locale, is_string($category) ? $category : null);
        }

        if (preg_match('#^/portfolio/([A-Za-z0-9_-]+)$#', $path, $matches)) {
            return $this->inspirationSeo($matches[1], $locale);
        }

        if ($path === '/portfolio') {
            return $this->portfolioListingSeo($locale);
        }

        if (preg_match('#^/uslugi/([a-z0-9-]+)$#', $path, $matches)) {
            return $this->serviceSeo($matches[1], $locale);
        }

        if ($path === '/autor/pawel-matusiak') {
            return $this->authorSeo($locale);
        }

        if ($this->isPublicPage($path)) {
            return $this->baseSeo($path, $locale);
        }

        return [
            'title' => $locale === 'en' ? 'Page not found | GESOFT' : 'Nie znaleziono strony | GESOFT',
            'description' => $locale === 'en'
                ? 'This page does not exist or has been moved.'
                : 'Ta strona nie istnieje albo została przeniesiona.',
            'keywords' => 'GESOFT',
            'path' => $path,
            'url' => $this->localeUrl($path, $locale),
            'ogType' => 'website',
            'robots' => 'noindex, nofollow',
            'status' => 404,
            'jsonLd' => $this->organizationJsonLd($locale),
            'noscript' => view('seo.noscript-missing', ['locale' => $locale])->render(),
        ];
    }

    private function baseSeo(string $seoPath, string $locale, ?string $canonicalPath = null): array
    {
        $path = $canonicalPath ?? $seoPath;
        $copy = $this->pageSeo($seoPath, $locale);

        return [
            'title' => $copy['title'],
            'description' => $copy['description'],
            'keywords' => $copy['keywords'],
            'path' => $path,
            'url' => $this->localeUrl($path, $locale),
            'ogType' => 'website',
            'robots' => 'index, follow',
            'status' => 200,
            'jsonLd' => $this->organizationJsonLd($locale),
            'noscript' => $this->pageNoscript($seoPath, $locale),
        ];
    }

    private function isPublicPage(string $path): bool
    {
        return in_array($path, ['/', '/o-nas', '/uslugi', '/technologie', '/portfolio', '/kontakt', '/artykuly'], true);
    }

    private function pageNoscript(string $path, string $locale): string
    {
        $services = $this->services->all($locale);

        return match ($path) {
            '/' => view('seo.noscript-home', ['locale' => $locale, 'services' => $services])->render(),
            '/kontakt' => view('seo.noscript-contact', ['locale' => $locale])->render(),
            '/o-nas' => view('seo.noscript-about', ['locale' => $locale])->render(),
            '/uslugi' => view('seo.noscript-services', ['locale' => $locale, 'services' => $services])->render(),
            '/technologie' => view('seo.noscript-technologies', ['locale' => $locale])->render(),
            default => $this->defaultNoscript($locale),
        };
    }

    private function listingSeo(array $defaults, string $locale, ?string $category): array
    {
        $allowed = ['industry', 'laravel', 'security', 'business'];
        $category = in_array($category, $allowed, true) ? $category : null;
        $listed = $this->articles->listed($locale, $category);

        $labels = [
            'industry' => $locale === 'en' ? 'industry' : 'branża',
            'laravel' => 'Laravel',
            'security' => $locale === 'en' ? 'security' : 'bezpieczeństwo',
            'business' => $locale === 'en' ? 'business' : 'biznes',
        ];

        if ($category) {
            $defaults['title'] = $locale === 'en'
                ? 'Articles: '.$labels[$category].' - GESOFT'
                : 'Artykuły: '.$labels[$category].' - GESOFT';
        }

        $defaults['jsonLd'] = [
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => $defaults['title'],
            'description' => $defaults['description'],
            'url' => $this->localeUrl('/artykuly', $locale),
            'inLanguage' => $locale === 'en' ? 'en-US' : 'pl-PL',
            'publisher' => ['@type' => 'Organization', 'name' => 'GESOFT', 'url' => self::BASE_URL],
            'blogPost' => array_map(fn (array $article) => [
                '@type' => 'BlogPosting',
                'headline' => $article['title'] ?? '',
                'url' => self::BASE_URL.'/artykuly/'.($article['slug'] ?? ''),
                'datePublished' => $article['publishedAt'] ?? null,
            ], $listed),
        ];

        $defaults['noscript'] = view('seo.noscript-listing', [
            'title' => $defaults['title'],
            'description' => $defaults['description'],
            'articles' => $listed,
            'locale' => $locale,
        ])->render();

        return $defaults;
    }

    private function portfolioListingSeo(string $locale): array
    {
        $defaults = $this->baseSeo('/portfolio', $locale);
        $inspirations = $this->inspirations->all($locale);

        $defaults['jsonLd'] = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $defaults['title'],
            'description' => $defaults['description'],
            'url' => $this->localeUrl('/portfolio', $locale),
            'inLanguage' => $locale === 'en' ? 'en-US' : 'pl-PL',
            'hasPart' => array_map(fn (array $item) => [
                '@type' => 'CreativeWork',
                'name' => $item['title'],
                'url' => $this->localeUrl('/portfolio/'.$item['key'], $locale),
            ], $inspirations),
        ];

        $defaults['noscript'] = view('seo.noscript-portfolio', [
            'title' => $defaults['title'],
            'description' => $defaults['description'],
            'inspirations' => $inspirations,
            'locale' => $locale,
        ])->render();

        return $defaults;
    }

    private function inspirationSeo(string $key, string $locale): array
    {
        $inspiration = $this->inspirations->find($key, $locale);
        $path = '/portfolio/'.$key;

        if (! $inspiration) {
            return [
                'title' => $locale === 'en' ? 'Inspiration not found | GESOFT' : 'Nie znaleziono inspiracji | GESOFT',
                'description' => $locale === 'en'
                    ? 'This inspiration does not exist or has been moved.'
                    : 'Ta inspiracja nie istnieje albo została przeniesiona.',
                'keywords' => 'GESOFT',
                'path' => $path,
                'url' => $this->localeUrl($path, $locale),
                'ogType' => 'website',
                'robots' => 'noindex, nofollow',
                'status' => 404,
                'jsonLd' => $this->organizationJsonLd($locale),
                'noscript' => view('seo.noscript-missing', ['locale' => $locale])->render(),
            ];
        }

        $title = $locale === 'en'
            ? $inspiration['title'].' — inspiration | GESOFT'
            : $inspiration['title'].' — inspiracja | GESOFT';
        $description = $inspiration['description'] !== ''
            ? $inspiration['description']
            : ($locale === 'en'
                ? 'Project example from GESOFT: '.$inspiration['title']
                : 'Przykład projektu GESOFT: '.$inspiration['title']);
        $url = $this->localeUrl($path, $locale);
        $image = self::BASE_URL.$inspiration['image'];

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $inspiration['title'].', inspiracje, GESOFT',
            'path' => $path,
            'url' => $url,
            'ogType' => 'website',
            'image' => $image,
            'robots' => 'index, follow',
            'status' => 200,
            'jsonLd' => [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $inspiration['title'],
                'headline' => $title,
                'description' => $description,
                'url' => $url,
                'inLanguage' => $locale === 'en' ? 'en-US' : 'pl-PL',
                'image' => $image,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => 'GESOFT',
                    'url' => self::BASE_URL,
                ],
                'about' => [
                    '@type' => 'CreativeWork',
                    'name' => $inspiration['title'],
                    'description' => $description,
                ],
            ],
            'noscript' => view('seo.noscript-inspiration', [
                'inspiration' => $inspiration,
                'locale' => $locale,
            ])->render(),
        ];
    }

    private function serviceSeo(string $slug, string $locale): array
    {
        $service = $this->services->find($slug, $locale);
        $path = '/uslugi/'.$slug;

        if (! $service) {
            return [
                'title' => $locale === 'en' ? 'Service not found | GESOFT' : 'Nie znaleziono usługi | GESOFT',
                'description' => $locale === 'en'
                    ? 'This service page does not exist or has been moved.'
                    : 'Ta strona usługi nie istnieje albo została przeniesiona.',
                'keywords' => 'GESOFT',
                'path' => $path,
                'url' => $this->localeUrl($path, $locale),
                'ogType' => 'website',
                'robots' => 'noindex, nofollow',
                'status' => 404,
                'jsonLd' => $this->organizationJsonLd($locale),
                'noscript' => view('seo.noscript-missing', ['locale' => $locale])->render(),
            ];
        }

        $url = $this->localeUrl($path, $locale);
        $relatedArticles = [];
        foreach ($service['relatedArticles'] ?? [] as $articleSlug) {
            $raw = $this->articles->find((string) $articleSlug);
            if ($raw) {
                $relatedArticles[] = $this->articles->localized($raw, $locale);
            }
        }

        $faq = $service['faq'] ?? [];
        $serviceLd = [
            '@type' => 'Service',
            'name' => $service['h1'],
            'description' => $service['description'],
            'url' => $url,
            'provider' => $this->organizationJsonLd($locale),
            'areaServed' => 'PL',
        ];
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [$this->organizationJsonLd($locale), $serviceLd],
        ];
        if ($faq !== []) {
            $jsonLd['@graph'][] = [
                '@type' => 'FAQPage',
                'mainEntity' => array_map(fn (array $item) => [
                    '@type' => 'Question',
                    'name' => $item['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
                ], $faq),
            ];
        }

        return [
            'title' => $service['seoTitle'],
            'description' => $service['description'],
            'keywords' => $service['keywords'],
            'path' => $path,
            'url' => $url,
            'ogType' => 'website',
            'robots' => 'index, follow',
            'status' => 200,
            'jsonLd' => $jsonLd,
            'noscript' => view('seo.noscript-service', [
                'service' => $service,
                'relatedArticles' => $relatedArticles,
                'locale' => $locale,
            ])->render(),
        ];
    }

    private function authorSeo(string $locale): array
    {
        $path = '/autor/pawel-matusiak';
        $title = $locale === 'en'
            ? 'Paweł Matusiak — founder, GESOFT'
            : 'Paweł Matusiak — założyciel GESOFT';
        $description = $locale === 'en'
            ? 'Paweł Matusiak designs and ships Laravel, Vue.js and Android applications at GESOFT.'
            : 'Paweł Matusiak projektuje i wdraża aplikacje Laravel, Vue.js i Android w GESOFT.';
        $articles = array_slice($this->articles->listed($locale), 0, 20);

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => 'Paweł Matusiak, GESOFT, Laravel, Vue.js, Android',
            'path' => $path,
            'url' => $this->localeUrl($path, $locale),
            'ogType' => 'profile',
            'robots' => 'index, follow',
            'status' => 200,
            'jsonLd' => [
                '@context' => 'https://schema.org',
                '@type' => 'ProfilePage',
                'mainEntity' => $this->personJsonLd($locale),
                'url' => $this->localeUrl($path, $locale),
            ],
            'noscript' => view('seo.noscript-author', [
                'locale' => $locale,
                'articles' => $articles,
            ])->render(),
        ];
    }

    private function articleSeo(array $defaults, string $slug, string $locale): array
    {
        $raw = $this->articles->find($slug);

        if (! $raw) {
            $defaults['status'] = 404;
            $defaults['robots'] = 'noindex, nofollow';
            $defaults['title'] = $locale === 'en' ? 'Article not found | GESOFT' : 'Nie znaleziono artykułu | GESOFT';
            $defaults['description'] = $locale === 'en'
                ? 'This article does not exist or has been moved.'
                : 'Ten artykuł nie istnieje albo został przeniesiony.';
            $defaults['keywords'] = 'GESOFT';
            $defaults['noscript'] = view('seo.noscript-missing', ['locale' => $locale])->render();

            return $defaults;
        }

        $article = $this->articles->localized($raw, $locale);
        $url = $this->localeUrl('/artykuly/'.$slug, $locale);

        $defaults['title'] = $article['seoTitle'] ?? $article['title'];
        $defaults['description'] = $article['seoDescription'] ?? $article['excerpt'] ?? '';
        $defaults['keywords'] = $article['keywords'] ?? 'Laravel, GESOFT';
        $defaults['url'] = $url;
        $defaults['ogType'] = 'article';
        $defaults['jsonLd'] = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $article['title'] ?? '',
            'description' => $defaults['description'],
            'datePublished' => $article['publishedAt'] ?? null,
            'dateModified' => $article['updatedAt'] ?? $article['publishedAt'] ?? null,
            'inLanguage' => $locale === 'en' ? 'en-US' : 'pl-PL',
            'image' => self::BASE_URL.'/og-image.png',
            'author' => $this->personJsonLd($locale),
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'GESOFT',
                'logo' => ['@type' => 'ImageObject', 'url' => self::BASE_URL.'/logo.png'],
            ],
            'mainEntityOfPage' => $url,
            'keywords' => $defaults['keywords'],
        ];

        $faqs = [];
        foreach ($article['content'] ?? [] as $block) {
            if (($block['type'] ?? '') === 'faq') {
                foreach ($block['items'] ?? [] as $item) {
                    if (! empty($item['q']) && ! empty($item['a'])) {
                        $faqs[] = $item;
                    }
                }
            }
        }

        if ($faqs !== []) {
            $defaults['jsonLd'] = [
                '@context' => 'https://schema.org',
                '@graph' => [
                    $defaults['jsonLd'],
                    [
                        '@type' => 'FAQPage',
                        'mainEntity' => array_map(fn (array $item) => [
                            '@type' => 'Question',
                            'name' => $item['q'],
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $item['a'],
                            ],
                        ], $faqs),
                    ],
                ],
            ];
        }

        $defaults['noscript'] = view('seo.noscript-article', [
            'article' => $article,
            'bodyHtml' => $this->blocksToHtml($article['content'] ?? [], $locale),
            'locale' => $locale,
            'relatedService' => $this->services->relatedForArticle($article, $locale),
        ])->render();

        return $defaults;
    }

    private function pageSeo(string $path, string $locale): array
    {
        $pages = [
            '/' => [
                'pl' => ['title' => 'GESOFT — aplikacje webowe i Android dla firm | wycena 24h', 'description' => 'GESOFT projektuje i wdraża aplikacje Laravel i Vue.js, Android, rezerwacje i KSeF. Bezpłatna wycena w 24 godziny, 6 miesięcy gwarancji.', 'keywords' => 'aplikacje webowe, oprogramowanie dla firm, Laravel, Vue.js, Android, KSeF, GESOFT'],
                'en' => ['title' => 'GESOFT — web and Android apps for companies | quote in 24h', 'description' => 'GESOFT designs and ships Laravel and Vue.js apps, Android, bookings and KSeF. Free quote within 24 hours, 6-month warranty.', 'keywords' => 'web applications, software for companies, Laravel, Vue.js, Android, KSeF, GESOFT'],
            ],
            '/o-nas' => [
                'pl' => ['title' => 'O nas - GESOFT | Paweł Matusiak', 'description' => 'GESOFT — software house. Projektujemy i wdrażamy aplikacje Laravel, Vue.js i Android. Wycena w 24 godziny, 6 miesięcy gwarancji.', 'keywords' => 'o nas, GESOFT, zespół, doświadczenie, firma programistyczna, web development'],
                'en' => ['title' => 'About - GESOFT | Paweł Matusiak', 'description' => 'GESOFT software house. We design and ship Laravel, Vue.js and Android apps. Quote in 24 hours, 6-month warranty.', 'keywords' => 'about us, GESOFT, team, experience, software company, web development'],
            ],
            '/uslugi' => [
                'pl' => ['title' => 'Usługi - GESOFT | Strony, aplikacje, sklepy, CRM', 'description' => 'Kompleksowe usługi webowe: strony internetowe, aplikacje webowe, sklepy e-commerce, systemy CRM/ERP, integracje API, fotografia, filmowanie dronem.', 'keywords' => 'usługi, strony internetowe, aplikacje webowe, sklepy online, CRM, ERP, API, fotografia, dron, SEO'],
                'en' => ['title' => 'Services - GESOFT | Websites, Apps, E-commerce, CRM', 'description' => 'Comprehensive web services: websites, web applications, e-commerce stores, CRM/ERP systems, API integrations, photography, drone footage.', 'keywords' => 'services, websites, web applications, online stores, CRM, ERP, API, photography, drone, SEO'],
            ],
            '/technologie' => [
                'pl' => ['title' => 'Technologie - GESOFT | Laravel, Vue.js, PHP, MySQL', 'description' => 'Poznaj technologie, których używamy: Laravel, Vue.js 3, PHP 8, MySQL 8, TailwindCSS, Docker, Redis, Nginx. Sprawdzone i wydajne rozwiązania.', 'keywords' => 'technologie, Laravel, Vue.js, PHP, MySQL, TailwindCSS, Docker, Redis, Nginx, stack technologiczny'],
                'en' => ['title' => 'Technologies - GESOFT | Laravel, Vue.js, PHP, MySQL', 'description' => 'Discover our tech stack: Laravel, Vue.js 3, PHP 8, MySQL 8, TailwindCSS, Docker, Redis, Nginx. Proven and efficient solutions.', 'keywords' => 'technologies, Laravel, Vue.js, PHP, MySQL, TailwindCSS, Docker, Redis, Nginx, tech stack'],
            ],
            '/portfolio' => [
                'pl' => ['title' => 'Inspiracje - GESOFT | Przykłady projektów', 'description' => 'Przykłady projektów które możemy zbudować: systemy CRM, sklepy internetowe, aplikacje webowe, strony firmowe, aplikacje mobilne Android.', 'keywords' => 'inspiracje, przykłady projektów, CRM, sklepy internetowe, aplikacje webowe, aplikacje Android, strony firmowe'],
                'en' => ['title' => 'Inspirations - GESOFT | Project Examples', 'description' => 'Project examples we can build: CRM systems, e-commerce stores, web applications, corporate websites, Android mobile apps.', 'keywords' => 'inspirations, project examples, CRM, e-commerce, web apps, Android apps, corporate websites'],
            ],
            '/kontakt' => [
                'pl' => ['title' => 'Kontakt - GESOFT | Napisz do nas', 'description' => 'Skontaktuj się z nami! Opisz swój projekt, a my przygotujemy bezpłatną wycenę. Email: biuro@gesoft.pl, Tel: +48 517 123 374.', 'keywords' => 'kontakt, GESOFT, wycena, projekt, email, telefon, formularz kontaktowy'],
                'en' => ['title' => 'Contact - GESOFT | Get in Touch', 'description' => 'Contact us! Describe your project and we will prepare a free quote. Email: biuro@gesoft.pl, Phone: +48 517 123 374.', 'keywords' => 'contact, GESOFT, quote, project, email, phone, contact form'],
            ],
            '/artykuly' => [
                'pl' => ['title' => 'Artykuły: system rezerwacji, restauracja, salon, gabinet | GESOFT', 'description' => 'Artykuły dla właścicieli firm: system rezerwacji stolików, zamówienia online bez prowizji, program do salonu, e-rejestracja, warsztat, panel B2B.', 'keywords' => 'system rezerwacji online, program do restauracji, salon fryzjerski, gabinet lekarski, panel B2B, oprogramowanie na zamówienie, GESOFT'],
                'en' => ['title' => 'Articles: booking systems, restaurants, salons, clinics | GESOFT', 'description' => 'Articles for business owners: table booking, commission-free online orders, salon software, clinic e-registration, workshops, B2B portals.', 'keywords' => 'online booking system, restaurant software, hair salon, medical clinic, B2B portal, custom software, GESOFT'],
            ],
            '/autor/pawel-matusiak' => [
                'pl' => ['title' => 'Paweł Matusiak — założyciel GESOFT', 'description' => 'Paweł Matusiak projektuje i wdraża aplikacje Laravel, Vue.js i Android w GESOFT.', 'keywords' => 'Paweł Matusiak, GESOFT, Laravel, Vue.js'],
                'en' => ['title' => 'Paweł Matusiak — founder, GESOFT', 'description' => 'Paweł Matusiak designs and ships Laravel, Vue.js and Android applications at GESOFT.', 'keywords' => 'Paweł Matusiak, GESOFT, Laravel, Vue.js'],
            ],
        ];

        return $pages[$path][$locale] ?? $pages['/'][$locale];
    }

    private function organizationJsonLd(string $locale): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'GESOFT',
            'legalName' => 'GESOFT Paweł Matusiak',
            'url' => self::BASE_URL,
            'logo' => self::BASE_URL.'/logo.png',
            'email' => 'biuro@gesoft.pl',
            'telephone' => '+48-517-123-374',
            'taxID' => '9372553467',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'PL',
            ],
            'founder' => $this->personJsonLd($locale),
            'description' => $locale === 'en'
                ? 'Custom web applications, Laravel, Vue.js and Android for companies'
                : 'Dedykowane aplikacje webowe, Laravel, Vue.js i Android dla firm',
        ];
    }

    private function personJsonLd(string $locale): array
    {
        return [
            '@type' => 'Person',
            'name' => 'Paweł Matusiak',
            'url' => $this->localeUrl('/autor/pawel-matusiak', $locale),
            'jobTitle' => $locale === 'en' ? 'Founder / software developer' : 'Założyciel / programista',
            'worksFor' => [
                '@type' => 'Organization',
                'name' => 'GESOFT',
                'url' => self::BASE_URL,
            ],
        ];
    }

    private function defaultNoscript(string $locale): string
    {
        return view('seo.noscript-default', ['locale' => $locale])->render();
    }

    private function blocksToHtml(array $blocks, string $locale = 'pl'): string
    {
        $html = '';
        $faqHeading = $locale === 'en' ? 'Frequently asked questions' : 'Najczęściej zadawane pytania';

        foreach ($blocks as $block) {
            $type = $block['type'] ?? '';
            $html .= match ($type) {
                'h2' => '<h2>'.e($block['text'] ?? '').'</h2>',
                'h3' => '<h3>'.e($block['text'] ?? '').'</h3>',
                'p' => '<p>'.$this->inline((string) ($block['text'] ?? '')).'</p>',
                'ul' => '<ul>'.collect($block['items'] ?? [])->map(fn ($item) => '<li>'.$this->inline((string) $item).'</li>')->implode('').'</ul>',
                'ol' => '<ol>'.collect($block['items'] ?? [])->map(fn ($item) => '<li>'.$this->inline((string) $item).'</li>')->implode('').'</ol>',
                'callout' => '<aside><p><strong>'.e($block['title'] ?? '').'</strong></p><p>'.$this->inline((string) ($block['text'] ?? '')).'</p></aside>',
                'faq' => '<section><h2>'.e($block['title'] ?? $faqHeading).'</h2><dl>'.collect($block['items'] ?? [])->map(fn ($item) => '<dt>'.e($item['q'] ?? '').'</dt><dd>'.$this->inline((string) ($item['a'] ?? '')).'</dd>')->implode('').'</dl></section>',
                default => '',
            };
        }

        return $html;
    }

    private function inline(string $text): string
    {
        $escaped = e($text);
        $escaped = (string) preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $escaped);
        $escaped = (string) preg_replace('/\+\+(.+?)\+\+/', '<u>$1</u>', $escaped);
        $escaped = (string) preg_replace('/\*(.+?)\*/', '<em>$1</em>', $escaped);

        return (string) preg_replace_callback(
            '/\[([^\]]+)\]\((\/[^)\s]+|https?:\/\/[^)\s]+)\)/',
            function (array $match) {
                return '<a href="'.e($match[2]).'">'.$match[1].'</a>';
            },
            $escaped
        );
    }

    private function replaceTitle(string $html, string $title): string
    {
        return (string) preg_replace('/<title>.*?<\/title>/s', '<title>'.e($title).'</title>', $html, 1);
    }

    private function replaceMeta(string $html, string $name, string $content, bool $property = false): string
    {
        $attribute = $property ? 'property' : 'name';
        $pattern = '/<meta '.$attribute.'="'.preg_quote($name, '/').'" content="[^"]*">/';
        $tag = '<meta '.$attribute.'="'.e($name).'" content="'.e($content).'">';

        if (preg_match($pattern, $html)) {
            return (string) preg_replace($pattern, $tag, $html, 1);
        }

        return str_replace('</head>', '    '.$tag."\n    </head>", $html);
    }

    private function replaceLink(string $html, string $rel, string $href): string
    {
        $pattern = '/<link rel="'.preg_quote($rel, '/').'" href="[^"]*">/';
        $tag = '<link rel="'.e($rel).'" href="'.e($href).'">';

        if (preg_match($pattern, $html)) {
            return (string) preg_replace($pattern, $tag, $html, 1);
        }

        return str_replace('</head>', '    '.$tag."\n    </head>", $html);
    }

    private function localeUrl(string $path, string $locale): string
    {
        $url = self::BASE_URL.($path === '/' ? '/' : $path);
        if ($locale === 'en') {
            $url .= (str_contains($url, '?') ? '&' : '?').'lang=en';
        }

        return $url;
    }

    private function replaceHreflang(string $html, string $path): string
    {
        $pl = $this->localeUrl($path, 'pl');
        $en = $this->localeUrl($path, 'en');
        $html = (string) preg_replace('/<link rel="alternate" hreflang="pl" href="[^"]*">/', '<link rel="alternate" hreflang="pl" href="'.e($pl).'">', $html, 1);
        $html = (string) preg_replace('/<link rel="alternate" hreflang="en" href="[^"]*">/', '<link rel="alternate" hreflang="en" href="'.e($en).'">', $html, 1);
        $html = (string) preg_replace('/<link rel="alternate" hreflang="x-default" href="[^"]*">/', '<link rel="alternate" hreflang="x-default" href="'.e($pl).'">', $html, 1);

        return $html;
    }

    private function replaceJsonLd(string $html, array $data): string
    {
        $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $replacement = '<script type="application/ld+json">'."\n    ".$json."\n    ".'</script>';

        return (string) preg_replace(
            '/<script type="application\/ld\+json">.*?<\/script>/s',
            $replacement,
            $html,
            1
        );
    }

    private function replaceNoscript(string $html, string $inner): string
    {
        return (string) preg_replace('/<noscript>.*?<\/noscript>/s', '<noscript>'.$inner.'</noscript>', $html, 1);
    }
}
