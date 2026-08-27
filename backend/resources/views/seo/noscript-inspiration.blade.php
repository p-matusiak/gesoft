<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    <nav>
        <a href="https://gesoft.pl/">{{ $locale === 'en' ? 'Home' : 'Strona główna' }}</a>
        /
        <a href="https://gesoft.pl/portfolio">{{ $locale === 'en' ? 'Inspirations' : 'Inspiracje' }}</a>
    </nav>
    <h1>{{ $inspiration['title'] }}</h1>
    @if (! empty($inspiration['image']))
        <p><img src="https://gesoft.pl{{ $inspiration['image'] }}" alt="{{ $inspiration['title'] }}" width="720"></p>
    @endif
    <p>{{ $inspiration['description'] }}</p>
    <p style="white-space: pre-line;">{{ $inspiration['fullDescription'] }}</p>
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a></p>
    <p><a href="https://gesoft.pl/portfolio">{{ $locale === 'en' ? 'All inspirations' : 'Wszystkie inspiracje' }}</a></p>
</article>
