import { watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { getArticleFaqs } from '@/data/articles-format'
import { getCachedArticle, getCachedArticles } from '@/composables/useArticles'
import { findService } from '@/data/services'

const BASE_URL = 'https://gesoft.pl'

// SEO configuration for each page
const seoConfig = {
  home: {
    pl: {
      title: 'GESOFT — aplikacje webowe i Android dla firm | wycena 24h',
      description: 'GESOFT projektuje i wdraża aplikacje Laravel i Vue.js, Android, rezerwacje i KSeF. Bezpłatna wycena w 24 godziny, 6 miesięcy gwarancji.',
      keywords: 'aplikacje webowe, oprogramowanie dla firm, Laravel, Vue.js, Android, KSeF, system rezerwacji, GESOFT, wycena'
    },
    en: {
      title: 'GESOFT — web and Android apps for companies | quote in 24h',
      description: 'GESOFT designs and ships Laravel and Vue.js apps, Android, bookings and KSeF. Free quote within 24 hours, 6-month warranty.',
      keywords: 'web applications, software for companies, Laravel, Vue.js, Android, KSeF, booking system, GESOFT, quote'
    }
  },
  about: {
    pl: {
      title: 'O nas - GESOFT | Paweł Matusiak',
      description: 'GESOFT — software house. Projektujemy i wdrażamy aplikacje Laravel, Vue.js i Android. Wycena w 24 godziny, 6 miesięcy gwarancji.',
      keywords: 'o nas, GESOFT, zespół, doświadczenie, firma programistyczna, web development'
    },
    en: {
      title: 'About - GESOFT | Paweł Matusiak',
      description: 'GESOFT software house. We design and ship Laravel, Vue.js and Android apps. Quote in 24 hours, 6-month warranty.',
      keywords: 'about us, GESOFT, team, experience, software company, web development'
    }
  },
  services: {
    pl: {
      title: 'Usługi - GESOFT | Strony, aplikacje, sklepy, CRM',
      description: 'Kompleksowe usługi webowe: strony internetowe, aplikacje webowe, sklepy e-commerce, systemy CRM/ERP, integracje API, fotografia, filmowanie dronem.',
      keywords: 'usługi, strony internetowe, aplikacje webowe, sklepy online, CRM, ERP, API, fotografia, dron, SEO'
    },
    en: {
      title: 'Services - GESOFT | Websites, Apps, E-commerce, CRM',
      description: 'Comprehensive web services: websites, web applications, e-commerce stores, CRM/ERP systems, API integrations, photography, drone footage.',
      keywords: 'services, websites, web applications, online stores, CRM, ERP, API, photography, drone, SEO'
    }
  },
  technologies: {
    pl: {
      title: 'Technologie - GESOFT | Laravel, Vue.js, PHP, MySQL',
      description: 'Poznaj technologie, których używamy: Laravel, Vue.js 3, PHP 8, MySQL 8, TailwindCSS, Docker, Redis, Nginx. Sprawdzone i wydajne rozwiązania.',
      keywords: 'technologie, Laravel, Vue.js, PHP, MySQL, TailwindCSS, Docker, Redis, Nginx, stack technologiczny'
    },
    en: {
      title: 'Technologies - GESOFT | Laravel, Vue.js, PHP, MySQL',
      description: 'Discover our tech stack: Laravel, Vue.js 3, PHP 8, MySQL 8, TailwindCSS, Docker, Redis, Nginx. Proven and efficient solutions.',
      keywords: 'technologies, Laravel, Vue.js, PHP, MySQL, TailwindCSS, Docker, Redis, Nginx, tech stack'
    }
  },
  portfolio: {
    pl: {
      title: 'Inspiracje - GESOFT | Przykłady projektów',
      description: 'Przykłady projektów które możemy zbudować: systemy CRM, sklepy internetowe, aplikacje webowe, strony firmowe, aplikacje mobilne Android.',
      keywords: 'inspiracje, przykłady projektów, CRM, sklepy internetowe, aplikacje webowe, aplikacje Android, strony firmowe'
    },
    en: {
      title: 'Inspirations - GESOFT | Project Examples',
      description: 'Project examples we can build: CRM systems, e-commerce stores, web applications, corporate websites, Android mobile apps.',
      keywords: 'inspirations, project examples, CRM, e-commerce, web apps, Android apps, corporate websites'
    }
  },
  contact: {
    pl: {
      title: 'Kontakt - GESOFT | Napisz do nas',
      description: 'Skontaktuj się z nami! Opisz swój projekt, a my przygotujemy bezpłatną wycenę. Email: biuro@gesoft.pl, Tel: +48 517 123 374.',
      keywords: 'kontakt, GESOFT, wycena, projekt, email, telefon, formularz kontaktowy'
    },
    en: {
      title: 'Contact - GESOFT | Get in Touch',
      description: 'Contact us! Describe your project and we will prepare a free quote. Email: biuro@gesoft.pl, Phone: +48 517 123 374.',
      keywords: 'contact, GESOFT, quote, project, email, phone, contact form'
    }
  },
  articles: {
    pl: {
      title: 'Artykuły: system rezerwacji, restauracja, salon, gabinet | GESOFT',
      description: 'Artykuły dla właścicieli firm: system rezerwacji stolików, zamówienia online bez prowizji, program do salonu, e-rejestracja, warsztat, panel B2B. Jak aplikacja rozwiązuje konkretny problem i kiedy się spłaca.',
      keywords: 'system rezerwacji online, program do restauracji, salon fryzjerski, gabinet lekarski, panel B2B, oprogramowanie na zamówienie, GESOFT'
    },
    en: {
      title: 'Articles: booking systems, restaurants, salons, clinics | GESOFT',
      description: 'Articles for business owners: table booking, commission-free online orders, salon software, clinic e-registration, workshops, B2B portals. How an app solves a real problem and when it pays back.',
      keywords: 'online booking system, restaurant software, hair salon, medical clinic, B2B portal, custom software, GESOFT'
    }
  }
}

// Route to SEO key mapping
const routeToSeoKey = {
  '/': 'home',
  '/o-nas': 'about',
  '/uslugi': 'services',
  '/technologie': 'technologies',
  '/portfolio': 'portfolio',
  '/kontakt': 'contact',
  '/artykuly': 'articles'
}

function setMetaTag(name, content, isProperty = false) {
  const attribute = isProperty ? 'property' : 'name'
  let element = document.querySelector(`meta[${attribute}="${name}"]`)

  if (!element) {
    element = document.createElement('meta')
    element.setAttribute(attribute, name)
    document.head.appendChild(element)
  }

  element.setAttribute('content', content)
}

function localeUrl(path, lang) {
  const url = `${BASE_URL}${path}`
  return lang === 'en' ? `${url}${url.includes('?') ? '&' : '?'}lang=en` : url
}

function setLinkTag(rel, href, hreflang = null) {
  let selector = `link[rel="${rel}"]`
  if (hreflang) {
    selector = `link[rel="${rel}"][hreflang="${hreflang}"]`
  }

  let element = document.querySelector(selector)

  if (!element) {
    element = document.createElement('link')
    element.setAttribute('rel', rel)
    if (hreflang) {
      element.setAttribute('hreflang', hreflang)
    }
    document.head.appendChild(element)
  }

  element.setAttribute('href', href)
}

function setJsonLd(data) {
  let script = document.querySelector('script[type="application/ld+json"]')

  if (!script) {
    script = document.createElement('script')
    script.type = 'application/ld+json'
    document.head.appendChild(script)
  }

  script.textContent = JSON.stringify(data)
}

export function useSeo() {
  const route = useRoute()
  const { locale, t, te } = useI18n()

  const updateSeo = () => {
    const path = route.path
    const lang = locale.value

    // Skip admin routes
    if (path.startsWith('/admin')) {
      return
    }

    let seoKey = routeToSeoKey[path]
    let config = seoKey ? seoConfig[seoKey]?.[lang] : null
    let article = null
    let inspiration = null

    if (path === '/artykuly' && route.query.kategoria) {
      const labels = {
        industry: lang === 'pl' ? 'branża' : 'industry',
        laravel: 'Laravel',
        security: lang === 'pl' ? 'bezpieczeństwo' : 'security',
        business: lang === 'pl' ? 'biznes' : 'business'
      }
      const label = labels[route.query.kategoria]
      if (config && label) {
        config = {
          ...config,
          title: lang === 'pl' ? `Artykuły: ${label} - GESOFT` : `Articles: ${label} - GESOFT`
        }
      }
    }

    if (path.startsWith('/artykuly/') && route.params.slug) {
      article = getCachedArticle(route.params.slug, lang)
      if (!article) {
        return
      }
      seoKey = 'article'
      config = {
        title: article.seoTitle,
        description: article.seoDescription,
        keywords: article.keywords
      }
    }

    const serviceMatch = path.match(/^\/uslugi\/([a-z0-9-]+)$/)
    if (serviceMatch) {
      const service = findService(serviceMatch[1], lang)
      if (!service) {
        return
      }
      seoKey = 'service'
      config = {
        title: service.seoTitle,
        description: service.description,
        keywords: service.keywords
      }
    }

    if (path === '/autor/pawel-matusiak') {
      seoKey = 'author'
      config = {
        title: lang === 'pl' ? 'Paweł Matusiak — założyciel GESOFT' : 'Paweł Matusiak — founder, GESOFT',
        description: lang === 'pl'
          ? 'Paweł Matusiak projektuje i wdraża aplikacje Laravel, Vue.js i Android w GESOFT.'
          : 'Paweł Matusiak designs and ships Laravel, Vue.js and Android applications at GESOFT.',
        keywords: 'Paweł Matusiak, GESOFT, Laravel, Vue.js, Android'
      }
    }

    const inspirationMatch = path.match(/^\/portfolio\/([A-Za-z0-9_-]+)$/)
    if (inspirationMatch) {
      const key = inspirationMatch[1]
      const titleKey = `portfolio.projects.${key}.title`
      if (!te(titleKey)) {
        return
      }
      const title = t(titleKey)
      const description = t(`portfolio.projects.${key}.description`)
      seoKey = 'inspiration'
      inspiration = {
        key,
        title,
        description,
        image: `/portfolio/${key.toLowerCase()}.png`
      }
      config = {
        title: lang === 'pl' ? `${title} — inspiracja | GESOFT` : `${title} — inspiration | GESOFT`,
        description,
        keywords: `${title}, inspiracje, GESOFT`
      }
    }

    if (!config) {
      return
    }

    // Update document title
    document.title = config.title

    // Update HTML lang attribute
    document.documentElement.lang = lang

    // Basic meta tags
    setMetaTag('description', config.description)
    setMetaTag('keywords', config.keywords)
    setMetaTag('author', 'GESOFT Paweł Matusiak')
    setMetaTag('robots', 'index, follow')

    // Open Graph tags
    setMetaTag('og:title', config.title, true)
    setMetaTag('og:description', config.description, true)
    setMetaTag('og:type', article ? 'article' : 'website', true)
    setMetaTag('og:url', localeUrl(path, lang), true)
    const ogImage = inspiration ? `${BASE_URL}${inspiration.image}` : `${BASE_URL}/og-image.png`
    setMetaTag('og:image', ogImage, true)
    setMetaTag('og:site_name', 'GESOFT', true)
    setMetaTag('og:locale', lang === 'pl' ? 'pl_PL' : 'en_US', true)
    if (article) {
      setMetaTag('article:published_time', article.publishedAt, true)
      setMetaTag('article:modified_time', article.updatedAt, true)
      setMetaTag('article:author', 'GESOFT Paweł Matusiak', true)
      setMetaTag('article:section', article.category, true)
    }

    // Twitter Card tags
    setMetaTag('twitter:card', 'summary_large_image')
    setMetaTag('twitter:title', config.title)
    setMetaTag('twitter:description', config.description)
    setMetaTag('twitter:image', ogImage)

    // Canonical URL — EN must self-canonicalise (?lang=en), not point at Polish
    setLinkTag('canonical', localeUrl(path, lang))

    // Hreflang tags
    setLinkTag('alternate', localeUrl(path, 'pl'), 'pl')
    setLinkTag('alternate', localeUrl(path, 'en'), 'en')
    setLinkTag('alternate', localeUrl(path, 'pl'), 'x-default')

    // JSON-LD Structured Data
    const jsonLd = {
      '@context': 'https://schema.org',
      '@graph': [
        // Organization
        {
          '@type': 'Organization',
          '@id': `${BASE_URL}/#organization`,
          'name': 'GESOFT',
          'legalName': 'GESOFT Paweł Matusiak',
          'url': BASE_URL,
          'logo': `${BASE_URL}/logo.png`,
          'image': `${BASE_URL}/og-image.png`,
          'description': lang === 'pl'
            ? 'Profesjonalne tworzenie stron i aplikacji webowych'
            : 'Professional website and web application development',
          'address': {
            '@type': 'PostalAddress',
            'addressCountry': 'PL'
          },
          'contactPoint': {
            '@type': 'ContactPoint',
            'telephone': '+48-517-123-374',
            'email': 'biuro@gesoft.pl',
            'contactType': 'customer service',
            'availableLanguage': ['Polish', 'English']
          },
          'sameAs': []
        },
        // WebSite
        {
          '@type': 'WebSite',
          '@id': `${BASE_URL}/#website`,
          'url': BASE_URL,
          'name': 'GESOFT',
          'publisher': {
            '@id': `${BASE_URL}/#organization`
          },
          'inLanguage': lang === 'pl' ? 'pl-PL' : 'en-US'
        },
        // WebPage
        {
          '@type': 'WebPage',
          '@id': `${localeUrl(path, lang)}/#webpage`,
          'url': localeUrl(path, lang),
          'name': config.title,
          'description': config.description,
          'isPartOf': {
            '@id': `${BASE_URL}/#website`
          },
          'about': {
            '@id': `${BASE_URL}/#organization`
          },
          'inLanguage': lang === 'pl' ? 'pl-PL' : 'en-US'
        }
      ]
    }

    // Add LocalBusiness for contact page
    if (seoKey === 'contact' || seoKey === 'home') {
      jsonLd['@graph'].push({
        '@type': 'LocalBusiness',
        '@id': `${BASE_URL}/#localbusiness`,
        'name': 'GESOFT',
        'image': `${BASE_URL}/logo.png`,
        'telephone': '+48-517-123-374',
        'email': 'biuro@gesoft.pl',
        'address': {
          '@type': 'PostalAddress',
          'addressCountry': 'PL'
        },
        'priceRange': '$$',
        'openingHours': 'Mo-Fr 09:00-17:00',
        'url': BASE_URL
      })
    }

    // Add Service for services page
    if (seoKey === 'services') {
      const services = [
        { name: lang === 'pl' ? 'Strony internetowe' : 'Websites', description: lang === 'pl' ? 'Nowoczesne, responsywne strony internetowe' : 'Modern, responsive websites' },
        { name: lang === 'pl' ? 'Aplikacje webowe' : 'Web Applications', description: lang === 'pl' ? 'Zaawansowane aplikacje w Laravel i Vue.js' : 'Advanced applications in Laravel and Vue.js' },
        { name: lang === 'pl' ? 'Sklepy internetowe' : 'E-commerce', description: lang === 'pl' ? 'Kompleksowe rozwiązania e-commerce' : 'Comprehensive e-commerce solutions' },
        { name: lang === 'pl' ? 'Systemy CRM/ERP' : 'CRM/ERP Systems', description: lang === 'pl' ? 'Dedykowane systemy zarządzania' : 'Dedicated management systems' }
      ]

      services.forEach((service, index) => {
        jsonLd['@graph'].push({
          '@type': 'Service',
          '@id': `${BASE_URL}/uslugi/#service-${index}`,
          'name': service.name,
          'description': service.description,
          'provider': {
            '@id': `${BASE_URL}/#organization`
          }
        })
      })
    }

    // Add BreadcrumbList for all pages except home
    if (seoKey !== 'home') {
      const breadcrumbNames = {
        about: { pl: 'O nas', en: 'About Us' },
        services: { pl: 'Usługi', en: 'Services' },
        technologies: { pl: 'Technologie', en: 'Technologies' },
        portfolio: { pl: 'Inspiracje', en: 'Inspirations' },
        contact: { pl: 'Kontakt', en: 'Contact' },
        articles: { pl: 'Artykuły', en: 'Articles' }
      }

      const breadcrumbItems = [
        {
          '@type': 'ListItem',
          'position': 1,
          'name': lang === 'pl' ? 'Strona główna' : 'Home',
          'item': BASE_URL
        }
      ]

      if (seoKey === 'article') {
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 2,
          'name': lang === 'pl' ? 'Artykuły' : 'Articles',
          'item': `${BASE_URL}/artykuly`
        })
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 3,
          'name': article.title,
          'item': `${BASE_URL}${path}`
        })
      } else if (seoKey === 'service') {
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 2,
          'name': lang === 'pl' ? 'Usługi' : 'Services',
          'item': `${BASE_URL}/uslugi`
        })
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 3,
          'name': config.title,
          'item': `${BASE_URL}${path}`
        })
      } else if (seoKey === 'author') {
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 2,
          'name': lang === 'pl' ? 'O nas' : 'About',
          'item': `${BASE_URL}/o-nas`
        })
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 3,
          'name': 'Paweł Matusiak',
          'item': `${BASE_URL}${path}`
        })
      } else if (seoKey === 'inspiration' && inspiration) {
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 2,
          'name': lang === 'pl' ? 'Inspiracje' : 'Inspirations',
          'item': `${BASE_URL}/portfolio`
        })
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 3,
          'name': inspiration.title,
          'item': `${BASE_URL}${path}`
        })
      } else {
        breadcrumbItems.push({
          '@type': 'ListItem',
          'position': 2,
          'name': breadcrumbNames[seoKey]?.[lang] || config.title,
          'item': `${BASE_URL}${path}`
        })
      }

      jsonLd['@graph'].push({
        '@type': 'BreadcrumbList',
        '@id': `${BASE_URL}${path}/#breadcrumb`,
        'itemListElement': breadcrumbItems
      })
    }

    if (seoKey === 'articles') {
      const listed = getCachedArticles(lang)
      jsonLd['@graph'].push({
        '@type': 'Blog',
        '@id': `${BASE_URL}/artykuly/#blog`,
        'name': config.title,
        'description': config.description,
        'url': `${BASE_URL}/artykuly`,
        'publisher': {
          '@id': `${BASE_URL}/#organization`
        },
        'inLanguage': lang === 'pl' ? 'pl-PL' : 'en-US',
        'blogPost': listed.map((item) => ({
          '@type': 'BlogPosting',
          '@id': `${localeUrl('/artykuly/' + item.slug, lang)}/#article`,
          'headline': item.title,
          'url': localeUrl('/artykuly/' + item.slug, lang)
        }))
      })
    }

    if (seoKey === 'inspiration' && inspiration) {
      jsonLd['@graph'].push({
        '@type': 'CreativeWork',
        '@id': `${localeUrl(path, lang)}/#work`,
        'name': inspiration.title,
        'description': inspiration.description,
        'image': ogImage,
        'url': localeUrl(path, lang),
        'inLanguage': lang === 'pl' ? 'pl-PL' : 'en-US'
      })
    }

    if (seoKey === 'article' && article) {
      jsonLd['@graph'].push({
        '@type': 'BlogPosting',
        '@id': `${localeUrl(path, lang)}/#article`,
        'headline': article.title,
        'description': article.seoDescription,
        'datePublished': article.publishedAt,
        'dateModified': article.updatedAt,
        'inLanguage': lang === 'pl' ? 'pl-PL' : 'en-US',
        'image': `${BASE_URL}/og-image.png`,
        'author': {
          '@id': `${BASE_URL}/#organization`
        },
        'publisher': {
          '@id': `${BASE_URL}/#organization`
        },
        'mainEntityOfPage': {
          '@id': `${localeUrl(path, lang)}/#webpage`
        },
        'keywords': article.keywords
      })

      const articleFaqs = getArticleFaqs(article)
      if (articleFaqs.length) {
        jsonLd['@graph'].push({
          '@type': 'FAQPage',
          '@id': `${localeUrl(path, lang)}/#faq`,
          'mainEntity': articleFaqs.map((item) => ({
            '@type': 'Question',
            'name': item.q,
            'acceptedAnswer': {
              '@type': 'Answer',
              'text': item.a
            }
          }))
        })
      }
    }

    // Add FAQPage for contact page
    if (seoKey === 'contact') {
      const faqItems = lang === 'pl' ? [
        { question: 'Jak długo trwa realizacja projektu?', answer: 'Czas realizacji zależy od złożoności projektu. Prosta strona internetowa to 2-4 tygodnie, aplikacja webowa 1-3 miesiące.' },
        { question: 'Czy oferujecie wsparcie po zakończeniu projektu?', answer: 'Tak, oferujemy pakiety wsparcia technicznego i utrzymania dla wszystkich naszych projektów.' },
        { question: 'Jakich technologii używacie?', answer: 'Specjalizujemy się w Laravel (PHP) i Vue.js. Używamy również MySQL, Redis, Docker i wielu innych.' }
      ] : [
        { question: 'How long does project implementation take?', answer: 'Implementation time depends on project complexity. A simple website takes 2-4 weeks, a web application 1-3 months.' },
        { question: 'Do you offer support after project completion?', answer: 'Yes, we offer technical support and maintenance packages for all our projects.' },
        { question: 'What technologies do you use?', answer: 'We specialize in Laravel (PHP) and Vue.js. We also use MySQL, Redis, Docker and many others.' }
      ]

      jsonLd['@graph'].push({
        '@type': 'FAQPage',
        '@id': `${BASE_URL}/kontakt/#faq`,
        'mainEntity': faqItems.map(item => ({
          '@type': 'Question',
          'name': item.question,
          'acceptedAnswer': {
            '@type': 'Answer',
            'text': item.answer
          }
        }))
      })
    }

    setJsonLd(jsonLd)
  }

  // Watch for route and locale changes
  watch([() => route.path, () => route.params.slug, () => route.params.key, () => route.query.kategoria, locale], updateSeo, { immediate: true })

  onMounted(() => {
    updateSeo()
  })

  return {
    updateSeo
  }
}
