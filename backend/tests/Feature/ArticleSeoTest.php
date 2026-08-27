<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArticleSeoTest extends TestCase
{
    public function test_rss_feed_lists_published_articles(): void
    {
        $response = $this->get('/rss.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/rss+xml; charset=UTF-8');
        $response->assertSee('<rss version="2.0"', false);
        $response->assertSee('GESOFT — artykuły', false);
        $response->assertSee('/artykuly/system-rezerwacji-stolikow-online-restauracja', false);
        $response->assertSee('https://gesoft.pl/rss.xml', false);
    }

    public function test_english_rss_feed_uses_english_titles(): void
    {
        $response = $this->get('/rss-en.xml');

        $response->assertOk();
        $response->assertSee('GESOFT articles', false);
        $response->assertSee('lang=en', false);
    }

    public function test_article_listing_injects_seo_and_noscript_index(): void
    {
        $response = $this->get('/artykuly');

        $response->assertOk();
        $response->assertSee('<title>Artykuły: system rezerwacji, restauracja, salon, gabinet | GESOFT</title>', false);
        $response->assertSee('Blog', false);
        $response->assertSee('/artykuly/system-rezerwacji-stolikow-online-restauracja', false);
    }

    public function test_article_page_injects_article_meta_and_body(): void
    {
        $response = $this->get('/artykuly/bezpieczenstwo-aplikacji-laravel');

        $response->assertOk();
        $response->assertSee('<title>Bezpieczeństwo Laravel: CSRF, XSS, SQL injection | GESOFT</title>', false);
        $response->assertSee('property="og:type" content="article"', false);
        $response->assertSee('BlogPosting', false);
        $response->assertSee('CSRF', false);
        $response->assertSee('OWASP', false);
    }

    public function test_unknown_article_returns_404_and_noindex(): void
    {
        $response = $this->get('/artykuly/nieistniejacy-artykul');

        $response->assertNotFound();
        $response->assertSee('noindex, nofollow', false);
        $response->assertSee('Nie znaleziono artykułu', false);
    }

    public function test_listing_filter_changes_title(): void
    {
        $response = $this->get('/artykuly?kategoria=security');

        $response->assertOk();
        $response->assertSee('<title>Artykuły: bezpieczeństwo - GESOFT</title>', false);
    }

    public function test_industry_article_includes_faq_schema(): void
    {
        $response = $this->get('/artykuly/system-rezerwacji-stolikow-online-restauracja');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('System rezerwacji stolików online', false);
    }

    public function test_tech_article_has_faq_schema(): void
    {
        $response = $this->get('/artykuly/dlaczego-laravel-na-aplikacje-biznesowe');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('Laravel', false);
    }

    public function test_housing_cooperative_article_cites_gus(): void
    {
        $response = $this->get('/artykuly/oprogramowanie-dla-spoldzielni-mieszkaniowej');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('spółdzielni', false);
        $response->assertSee('stat.gov.pl', false);
    }

    public function test_escape_room_article_in_index(): void
    {
        $listing = $this->get('/artykuly');
        $listing->assertOk();
        $listing->assertSee('/artykuly/system-rezerwacji-escape-room', false);

        $article = $this->get('/artykuly/system-rezerwacji-escape-room');
        $article->assertOk();
        $article->assertSee('FAQPage', false);
        $article->assertSee('escape room', false);
    }

    public function test_niche_diet_catering_article(): void
    {
        $response = $this->get('/artykuly/program-dla-cateringu-dietetycznego');

        $response->assertOk();
        $response->assertSee('diety pudełkowej', false);
        $response->assertSee('FAQPage', false);
    }

    public function test_ksef_article_uses_official_dates(): void
    {
        $response = $this->get('/artykuly/ksef-obowiazkowy-w-aplikacji-firmowej');

        $response->assertOk();
        $response->assertSee('1 lutego 2026', false);
        $response->assertSee('1 kwietnia 2026', false);
        $response->assertSee('ksef.podatki.gov.pl', false);
        $response->assertSee('FAQPage', false);
    }

    public function test_english_article_uses_english_title(): void
    {
        $response = $this->get('/artykuly/oprogramowanie-dla-firmy-transportowej?lang=en');

        $response->assertOk();
        $response->assertSee('Transport company software', false);
        $response->assertSee('lang="en"', false);
        $response->assertSee('hreflang="pl"', false);
        $response->assertSee('hreflang="en"', false);
    }

    public function test_static_pages_have_self_canonical_and_language_pair(): void
    {
        $pl = $this->get('/o-nas');
        $pl->assertOk();
        $pl->assertSee('rel="canonical" href="https://gesoft.pl/o-nas"', false);
        $pl->assertSee('hreflang="en" href="https://gesoft.pl/o-nas?lang=en"', false);
        $pl->assertSee('<title>O nas - GESOFT | Paweł Matusiak</title>', false);

        $en = $this->get('/o-nas?lang=en');
        $en->assertOk();
        $en->assertSee('rel="canonical" href="https://gesoft.pl/o-nas?lang=en"', false);
        $en->assertSee('property="og:url" content="https://gesoft.pl/o-nas?lang=en"', false);
        $en->assertSee('hreflang="pl" href="https://gesoft.pl/o-nas"', false);
        $en->assertSee('<title>About - GESOFT | Paweł Matusiak</title>', false);
        $en->assertSee('lang="en"', false);

        $homeEn = $this->get('/?lang=en');
        $homeEn->assertOk();
        $homeEn->assertSee('rel="canonical" href="https://gesoft.pl/?lang=en"', false);
    }

    public function test_inspirations_page_has_self_canonical(): void
    {
        $pl = $this->get('/portfolio');
        $pl->assertOk();
        $pl->assertSee('rel="canonical" href="https://gesoft.pl/portfolio"', false);
        $pl->assertSee('hreflang="en" href="https://gesoft.pl/portfolio?lang=en"', false);
        $pl->assertSee('<title>Inspiracje - GESOFT | Przykłady projektów</title>', false);

        $en = $this->get('/portfolio?lang=en');
        $en->assertOk();
        $en->assertSee('rel="canonical" href="https://gesoft.pl/portfolio?lang=en"', false);
        $en->assertSee('<title>Inspirations - GESOFT | Project Examples</title>', false);
    }

    public function test_polish_inspiracje_url_redirects_to_portfolio(): void
    {
        $this->get('/inspiracje')->assertRedirect('/portfolio');
        $this->get('/inspiracje?lang=en')->assertRedirect('/portfolio?lang=en');
    }

    public function test_admin_is_noindex(): void
    {
        $response = $this->get('/admin');

        $response->assertOk();
        $response->assertSee('noindex, nofollow', false);
    }

    public function test_english_article_canonical_is_self_not_polish(): void
    {
        $slug = 'oprogramowanie-dla-firmy-transportowej';
        $plUrl = 'https://gesoft.pl/artykuly/'.$slug;
        $enUrl = $plUrl.'?lang=en';

        $en = $this->get('/artykuly/'.$slug.'?lang=en');
        $en->assertOk();
        $en->assertSee('rel="canonical" href="'.$enUrl.'"', false);
        $en->assertSee('property="og:url" content="'.$enUrl.'"', false);
        $en->assertSee('hreflang="en" href="'.$enUrl.'"', false);
        $en->assertSee('hreflang="pl" href="'.$plUrl.'"', false);

        $pl = $this->get('/artykuly/'.$slug);
        $pl->assertOk();
        $pl->assertSee('rel="canonical" href="'.$plUrl.'"', false);
        $pl->assertDontSee('rel="canonical" href="'.$enUrl.'"', false);
        $pl->assertSee('hreflang="en" href="'.$enUrl.'"', false);
    }

    public function test_transport_article_cites_gitd_and_sent(): void
    {
        $response = $this->get('/artykuly/oprogramowanie-dla-firmy-transportowej');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('43 924', false);
        $response->assertSee('gov.pl/web/gitd/sent', false);
        $response->assertSee('ksef.podatki.gov.pl', false);
    }

    public function test_bdo_article_cites_ustawa_and_biznes_gov(): void
    {
        $response = $this->get('/artykuly/bdo-ewidencja-odpadow-w-firmie');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('bdo.mos.gov.pl', false);
        $response->assertSee('biznes.gov.pl', false);
        $response->assertSee('1 stycznia 2025', false);
    }

    public function test_accounting_office_article_cites_ksef_and_pkd(): void
    {
        $response = $this->get('/artykuly/oprogramowanie-dla-biura-rachunkowego');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('69.20.A', false);
        $response->assertSee('1 lutego 2026', false);
        $response->assertSee('ksef.podatki.gov.pl', false);
    }

    public function test_employment_agency_article_cites_kraz_act(): void
    {
        $response = $this->get('/artykuly/program-dla-agencji-zatrudnienia');

        $response->assertOk();
        $response->assertSee('FAQPage', false);
        $response->assertSee('KRAZ', false);
        $response->assertSee('2025 poz. 620', false);
        $response->assertSee('stor.praca.gov.pl', false);
    }

    public function test_industry_listing_filter_and_salon_article(): void
    {
        $listing = $this->get('/artykuly?kategoria=industry');
        $listing->assertOk();
        $listing->assertSee('<title>Artykuły: branża - GESOFT</title>', false);
        $listing->assertSee('/artykuly/system-rezerwacji-online-salon-fryzjerski', false);

        $salon = $this->get('/artykuly/system-rezerwacji-online-salon-fryzjerski');
        $salon->assertOk();
        $salon->assertSee('salonu fryzjerskiego', false);
        $salon->assertSee('FAQPage', false);
    }
}
