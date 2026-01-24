<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-20 bg-hero-gradient relative overflow-hidden">
      <div class="absolute inset-0 pattern-bg"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
          {{ $t('services.header.title') }} <span class="gradient-text">{{ $t('services.header.titleHighlight') }}</span>
        </h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto">
          {{ $t('services.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="service in services" :key="service.id" class="glass-card p-8 hover:border-primary-500/50 transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
              <span class="text-3xl">{{ service.emoji }}</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">{{ $t(service.titleKey) }}</h3>
            <p class="text-dark-400 mb-6">{{ $t(service.descKey) }}</p>
            <ul class="space-y-2">
              <li v-for="(feature, index) in $tm(service.featuresKey)" :key="index" class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-primary-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('services.process.title') }} <span class="gradient-text">{{ $t('services.process.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('services.process.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div v-for="(step, index) in process" :key="step.key" class="relative">
            <div class="glass-card p-6 text-center h-full">
              <div class="w-12 h-12 mx-auto bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold text-xl mb-4">
                {{ index + 1 }}
              </div>
              <h3 class="text-xl font-semibold text-white mb-2">{{ $t(step.titleKey) }}</h3>
              <p class="text-dark-400 text-sm">{{ $t(step.descKey) }}</p>
            </div>
            <div v-if="index < process.length - 1" class="hidden lg:block absolute top-1/2 -right-4 w-8 text-primary-500">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Technologies Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('services.technologies.title') }} <span class="gradient-text">{{ $t('services.technologies.titleHighlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-6">
          <div v-for="tech in technologies" :key="tech" class="glass-card p-4 text-center hover:border-primary-500/50 transition-all duration-300">
            <span class="text-dark-300 font-medium">{{ tech }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="section-title mb-6">{{ $t('comparison.title') }} <span class="gradient-text">{{ $t('comparison.titleHighlight') }}</span></h2>
            <p class="text-dark-300 mb-8">{{ $t('comparison.subtitle') }}</p>
            <div class="space-y-4">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">Indywidualne podejscie</h4>
                  <p class="text-dark-400 text-sm">Kazdy projekt traktujemy unikalnie, nie stosujemy szablonow.</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">Terminowosc</h4>
                  <p class="text-dark-400 text-sm">Dotrzymujemy ustalone terminy - za opoznienia dajemy rabat.</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">6 miesiecy gwarancji</h4>
                  <p class="text-dark-400 text-sm">Pelna gwarancja na wykonane prace z bezplatnym wsparciem.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="glass-card p-8">
            <h3 class="text-xl font-bold text-white mb-6">Bezplatna wycena w 24h</h3>
            <ul class="space-y-4 mb-6">
              <li class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Szczegolowa wycena projektu
              </li>
              <li class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Propozycja rozwiazan technicznych
              </li>
              <li class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Harmonogram realizacji
              </li>
              <li class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Bez zobowiazan
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-primary w-full">
              Opisz swoj projekt
              <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </router-link>
            <p class="text-center text-dark-500 text-sm mt-4">lub zadzwon: <a href="tel:+48517123374" class="text-primary-400 hover:underline">+48 517 123 374</a></p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('services.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('services.cta.subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg bg-white text-dark-900 hover:bg-gray-100">
            {{ $t('services.cta.button') }}
          </router-link>
          <a href="tel:+48517123374" class="btn-secondary px-10 py-4 text-lg border-white/30 hover:border-white/50">
            <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            Zadzwon teraz
          </a>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const services = [
  { id: 1, emoji: '🌐', titleKey: 'services.items.websites.title', descKey: 'services.items.websites.description', featuresKey: 'services.items.websites.features' },
  { id: 2, emoji: '💻', titleKey: 'services.items.webapps.title', descKey: 'services.items.webapps.description', featuresKey: 'services.items.webapps.features' },
  { id: 3, emoji: '🛒', titleKey: 'services.items.ecommerce.title', descKey: 'services.items.ecommerce.description', featuresKey: 'services.items.ecommerce.features' },
  { id: 4, emoji: '📊', titleKey: 'services.items.crm.title', descKey: 'services.items.crm.description', featuresKey: 'services.items.crm.features' },
  { id: 5, emoji: '🔗', titleKey: 'services.items.api.title', descKey: 'services.items.api.description', featuresKey: 'services.items.api.features' },
  { id: 6, emoji: '🛠️', titleKey: 'services.items.support.title', descKey: 'services.items.support.description', featuresKey: 'services.items.support.features' },
  { id: 7, emoji: '📷', titleKey: 'services.items.photography.title', descKey: 'services.items.photography.description', featuresKey: 'services.items.photography.features' },
  { id: 8, emoji: '🚁', titleKey: 'services.items.drone.title', descKey: 'services.items.drone.description', featuresKey: 'services.items.drone.features' },
  { id: 9, emoji: '🔍', titleKey: 'services.items.seoAudit.title', descKey: 'services.items.seoAudit.description', featuresKey: 'services.items.seoAudit.features' }
]

const process = [
  { key: 'analysis', titleKey: 'services.process.analysis.title', descKey: 'services.process.analysis.description' },
  { key: 'design', titleKey: 'services.process.design.title', descKey: 'services.process.design.description' },
  { key: 'development', titleKey: 'services.process.development.title', descKey: 'services.process.development.description' },
  { key: 'deployment', titleKey: 'services.process.deployment.title', descKey: 'services.process.deployment.description' },
]

const technologies = [
  'Laravel', 'Vue.js', 'PHP', 'MySQL', 'PostgreSQL', 'TailwindCSS', 'Redis',
  'Docker', 'Git', 'REST API', 'WebSockets', 'Nginx', 'Linux'
]
</script>
