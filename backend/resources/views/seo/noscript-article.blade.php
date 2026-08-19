<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    <nav>
        <a href="https://gesoft.pl/">{{ $locale === 'en' ? 'Home' : 'Strona główna' }}</a>
        /
        <a href="https://gesoft.pl/artykuly">{{ $locale === 'en' ? 'Articles' : 'Artykuły' }}</a>
    </nav>
    <h1>{{ $article['title'] }}</h1>
    <p><time datetime="{{ $article['publishedAt'] ?? '' }}">{{ $article['publishedAt'] ?? '' }}</time></p>
    <p>{{ $article['excerpt'] ?? '' }}</p>
    {!! $bodyHtml !!}
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a></p>
</article>
