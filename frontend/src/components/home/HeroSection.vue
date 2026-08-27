<template>
  <section class="relative bg-white pt-16 pb-16 sm:pt-20 sm:pb-20 lg:pt-24 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl">
        <p class="text-sm font-medium text-brand-600 mb-4">
          {{ $t('hero.badge') }}
        </p>

        <h1 class="heading-1 text-gray-900 mb-5">
          {{ $t('hero.title') }}
        </h1>

        <p class="text-base sm:text-lg text-gray-600 mb-8 max-w-2xl leading-relaxed">
          {{ $t('hero.subtitle') }}
        </p>

        <ul class="flex flex-wrap gap-x-6 gap-y-2 mb-8 text-sm text-gray-600">
          <li v-for="item in $tm('hero.trust')" :key="item" class="flex items-center gap-2">
            <svg class="w-4 h-4 text-brand-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ item }}
          </li>
        </ul>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
          <router-link to="/kontakt" class="btn-primary px-7 py-3 text-base">
            <span class="flex items-center justify-center">
              {{ $t('hero.cta') }}
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </span>
          </router-link>
          <router-link to="/portfolio" class="btn-secondary px-7 py-3 text-base">
            {{ $t('hero.ctaSecondary') }}
          </router-link>
        </div>

        <p class="mt-6 text-sm text-gray-500">{{ $t('hero.stackLine') }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
