<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-16 sm:py-20 bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-5">
          {{ $t('about.header.title1') }} <span class="text-brand-600">{{ $t('about.header.title2') }}</span>
        </h1>
        <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
          {{ $t('about.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Story Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="section-title mb-6">{{ $t('about.story.title') }} <span class="text-brand-600">{{ $t('about.story.titleHighlight') }}</span></h2>
            <p class="text-gray-700 mb-4">
              {{ $t('about.story.content1') }}
            </p>
            <p class="text-gray-700 mb-4">
              {{ $t('about.story.content2') }}
            </p>
            <p class="text-gray-700">
              {{ $t('about.story.content3') }}
            </p>
          </div>
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-8">
            <div class="w-14 h-14 bg-brand-50 rounded-lg flex items-center justify-center mb-5">
              <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $t('about.story.codePassion') }}</h3>
            <p class="text-gray-600">
              {{ $t('about.story.codePassionDesc') }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-white border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="bg-white border border-gray-200 rounded-lg p-8 hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 bg-brand-50 rounded-lg flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('about.mission.title') }}</h3>
            <p class="text-gray-600">
              {{ $t('about.mission.content') }}
            </p>
          </div>
          <div class="bg-white border border-gray-200 rounded-lg p-8 hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 bg-blue-50 rounded-lg flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('about.vision.title') }}</h3>
            <p class="text-gray-600">
              {{ $t('about.vision.content') }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Capabilities Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('about.capabilities.title') }} <span class="text-brand-600">{{ $t('about.capabilities.titleHighlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-center bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 mx-auto bg-red-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
            </div>
            <div class="text-gray-900 font-bold mb-1">Laravel + Vue.js</div>
            <div class="text-gray-600 text-sm">Aplikacje webowe w sprawdzonym stacku PHP/JS</div>
          </div>
          <div class="text-center bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 mx-auto bg-green-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
              </svg>
            </div>
            <div class="text-gray-900 font-bold mb-1">Android (Kotlin)</div>
            <div class="text-gray-600 text-sm">Natywne aplikacje na Google Play</div>
          </div>
          <div class="text-center bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 mx-auto bg-brand-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <div class="text-gray-900 font-bold mb-1">6 mies. gwarancji</div>
            <div class="text-gray-600 text-sm">Bezpłatne poprawki błędów po wdrożeniu</div>
          </div>
          <div class="text-center bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 mx-auto bg-gray-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <div class="text-gray-900 font-bold mb-1">NDA na życzenie</div>
            <div class="text-gray-600 text-sm">Pełna poufność kodu i danych projektu</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('about.values.title') }} <span class="text-brand-600">{{ $t('about.values.titleHighlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div v-for="value in values" :key="value.key" class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-200">
            <div class="text-4xl mb-4">{{ value.icon }}</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $t(value.titleKey) }}</h3>
            <p class="text-gray-600 text-sm">{{ $t(value.descKey) }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Certifications & Trust Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="section-title">Standardy i <span class="text-brand-600">certyfikaty</span></h2>
          <p class="section-subtitle">Pracujemy zgodnie z najwyzszymi standardami branzy IT</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 mx-auto bg-green-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h4 class="text-gray-900 font-semibold mb-1">RODO/GDPR</h4>
            <p class="text-gray-600 text-xs">Zgodnosc z przepisami o ochronie danych</p>
          </div>
          <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 mx-auto bg-blue-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
            </div>
            <h4 class="text-gray-900 font-semibold mb-1">PSR-12</h4>
            <p class="text-gray-600 text-xs">Standard kodowania PHP</p>
          </div>
          <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 mx-auto bg-brand-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
              </svg>
            </div>
            <h4 class="text-gray-900 font-semibold mb-1">OWASP</h4>
            <p class="text-gray-600 text-xs">Standardy bezpieczenstwa aplikacji</p>
          </div>
          <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-200">
            <div class="w-14 h-14 mx-auto bg-yellow-50 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h4 class="text-gray-900 font-semibold mb-1">Core Web Vitals</h4>
            <p class="text-gray-600 text-xs">Optymalizacja wydajnosci Google</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
          {{ $t('about.cta.title') }}
        </h2>
        <p class="text-lg text-gray-300 mb-8">
          {{ $t('about.cta.subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <router-link to="/kontakt" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-brand-700 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200">
            {{ $t('about.cta.button') }}
          </router-link>
          <router-link to="/portfolio" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-white bg-transparent border border-white/50 rounded-md hover:bg-white/10 transition-colors duration-200">
            Inspiracje
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
const values = [
  { key: 'quality', icon: '🎯', titleKey: 'about.values.quality.title', descKey: 'about.values.quality.description' },
  { key: 'partnership', icon: '🤝', titleKey: 'about.values.partnership.title', descKey: 'about.values.partnership.description' },
  { key: 'innovation', icon: '💡', titleKey: 'about.values.innovation.title', descKey: 'about.values.innovation.description' },
  { key: 'security', icon: '🔒', titleKey: 'about.values.security.title', descKey: 'about.values.security.description' },
]
</script>
