<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>{{ $locale === 'en' ? 'Technologies' : 'Technologie' }}</h1>
    <p>
        {{ $locale === 'en'
            ? 'The same proven stack on every job: Laravel, Vue.js, PHP, MySQL or PostgreSQL, native Android (Kotlin), Nginx, Docker, Redis. No experiments on your budget.'
            : 'Ten sam, sprawdzony stack na każdym zleceniu: Laravel, Vue.js, PHP, MySQL albo PostgreSQL, natywny Android (Kotlin), Nginx, Docker, Redis. Bez eksperymentów na Twoim budżecie.' }}
    </p>
    <h2>Laravel · Vue.js · Android</h2>
    <p>
        {{ $locale === 'en'
            ? 'Backend, panels and APIs in Laravel. Interfaces in Vue.js. Field work in Kotlin talking to the same API.'
            : 'Backend, panele i API w Laravelu. Interfejsy w Vue.js. Praca w terenie w Kotlinie, z tym samym API.' }}
    </p>
    <p>
        <a href="https://gesoft.pl/uslugi/laravel-vue">Laravel / Vue</a>
        ·
        <a href="https://gesoft.pl/uslugi/aplikacje-android">Android</a>
        ·
        <a href="https://gesoft.pl/kontakt">Kontakt</a>
    </p>
</article>
