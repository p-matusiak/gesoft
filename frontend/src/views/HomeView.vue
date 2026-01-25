<template>
  <div>
    <!-- Hero Section -->
    <HeroSection />

    <!-- Why Us Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.whyUs.title') }} <span class="gradient-text">{{ $t('home.whyUs.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.whyUs.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <span class="text-3xl">🚀</span>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.fast.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.fast.description') }}</p>
          </div>
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <span class="text-3xl">💎</span>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.quality.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.quality.description') }}</p>
          </div>
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <span class="text-3xl">🔧</span>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.support.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.support.description') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Preview Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.services.title') }} <span class="gradient-text">{{ $t('home.services.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.services.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <ServiceCard
            v-for="service in services"
            :key="service.id"
            :title="service.title"
            :description="service.description"
            :icon="service.icon"
          />
        </div>

        <div class="text-center mt-12">
          <router-link to="/uslugi" class="btn-secondary">
            {{ $t('home.services.viewAll') }}
            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </router-link>
        </div>
      </div>
    </section>

    <!-- Technologies Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.technologies.title') }} <span class="gradient-text">{{ $t('home.technologies.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.technologies.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🔴</div>
            <h3 class="text-lg font-semibold text-white">Laravel</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.laravel') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">💚</div>
            <h3 class="text-lg font-semibold text-white">Vue.js</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.vue') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🐘</div>
            <h3 class="text-lg font-semibold text-white">PHP</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.php') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">🐬</div>
            <h3 class="text-lg font-semibold text-white">MySQL</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.mysql') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Results Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('results.title') }} <span class="gradient-text">{{ $t('results.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('results.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div v-for="(caseItem, index) in resultsCases" :key="index"
               class="glass-card p-6 text-center group hover:border-primary-500/50 transition-all duration-300 hover:-translate-y-1">
            <div class="text-4xl md:text-5xl font-bold gradient-text mb-2 group-hover:scale-110 transition-transform">
              {{ caseItem.metric }}
            </div>
            <p class="text-dark-300 text-sm mb-3">{{ caseItem.description }}</p>
            <p class="text-dark-500 text-xs">{{ caseItem.client }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Packages Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('packages.title') }} <span class="gradient-text">{{ $t('packages.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('packages.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Starter Package -->
          <div class="glass-card p-8 hover:border-dark-500/50 transition-all duration-300">
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.starter.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.starter.description') }}</p>
            <div class="mb-6">
              <span class="text-4xl font-bold text-white">{{ $t('packages.starter.price') }}</span>
              <span class="text-dark-400 ml-1">{{ $t('packages.starter.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.starter.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-green-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.starter.cta') }}</router-link>
          </div>

          <!-- Business Package - Popular -->
          <div class="glass-card p-8 border-2 border-primary-500/50 relative hover:border-primary-500 transition-all duration-300 transform scale-105">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
              <span class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white text-sm font-semibold px-4 py-1 rounded-full">
                {{ $t('packages.popular') }}
              </span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.business.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.business.description') }}</p>
            <div class="mb-6">
              <span class="text-4xl font-bold gradient-text">{{ $t('packages.business.price') }}</span>
              <span class="text-dark-400 ml-1">{{ $t('packages.business.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.business.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-primary-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-primary w-full">{{ $t('packages.business.cta') }}</router-link>
          </div>

          <!-- Enterprise Package -->
          <div class="glass-card p-8 hover:border-secondary-500/50 transition-all duration-300">
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.enterprise.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.enterprise.description') }}</p>
            <div class="mb-6">
              <span class="text-2xl font-bold text-white">{{ $t('packages.enterprise.price') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.enterprise.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-secondary-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.enterprise.cta') }}</router-link>
          </div>
        </div>

        <p class="text-center text-dark-500 text-sm mt-8">{{ $t('packages.note') }}</p>
      </div>
    </section>

    <!-- Guarantees Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('guarantees.title') }} <span class="gradient-text">{{ $t('guarantees.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('guarantees.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="glass-card p-6 hover:border-green-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.satisfaction.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.satisfaction.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-blue-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.deadline.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.deadline.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-purple-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.quality.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.quality.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-red-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.security.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.security.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-yellow-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.support.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.support.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-cyan-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.transparency.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.transparency.description') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Urgency Banner -->
    <section class="py-16 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 relative overflow-hidden">
      <div class="absolute inset-0 bg-black/20"></div>
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white mb-4 animate-pulse">
          {{ $t('urgency.badge') }}
        </span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $t('urgency.title') }}</h2>
        <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">{{ $t('urgency.subtitle') }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-6">
          <router-link to="/kontakt" class="btn-primary bg-white text-dark-900 hover:bg-gray-100 px-8 py-4 text-lg">
            {{ $t('urgency.cta') }}
            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
          </router-link>
          <div class="flex items-center gap-2 text-white">
            <span class="text-white/70">{{ $t('urgency.spots') }}</span>
            <span class="text-3xl font-bold animate-pulse">{{ spotsLeft }}</span>
          </div>
        </div>
        <p class="text-white/60 text-sm">{{ $t('urgency.expires') }}</p>
      </div>
    </section>

    <!-- Comparison Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('comparison.title') }} <span class="gradient-text">{{ $t('comparison.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('comparison.subtitle') }}</p>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-dark-700">
                <th class="text-left py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.feature') }}</th>
                <th class="text-center py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.amateur') }}</th>
                <th class="text-center py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.agency') }}</th>
                <th class="text-center py-4 px-4 text-white font-bold bg-primary-500/10 rounded-t-lg">{{ $t('comparison.headers.gesoft') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(feature, index) in comparisonFeatures" :key="index" class="border-b border-dark-800">
                <td class="py-4 px-4 text-white font-medium">{{ feature.name }}</td>
                <td class="text-center py-4 px-4 text-dark-400">{{ feature.amateur }}</td>
                <td class="text-center py-4 px-4 text-dark-300">{{ feature.agency }}</td>
                <td class="text-center py-4 px-4 text-primary-400 font-medium bg-primary-500/5">{{ feature.gesoft }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Tech Details Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('techDetails.title') }} <span class="gradient-text">{{ $t('techDetails.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('techDetails.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Performance -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.performance.title') }}</h3>
            </div>
            <div class="space-y-4">
              <div v-for="(metric, i) in performanceMetrics" :key="i" class="flex items-center justify-between p-3 bg-dark-800/50 rounded-lg">
                <div>
                  <p class="text-white font-medium">{{ metric.label }}</p>
                  <p class="text-dark-400 text-xs">{{ metric.description }}</p>
                </div>
                <span class="text-2xl font-bold text-green-400">{{ metric.value }}</span>
              </div>
            </div>
          </div>

          <!-- Security -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.security.title') }}</h3>
            </div>
            <ul class="space-y-3">
              <li v-for="(feature, i) in $tm('techDetails.security.features')" :key="i" class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-red-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
          </div>

          <!-- Standards -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.standards.title') }}</h3>
            </div>
            <ul class="space-y-3">
              <li v-for="(item, i) in $tm('techDetails.standards.items')" :key="i" class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-blue-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ item }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('home.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('home.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg bg-white text-dark-900 hover:bg-dark-100">
          {{ $t('home.cta.button') }}
        </router-link>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.testimonials.title') }} <span class="gradient-text">{{ $t('home.testimonials.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.testimonials.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <article v-for="(testimonial, index) in testimonials" :key="index" class="glass-card p-8" itemscope itemtype="https://schema.org/Review">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold text-lg" aria-hidden="true">
                {{ testimonial.name.charAt(0) }}
              </div>
              <div class="ml-4">
                <h4 class="text-white font-semibold" itemprop="author">{{ testimonial.name }}</h4>
                <p class="text-dark-400 text-sm">{{ testimonial.company }}</p>
              </div>
            </div>
            <blockquote class="text-dark-300 italic" itemprop="reviewBody">"{{ testimonial.text }}"</blockquote>
            <div class="flex mt-4 text-yellow-400" role="img" aria-label="Ocena: 5 na 5 gwiazdek" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
              <meta itemprop="ratingValue" content="5">
              <meta itemprop="bestRating" content="5">
              <svg v-for="i in 5" :key="i" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
            </div>
          </article>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import axios from 'axios'
import HeroSection from '@/components/home/HeroSection.vue'
import ServiceCard from '@/components/common/ServiceCard.vue'

const { t, tm } = useI18n()

const services = ref([])
const spotsLeft = ref(3)

const resultsCases = computed(() => tm('results.cases'))

const comparisonFeatures = computed(() => tm('comparison.features'))

const performanceMetrics = [
  { label: 'Czas ladowania', value: '< 2s', description: 'Optymalizacja dla Core Web Vitals' },
  { label: 'PageSpeed Score', value: '95+', description: 'Zielone wyniki w Google PageSpeed' },
  { label: 'Uptime', value: '99.9%', description: 'Gwarantowana dostepnosc serwisu' }
]

const testimonials = computed(() => {
  return tm('home.testimonials.items')
})

onMounted(async () => {
  try {
    const response = await axios.get('/api/services')
    services.value = response.data.data
  } catch (error) {
    services.value = [
      { id: 1, title: t('home.services.websites.title'), description: t('home.services.websites.description'), icon: 'globe' },
      { id: 2, title: t('home.services.webapps.title'), description: t('home.services.webapps.description'), icon: 'code' },
      { id: 3, title: t('home.services.ecommerce.title'), description: t('home.services.ecommerce.description'), icon: 'shopping-cart' },
    ]
  }
})
</script>
