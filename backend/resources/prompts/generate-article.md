Jesteś Grok w projekcie GESOFT (/var/www/gesoft2). Masz dodać **jeden** nowy artykuł SEO do bazy **PostgreSQL**. Pracujesz tak jak w TUI: narzędzia, web_search, pliki, docker exec. **Nie używaj XAI_API_KEY ani HTTP do api.x.ai.** Jesteś już zalogowany.

## Cel
1. Weź katalog z końca tej wiadomości (albo odpal `docker exec gesoft-app php artisan articles:catalog`).
2. Wybierz branżę z `industries`, której `key` **nie ma** w `recent_generated_topics` (jeśli zmienna środowiskowa ARTICLE_TOPIC jest ustawiona — użyj jej).
3. Znajdź **jeden aktualny news** (max 14 dni, Polska/UE) o problemie tej branży w działalności gospodarczej: przepisy, KSeF, e-Doręczenia, SENT, BDO, PIP, koszty, kadry, platformy, kontrole. Preferuj gov.pl, biznes.gov.pl, GUS, ISAP, PAP, Rzeczpospolita. Nie zmyślaj liczb.
4. Napisz artykuł **w dwóch pełnych wersjach: PL i EN** w schemacie GESOFT. Bez angielskiego nie wolno zapisać.
5. Zapisz JSON i wgraj do bazy.

## Wymagania treści
- Ciało **PL bez FAQ ≥ 40 000 znaków** (title + excerpt + bloki bez type=faq, spacje się liczą).
- Ciało **EN bez FAQ ≥ 28 000 znaków**. To ma być prawdziwe tłumaczenie zawodowe (you / your firm), **nie kopia polskiego tekstu**. Ta sama liczba i kolejność bloków (h2/h3/p/ul/ol/callout/faq) co w PL.
- `en.title`, `en.excerpt`, `en.seoTitle`, `en.seoDescription`, `en.keywords` po angielsku. Inny title niż PL.
- Poprawna polszczyzna, druga osoba mnoga (Wy / Wasza firma).
- Markup InlineText: `**fraza SEO**`, `*kursywa*`, `++podkreślenie dat i ostrzeżeń++`, `[tekst](/artykuly/slug)`, `[kontakt](/kontakt)`, `https://` do przepisów. Markup zostaw w EN.
- Wzajemne linki: minimum 3 odnośniki do **istniejących** slugów z katalogu (w PL i w EN).
- Zachęta do oferty GESOFT w 24 h przez `/kontakt`. Uczciwie: SaaS gdy standard, własne (Laravel + Vue + Android, Paweł Matusiak) gdy model nie mieści się w pudełku. Nie palimy działającego systemu. Nie zastępujemy tachografu, BDO.gov, FK, PIP.
- 2 callouty, 10 FAQ na końcu **osobno w PL i osobno w EN**.
- category: industry (albo business).
- relatedProjects z listy projects branży; relatedSlugs: 3–5 istniejących.

## Bloki content
type: h2 | h3 | p | ul | ol | callout | faq  
callout: title + text  
faq: items [{q,a}] — jeden blok faq na końcu locale.

## Zapis
Zapisz kompletny JSON do:
`backend/storage/app/generated/article-YYYYMMDD-HHMM.json`

Kształt:
```json
{
  "slug": "program-dla-...",
  "category": "industry",
  "topic_key": "horeca",
  "publishedAt": "YYYY-MM-DD",
  "relatedProjects": ["restaurant"],
  "relatedSlugs": ["istniejacy-slug"],
  "newsUrl": "https://...",
  "newsTitle": "...",
  "pl": {"title":"","excerpt":"","seoTitle":"","seoDescription":"","keywords":"","content":[]},
  "en": {"title":"","excerpt":"","seoTitle":"","seoDescription":"","keywords":"","content":[]}
}
```

Policz znaki PL bez FAQ i EN bez FAQ. Jeśli PL < 40000 albo EN < 28000 — dopisz rozdziały do odpowiedniego locale (nie do FAQ) i nadpisz plik. Nie wklejaj polskiego do `en`.

Potem:
```
docker exec gesoft-app php artisan articles:store /var/www/backend/storage/app/generated/NAZWA.json
```
(ścieżka **w kontenerze**). Jeśli store padnie przez za mało znaków — popraw plik i ponów. Nie kończ, dopóki komenda nie wypisze „Zapisano”.

Na koniec w odpowiedzi podaj slug, liczbę znaków i URL newsa.
