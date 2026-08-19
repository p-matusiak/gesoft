import axios from 'axios'
import { getArticleFaqs } from '@/data/articles-format'

const listCache = new Map()
const articleCache = new Map()

function listKey(locale, category) {
  return `${locale}:${category || 'all'}`
}

export function getCachedArticle(slug, locale = 'pl') {
  return articleCache.get(`${locale}:${slug}`) || null
}

export function getCachedArticles(locale = 'pl') {
  return listCache.get(listKey(locale, 'all')) || []
}

export async function fetchArticles(locale = 'pl', category = null) {
  const key = listKey(locale, category)
  if (listCache.has(key)) {
    return listCache.get(key)
  }

  const { data } = await axios.get('/api/articles', {
    params: {
      lang: locale === 'en' ? 'en' : 'pl',
      ...(category ? { kategoria: category } : {})
    }
  })
  const items = data.data || []
  listCache.set(key, items)
  return items
}

export async function fetchArticle(slug, locale = 'pl') {
  const key = `${locale}:${slug}`
  if (articleCache.has(key)) {
    return articleCache.get(key)
  }

  try {
    const { data } = await axios.get(`/api/articles/${slug}`, {
      params: { lang: locale === 'en' ? 'en' : 'pl' }
    })
    const article = data.data || null
    if (article) {
      articleCache.set(key, article)
    }
    return article
  } catch (error) {
    if (error.response?.status === 404) {
      return null
    }
    throw error
  }
}

export { getArticleFaqs }
