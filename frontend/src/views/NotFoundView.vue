<template>
  <div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="text-center">
      <div class="text-8xl md:text-9xl font-bold text-brand-600 mb-4">404</div>
      <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        {{ $t('notFound.title') }}
      </h1>
      <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
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
  let robotsMeta = document.querySelector('meta[name="robots"]')
  if (robotsMeta) {
    robotsMeta.setAttribute('content', 'noindex, nofollow')
  }
  document.title = '404 - Strona nie znaleziona | GESOFT'
})
</script>
