<template>
  <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 pb-10 sm:pt-0 sm:pb-0">
    <!-- Background -->
    <div class="absolute inset-0 bg-hero-gradient"></div>
    <div class="absolute inset-0 pattern-bg"></div>

    <!-- Animated blobs - hidden on mobile for better performance -->
    <div class="hidden sm:block absolute top-20 left-10 w-48 md:w-72 h-48 md:h-72 bg-primary-500/30 rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
    <div class="hidden sm:block absolute bottom-20 right-10 w-48 md:w-72 h-48 md:h-72 bg-secondary-500/30 rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: -3s;"></div>
    <div class="hidden md:block absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 lg:w-96 h-64 lg:h-96 bg-accent-500/20 rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: -1.5s;"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <!-- Social Proof Badge -->
      <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row items-center justify-center gap-3">
        <span class="inline-block px-3 py-1.5 sm:px-4 sm:py-2 bg-white/10 backdrop-blur-sm rounded-full text-xs sm:text-sm font-medium text-white/80 border border-white/20">
          {{ $t('hero.badge') }}
        </span>
        <div class="flex items-center gap-2 px-3 py-1.5 bg-yellow-500/20 backdrop-blur-sm rounded-full border border-yellow-500/30">
          <div class="flex -space-x-1">
            <svg v-for="i in 5" :key="i" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <span class="text-xs sm:text-sm text-white/90 font-medium">4.9/5 (47 opinii)</span>
        </div>
      </div>

      <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-4 sm:mb-6 leading-tight">
        {{ $t('hero.title1') }}
        <span class="gradient-text"> {{ $t('hero.title2') }} </span>
        <br class="hidden sm:block" />
        {{ $t('hero.title3') }}
      </h1>

      <p class="text-base sm:text-lg md:text-xl text-white/70 max-w-2xl mx-auto mb-4 sm:mb-6 px-2">
        {{ $t('hero.subtitle') }}
      </p>

      <!-- Trust Badges -->
      <div class="flex flex-wrap items-center justify-center gap-4 mb-6 sm:mb-10">
        <div class="flex items-center gap-2 text-white/60 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Darmowa wycena 24h</span>
        </div>
        <div class="flex items-center gap-2 text-white/60 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>6 miesiecy gwarancji</span>
        </div>
        <div class="flex items-center gap-2 text-white/60 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Faktura VAT</span>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
        <router-link to="/kontakt" class="btn-primary w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg group relative overflow-hidden">
          <span class="relative z-10 flex items-center justify-center">
            {{ $t('hero.cta') }}
            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </span>
        </router-link>
        <router-link to="/portfolio" class="btn-secondary w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg">
          {{ $t('hero.ctaSecondary') }}
        </router-link>
      </div>

      <!-- Stats with Animation -->
      <div class="mt-12 sm:mt-16 md:mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
        <div class="text-center p-3 sm:p-4 glass-card-hero group hover:scale-105 transition-transform duration-300">
          <div class="text-2xl sm:text-3xl md:text-4xl font-bold gradient-text mb-1 sm:mb-2">
            <span ref="projectsCounter">{{ animatedProjects }}</span>+
          </div>
          <div class="text-white/60 text-xs sm:text-sm">{{ $t('hero.stats.projects') }}</div>
        </div>
        <div class="text-center p-3 sm:p-4 glass-card-hero group hover:scale-105 transition-transform duration-300">
          <div class="text-2xl sm:text-3xl md:text-4xl font-bold gradient-text mb-1 sm:mb-2">
            <span>{{ animatedExperience }}</span>+
          </div>
          <div class="text-white/60 text-xs sm:text-sm">{{ $t('hero.stats.experience') }}</div>
        </div>
        <div class="text-center p-3 sm:p-4 glass-card-hero group hover:scale-105 transition-transform duration-300">
          <div class="text-2xl sm:text-3xl md:text-4xl font-bold gradient-text mb-1 sm:mb-2">
            <span>{{ animatedClients }}</span>%
          </div>
          <div class="text-white/60 text-xs sm:text-sm">{{ $t('hero.stats.clients') }}</div>
        </div>
        <div class="text-center p-3 sm:p-4 glass-card-hero group hover:scale-105 transition-transform duration-300">
          <div class="text-2xl sm:text-3xl md:text-4xl font-bold gradient-text mb-1 sm:mb-2">24/7</div>
          <div class="text-white/60 text-xs sm:text-sm">{{ $t('hero.stats.support') }}</div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="mt-8 sm:mt-12 flex items-center justify-center">
        <div class="inline-flex items-center gap-3 px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10">
          <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
          </span>
          <span class="text-white/70 text-xs sm:text-sm">Ostatnie zamowienie: dzisiaj o 14:32</span>
        </div>
      </div>
    </div>

    <!-- Scroll indicator - hidden on mobile -->
    <div class="hidden sm:block absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
      <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
      </svg>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const animatedProjects = ref(0)
const animatedExperience = ref(0)
const animatedClients = ref(0)

const animateValue = (refValue, endValue, duration) => {
  const startTime = performance.now()
  const animate = (currentTime) => {
    const elapsed = currentTime - startTime
    const progress = Math.min(elapsed / duration, 1)
    const easeOutQuart = 1 - Math.pow(1 - progress, 4)
    refValue.value = Math.floor(easeOutQuart * endValue)
    if (progress < 1) {
      requestAnimationFrame(animate)
    }
  }
  requestAnimationFrame(animate)
}

onMounted(() => {
  setTimeout(() => {
    animateValue(animatedProjects, 50, 2000)
    animateValue(animatedExperience, 8, 1500)
    animateValue(animatedClients, 100, 2500)
  }, 500)
})
</script>

<style scoped>
.glass-card-hero {
  @apply bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl;
}
</style>
