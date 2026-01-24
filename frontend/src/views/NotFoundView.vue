<template>
  <div class="min-h-screen flex items-center justify-center bg-dark-900 px-4">
    <div class="text-center">
      <div class="text-9xl font-bold gradient-text mb-4">404</div>
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
        {{ $t('notFound.title') }}
      </h1>
      <p class="text-dark-400 text-lg mb-8 max-w-md mx-auto">
        {{ $t('notFound.description') }}
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <router-link to="/" class="btn-primary px-8 py-3">
          {{ $t('notFound.backHome') }}
        </router-link>
        <router-link to="/kontakt" class="btn-secondary px-8 py-3">
          {{ $t('notFound.contact') }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  // Set noindex for 404 page
  let robotsMeta = document.querySelector('meta[name="robots"]')
  if (robotsMeta) {
    robotsMeta.setAttribute('content', 'noindex, nofollow')
  }
  document.title = '404 - Strona nie znaleziona | GESOFT'
})
</script>
