export function getArticleFaqs(article) {
  if (!article?.content) return []
  return article.content
    .filter((block) => block.type === 'faq')
    .flatMap((block) => block.items || [])
}

export function formatArticleDate(isoDate, locale = 'pl') {
  const date = new Date(`${isoDate}T00:00:00`)
  return new Intl.DateTimeFormat(locale === 'en' ? 'en-GB' : 'pl-PL', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  }).format(date)
}
