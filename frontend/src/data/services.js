import servicePages from '@/data/service-pages.json'

export { servicePages }

export function serviceList(locale = 'pl') {
  return Object.keys(servicePages).map((slug) => ({
    slug,
    ...(servicePages[slug][locale] || servicePages[slug].pl)
  }))
}

export function findService(slug, locale = 'pl') {
  const page = servicePages[slug]
  if (!page) {
    return null
  }
  return { slug, ...(page[locale] || page.pl) }
}

export function serviceSlugForArticle(article) {
  const slug = (article?.slug || '').toLowerCase()
  const category = article?.category || ''

  if (/android|terenow|serwis-teren|pomoc-drogowa|laweta|sprzatajac/.test(slug)) {
    return 'aplikacje-android'
  }
  if (/ksef|integr/.test(slug)) {
    return 'integracje-api'
  }
  if (/crm|b2b|hurtown|erp|magazyn/.test(slug)) {
    return 'systemy-b2b'
  }
  if (/google-wizytowka|strona-internetowa|sklep-internetowy/.test(slug)) {
    return 'strony-internetowe'
  }
  if (category === 'laravel' || category === 'security' || /laravel|bezpieczen|rodo|wordpress-vs|audyt|2fa|uwierzyteln/.test(slug)) {
    return 'laravel-vue'
  }
  if (/gotowy-program|oprogramowanie-na-zamowienie/.test(slug) || category === 'industry' || category === 'business') {
    return 'oprogramowanie-na-zamowienie'
  }
  return 'aplikacje-webowe'
}
