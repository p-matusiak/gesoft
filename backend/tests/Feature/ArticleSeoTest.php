<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArticleSeoTest extends TestCase
{
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
