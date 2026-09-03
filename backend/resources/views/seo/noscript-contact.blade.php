<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>{{ $locale === 'en' ? 'Contact GESOFT' : 'Kontakt z GESOFT' }}</h1>
    <p>
        {{ $locale === 'en'
            ? 'Describe a web application, a company system or an Android app. Within 24 hours on business days we come back with a quote or an honest answer.'
            : 'Opisz projekt aplikacji webowej, systemu dla firmy albo aplikacji Android. W 24 godziny w dniach roboczych wracamy z wyceną albo szczerą odpowiedzią.' }}
    </p>
    <h2>{{ $locale === 'en' ? 'Company details' : 'Dane firmy' }}</h2>
    <ul>
        <li>GESOFT Paweł Matusiak</li>
        <li>NIP: 9372553467</li>
        <li>{{ $locale === 'en' ? 'Poland' : 'Polska' }}</li>
        <li>Email: <a href="mailto:biuro@gesoft.pl">biuro@gesoft.pl</a></li>
        <li>{{ $locale === 'en' ? 'Phone' : 'Telefon' }}: <a href="tel:+48517123374">+48 517 123 374</a></li>
        <li>{{ $locale === 'en' ? 'Hours: Mon–Fri 9:00–17:00' : 'Godziny: pon–pt 9:00–17:00' }}</li>
        <li>{{ $locale === 'en' ? 'We issue VAT invoices' : 'Wystawiamy faktury VAT' }}</li>
    </ul>
    <p><a href="https://gesoft.pl/o-nas">{{ $locale === 'en' ? 'About GESOFT' : 'O GESOFT' }}</a> · <a href="https://gesoft.pl/autor/pawel-matusiak">Paweł Matusiak</a></p>
</article>
