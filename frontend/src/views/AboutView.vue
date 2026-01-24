<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-20 bg-hero-gradient relative overflow-hidden">
      <div class="absolute inset-0 pattern-bg"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
          {{ $t('about.header.title1') }} <span class="gradient-text">{{ $t('about.header.title2') }}</span>
        </h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto">
          {{ $t('about.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Story Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="section-title mb-6">{{ $t('about.story.title') }} <span class="gradient-text">{{ $t('about.story.titleHighlight') }}</span></h2>
            <p class="text-dark-300 mb-4">
              {{ $t('about.story.content1') }}
            </p>
            <p class="text-dark-300 mb-4">
              {{ $t('about.story.content2') }}
            </p>
            <p class="text-dark-300">
              {{ $t('about.story.content3') }}
            </p>
          </div>
          <div class="glass-card p-8 relative">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full blur-2xl opacity-50"></div>
            <div class="relative">
              <div class="text-6xl mb-4">💻</div>
              <h3 class="text-2xl font-bold text-white mb-2">{{ $t('about.story.codePassion') }}</h3>
              <p class="text-dark-400">
                {{ $t('about.story.codePassionDesc') }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="glass-card p-8 hover:border-primary-500/50 transition-all duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-xl flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">{{ $t('about.mission.title') }}</h3>
            <p class="text-dark-400">
              {{ $t('about.mission.content') }}
            </p>
          </div>
          <div class="glass-card p-8 hover:border-secondary-500/50 transition-all duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-secondary-500/20 to-accent-500/20 rounded-xl flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">{{ $t('about.vision.title') }}</h3>
            <p class="text-dark-400">
              {{ $t('about.vision.content') }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('about.stats.title') }} <span class="gradient-text">{{ $t('about.stats.titleHighlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="stat in stats" :key="stat.key" class="text-center glass-card p-6">
            <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">{{ stat.value }}</div>
            <div class="text-dark-400">{{ $t(stat.labelKey) }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('about.values.title') }} <span class="gradient-text">{{ $t('about.values.titleHighlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div v-for="value in values" :key="value.key" class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="text-4xl mb-4">{{ value.icon }}</div>
            <h3 class="text-lg font-semibold text-white mb-2">{{ $t(value.titleKey) }}</h3>
            <p class="text-dark-400 text-sm">{{ $t(value.descKey) }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Certifications & Trust Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="section-title">Standardy i <span class="gradient-text">certyfikaty</span></h2>
          <p class="section-subtitle">Pracujemy zgodnie z najwyzszymi standardami branzy IT</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="glass-card p-6 text-center hover:border-green-500/30 transition-all duration-300">
            <div class="w-14 h-14 mx-auto bg-green-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h4 class="text-white font-semibold mb-1">RODO/GDPR</h4>
            <p class="text-dark-400 text-xs">Zgodnosc z przepisami o ochronie danych</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-blue-500/30 transition-all duration-300">
            <div class="w-14 h-14 mx-auto bg-blue-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
            </div>
            <h4 class="text-white font-semibold mb-1">PSR-12</h4>
            <p class="text-dark-400 text-xs">Standard kodowania PHP</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-purple-500/30 transition-all duration-300">
            <div class="w-14 h-14 mx-auto bg-purple-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
              </svg>
            </div>
            <h4 class="text-white font-semibold mb-1">OWASP</h4>
            <p class="text-dark-400 text-xs">Standardy bezpieczenstwa aplikacji</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-yellow-500/30 transition-all duration-300">
            <div class="w-14 h-14 mx-auto bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h4 class="text-white font-semibold mb-1">Core Web Vitals</h4>
            <p class="text-dark-400 text-xs">Optymalizacja wydajnosci Google</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('about.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('about.cta.subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg bg-white text-dark-900 hover:bg-gray-100">
            {{ $t('about.cta.button') }}
          </router-link>
          <router-link to="/portfolio" class="btn-secondary px-10 py-4 text-lg border-white/30 hover:border-white/50">
            Zobacz portfolio
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const stats = [
  { key: 'projects', value: '50+', labelKey: 'about.stats.projects' },
  { key: 'experience', value: '8+', labelKey: 'about.stats.experience' },
  { key: 'clients', value: '40+', labelKey: 'about.stats.clients' },
  { key: 'satisfaction', value: '99%', labelKey: 'about.stats.satisfaction' },
]

const values = [
  { key: 'quality', icon: '🎯', titleKey: 'about.values.quality.title', descKey: 'about.values.quality.description' },
  { key: 'partnership', icon: '🤝', titleKey: 'about.values.partnership.title', descKey: 'about.values.partnership.description' },
  { key: 'innovation', icon: '💡', titleKey: 'about.values.innovation.title', descKey: 'about.values.innovation.description' },
  { key: 'security', icon: '🔒', titleKey: 'about.values.security.title', descKey: 'about.values.security.description' },
]
</script>
