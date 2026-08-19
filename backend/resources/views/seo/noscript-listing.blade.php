<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a;">
    <h1>{{ $title }}</h1>
    <p>{{ $description }}</p>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="https://gesoft.pl/artykuly/{{ $article['slug'] }}">{{ $article['title'] }}</a>
                — {{ $article['excerpt'] ?? '' }}
            </li>
        @endforeach
    </ul>
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Contact' : 'Kontakt' }}</a></p>
</article>
