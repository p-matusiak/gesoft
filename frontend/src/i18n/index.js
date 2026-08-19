import { createI18n } from 'vue-i18n'
import pl from './locales/pl.json'
import en from './locales/en.json'

function initialLocale() {
  if (typeof window === 'undefined') {
    return 'pl'
  }
  const fromUrl = new URLSearchParams(window.location.search).get('lang')
  if (fromUrl === 'en' || fromUrl === 'pl') {
    localStorage.setItem('locale', fromUrl)
    return fromUrl
  }
  return localStorage.getItem('locale') || 'pl'
}

const i18n = createI18n({
  legacy: false,
  locale: initialLocale(),
  fallbackLocale: 'pl',
  messages: {
    pl,
    en
  }
})

export default i18n
