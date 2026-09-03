<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>{{ $locale === 'en' ? 'Custom web applications and systems for companies' : 'Dedykowane aplikacje webowe i systemy dla firm' }}</h1>
    <p>Laravel · Vue.js · Android · {{ $locale === 'en' ? 'API integrations' : 'integracje API' }}</p>
    <p>
        {{ $locale === 'en'
            ? 'We design web apps, B2B panels, CRM, bookings, KSeF integrations and Android. You describe the process — within 24 hours we come back with a net quote, or we say a ready-made tool is a better fit.'
            : 'Projektujemy aplikacje webowe, panele B2B, CRM, rezerwacje, integracje KSeF i Android. Opisujesz proces — w 24 godziny wracamy z wyceną netto albo mówimy, że lepiej wziąć gotowy program.' }}
    </p>
    <h2>{{ $locale === 'en' ? 'Services' : 'Usługi' }}</h2>
    <ul>
        @foreach ($services as $service)
            <li>
                <a href="https://gesoft.pl/uslugi/{{ $service['slug'] }}">{{ $service['h1'] }}</a>
                — {{ $service['description'] }}
            </li>
        @endforeach
    </ul>
    <p>
        <a href="https://gesoft.pl/portfolio">{{ $locale === 'en' ? 'Inspirations' : 'Inspiracje' }}</a>
        ·
        <a href="https://gesoft.pl/artykuly">{{ $locale === 'en' ? 'Articles' : 'Artykuły' }}</a>
        ·
        <a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a>
    </p>
    <p>GESOFT Paweł Matusiak · NIP 9372553467 · <a href="mailto:biuro@gesoft.pl">biuro@gesoft.pl</a> · <a href="tel:+48517123374">+48 517 123 374</a></p>
</article>
