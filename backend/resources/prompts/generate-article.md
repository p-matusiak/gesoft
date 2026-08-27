Jesteś Grok w projekcie GESOFT (/var/www/gesoft2). Masz dodać **jeden** nowy artykuł ekspercki do bazy **PostgreSQL**. Pracujesz tak jak w TUI: narzędzia, web_search, pliki, docker exec. **Nie używaj XAI_API_KEY ani HTTP do api.x.ai.** Jesteś już zalogowany.

To nie jest typowy artykuł SEO ani tekst reklamowy. Zasady redakcji są w dalszej części tej wiadomości (`article-voice.md`). Stosuj je od researchu. **Nie publikuj pierwszej wersji.**

Pisz czytelnie jak artykuł na bielsko.info: rzeczowy tytuł, krótki lead z faktami, krótkie akapity (1–3 zdania), trzecia osoba, liczby i daty, potem co to oznacza dla firmy. Nie naśladuj wcześniejszych wygenerowanych artykułów z katalogu.

## Cel
1. Weź katalog z końca tej wiadomości (albo `docker exec gesoft-app php artisan articles:catalog`).
2. Wybierz branżę z `industries`, której `key` **nie ma** w `recent_generated_topics` (jeśli `ARTICLE_TOPIC` jest ustawione — użyj jej).
3. Znajdź **jeden aktualny materiał** (max 14 dni, Polska/UE) o problemie tej branży w **codziennej pracy firmy**: kadry, koszty, sezon, no-show, prowizje platform, serwis, magazyn, grafiki, reklamacje, popyt. **Nie skupiaj się wyłącznie na przepisach.** KSeF, BDO, SENT, PIP bierz tylko gdy to naprawdę jest news tygodnia. Preferuj Puls Biznesu, Rzeczpospolitą, PAP, GUS, izbę branżową; gov.pl gdy pasuje. Nie zmyślaj. Otwórz źródło i przeczytaj je. Jeśli nie ma newsa z 14 dni — raport o procesie/kosztach z 90 dni, nie automatyczna nowelizacja.
4. Uzupełnij dane wejściowe i napisz artykuł **w dwóch pełnych wersjach: PL i EN** w schemacie bloków GESOFT. Bez angielskiego nie wolno zapisać.
5. Cicha redakcja PL i EN. Nie opisuj procesu.
6. Zapisz JSON i wgraj do bazy.

## Dane wejściowe (wypełnij przed pisaniem)

```
TEMAT: …
ODBIORCA: … (np. zarządcy nieruchomości / restauratorzy / firmy transportowe)
GŁÓWNY PROBLEM CZYTELNIKA: …
ŹRÓDŁA: … (prawdziwe URL-e, które otworzyłeś)
USŁUGI GESOFT ZWIĄZANE Z TEMATEM: … (z `relatedProjects` branży: aplikacja webowa, panel, CRM/ERP, portal klienta, automatyzacja, integracja API, Android — tylko te, które naprawdę pasują)
GŁÓWNA FRAZA SEO: …
FRAZY POMOCNICZE: …
GŁÓWNA TEZA: jedno zdanie
WĄTKI (4–6): … (np. grafiki, no-show, magazyn, faktura) — przy każdym: jak może pomóc usługa IT
PRZYKŁAD (wymyślony, nie klient): typ firmy, sytuacja, zator, jak pomaga IT
```

## Pipeline (kolejność obowiązkowa)
1. Katalog + branża.
2. Materiał i źródła. Analiza: fakty / rynek / operacje / kadry / koszty; prawo tylko gdy naprawdę jest w źródle.
3. Jedna teza + plan: kontekst, **jeden wymyślony przykład firmy** (nie klient), potem 4–6 wątków. W przykładzie i w każdym wątku: jak może pomóc usługa IT. Marka GESOFT dopiero na końcu.
4. Szkic PL: lead, fakty, historyjka-przykład, wątki. Excel / SaaS / integracja / dedykowane — uczciwie.
5. Cicha redakcja PL: treść, potem **język**. Każde zdanie jasne na pierwszy odczyt.
5a. **Weryfikacja stylu** każdego rozdziału. Jeśli nie przejdzie (niejasne zdania, kala, brak spójności) — popraw na zrozumiałą polszczyznę i sprawdź jeszcze raz. Nie opisuj kontroli.
6. Tłumaczenie EN (British English). Ta sama liczba i kolejność bloków.
7. Cicha redakcja EN. Nie opisuj kontroli.
8. Policz znaki PL i EN bez FAQ. Jeśli za krótko na pokrycie tematu — pogłęb proces albo źródło, nie parafrazuj. Nie rozciągaj tekstu dla objętości.
9. `articles:store`. Nie kończ, dopóki komenda nie wypisze „Zapisano”.

## Wymagania zapisu
- Ciało **PL bez FAQ ≥ 12 000 znaków**. Ciało **EN bez FAQ ≥ 8 000 znaków**. To jest dolny próg merytoryczny, nie cel. Nie powtarzaj zdań, żeby dobić limitu.
- `en.title` / `excerpt` / `seoTitle` / `seoDescription` / `keywords` po angielsku. Inny title niż PL.
- Markup: `**fraza**` oszczędnie, `*kursywa*`, `++daty i obowiązki++`, `[tekst](/artykuly/slug)`, `[kontakt](/kontakt)`, `https://` do źródeł.
- Minimum 2 naturalne linki do **istniejących** slugów (PL i EN).
- Jedno spokojne CTA na końcu (callout albo ostatni akapit z `/kontakt`). Bez „już dziś”, bez „oferta w 24 h” jako hasła.
- GESOFT nie w każdym rozdziale; usługa IT (funkcja, rezultat) — tak, w każdym wątku. Laravel/Vue/Android tylko gdy technologia ma znaczenie dla problemu.
- category: industry (albo business).
- relatedProjects z listy projects branży; relatedSlugs: 3–5 istniejących.
- Akapity **nierównej** długości. Lista tylko gdy wyliczenie jest listą. FAQ zbędne.

## Bloki content
type: h2 | h3 | p | ul | ol | callout | faq
callout: title + text
faq: items [{q,a}] — opcjonalnie, na końcu locale.

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

Policz znaki PL bez FAQ i EN bez FAQ. Jeśli PL < 12000 albo EN < 8000 — pogłęb treść merytorycznie i nadpisz plik. Nie wklejaj polskiego do `en`.

Potem:
```
docker exec gesoft-app php artisan articles:store /var/www/backend/storage/app/generated/NAZWA.json
```
(ścieżka **w kontenerze**). Jeśli store padnie przez za mało znaków — popraw plik i ponów. Nie kończ, dopóki komenda nie wypisze „Zapisano”.

Na koniec w odpowiedzi podaj tylko slug, liczbę znaków i URL newsa. Nie opisuj, jak pisałeś ani co poprawiła redakcja.
