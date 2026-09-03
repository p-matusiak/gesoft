<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <h1>{{ $locale === 'en' ? 'GESOFT services' : 'Usługi GESOFT' }}</h1>
    <p>
        {{ $locale === 'en'
            ? 'Websites, web applications, Android, B2B panels and API integrations. Scope follows your process, not a catalogue.'
            : 'Strony, aplikacje webowe, Android, panele B2B i integracje API. Zakres ustalamy po Twoim procesie, nie z katalogu.' }}
    </p>
    <ul>
        @foreach ($services as $service)
            <li>
                <a href="https://gesoft.pl/uslugi/{{ $service['slug'] }}"><strong>{{ $service['navLabel'] }}</strong></a>
                — {{ $service['lead'] }}
            </li>
        @endforeach
    </ul>
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a></p>
</article>
