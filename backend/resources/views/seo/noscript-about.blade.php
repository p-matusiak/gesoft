<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>{{ $locale === 'en' ? 'About GESOFT' : 'O GESOFT' }}</h1>
    <p>
        {{ $locale === 'en'
            ? 'GESOFT is a software house represented by Paweł Matusiak. We design, code and ship Laravel, Vue.js and Android applications. From quote to launch you talk to the people who build the system.'
            : 'GESOFT to software house, który reprezentuje Paweł Matusiak. Projektujemy, kodujemy i wdrażamy aplikacje Laravel, Vue.js i Android. Od wyceny do wdrożenia rozmawiasz z osobami, które budują system.' }}
    </p>
    <p>
        {{ $locale === 'en'
            ? 'We use the same stack on every job. The code and repository stay with you after handover. 6-month warranty on defects. NDA on request. NIP 9372553467, Poland.'
            : 'Na każdym zleceniu ten sam stack. Kod i repozytorium po odbiorze zostają u Ciebie. 6 miesięcy gwarancji na błędy. NDA na życzenie. NIP 9372553467, Polska.' }}
    </p>
    <p><a href="https://gesoft.pl/autor/pawel-matusiak">{{ $locale === 'en' ? 'Author page: Paweł Matusiak' : 'Strona autora: Paweł Matusiak' }}</a></p>
    <p><a href="https://gesoft.pl/uslugi">{{ $locale === 'en' ? 'Services' : 'Usługi' }}</a> · <a href="https://gesoft.pl/kontakt">Kontakt</a></p>
</article>
