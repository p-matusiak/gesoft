<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>Paweł Matusiak</h1>
    <p>{{ $locale === 'en' ? 'Founder / software developer at GESOFT.' : 'Założyciel i programista w GESOFT.' }}</p>
    <p>
        {{ $locale === 'en'
            ? 'Designs and ships Laravel, Vue.js and Android applications for companies: bookings, B2B panels, CRM, KSeF and field apps. Direct contact from quote to launch.'
            : 'Projektuje i wdraża aplikacje Laravel, Vue.js i Android dla firm: rezerwacje, panele B2B, CRM, KSeF i aplikacje terenowe. Bezpośredni kontakt od wyceny do wdrożenia.' }}
    </p>
    <p>GESOFT Paweł Matusiak · NIP 9372553467 · <a href="mailto:biuro@gesoft.pl">biuro@gesoft.pl</a></p>
    @if (! empty($articles))
        <h2>{{ $locale === 'en' ? 'Articles' : 'Artykuły' }}</h2>
        <ul>
            @foreach ($articles as $article)
                <li><a href="https://gesoft.pl/artykuly/{{ $article['slug'] }}">{{ $article['title'] }}</a></li>
            @endforeach
        </ul>
    @endif
    <p><a href="https://gesoft.pl/o-nas">{{ $locale === 'en' ? 'About GESOFT' : 'O GESOFT' }}</a> · <a href="https://gesoft.pl/kontakt">Kontakt</a></p>
</article>
