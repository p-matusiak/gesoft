<article style="max-width: 720px; margin: 0 auto; padding: 24px; font-family: sans-serif; color: #1a1a1a; line-height: 1.6;">
    <nav>
        <a href="https://gesoft.pl/">{{ $locale === 'en' ? 'Home' : 'Strona główna' }}</a>
    </nav>
    <h1>{{ $title }}</h1>
    <p>{{ $description }}</p>
    <ul>
        @foreach ($inspirations as $inspiration)
            <li>
                <a href="https://gesoft.pl/portfolio/{{ $inspiration['key'] }}">{{ $inspiration['title'] }}</a>
                — {{ $inspiration['description'] }}
            </li>
        @endforeach
    </ul>
    <p><a href="https://gesoft.pl/kontakt">{{ $locale === 'en' ? 'Describe your project' : 'Opisz projekt' }}</a></p>
</article>
