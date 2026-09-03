<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    @include('seo.partials.nav')
    <nav>
        <a href="https://gesoft.pl/uslugi">{{ $locale === 'en' ? 'Services' : 'Usługi' }}</a>
        /
        {{ $service['navLabel'] }}
    </nav>
    <h1>{{ $service['h1'] }}</h1>
    <p>{{ $service['lead'] }}</p>
    @foreach ($service['sections'] ?? [] as $section)
        <h2>{{ $section['title'] }}</h2>
        @if (! empty($section['text']))
            <p>{{ $section['text'] }}</p>
        @endif
        @if (! empty($section['items']))
            <ul>
                @foreach ($section['items'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @endif
    @endforeach
    @if (! empty($service['faq']))
        <h2>{{ $locale === 'en' ? 'Frequently asked questions' : 'Najczęściej zadawane pytania' }}</h2>
        <dl>
            @foreach ($service['faq'] as $item)
                <dt>{{ $item['q'] }}</dt>
                <dd>{{ $item['a'] }}</dd>
            @endforeach
        </dl>
    @endif
    @if (! empty($relatedArticles))
        <h2>{{ $locale === 'en' ? 'Related articles' : 'Powiązane artykuły' }}</h2>
        <ul>
            @foreach ($relatedArticles as $article)
                <li><a href="https://gesoft.pl/artykuly/{{ $article['slug'] }}">{{ $article['title'] }}</a></li>
            @endforeach
        </ul>
    @endif
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a></p>
</article>
