<template>
  <div class="min-h-[60vh] flex items-center justify-center px-4">
    <div class="text-center">
      <div class="text-6xl font-bold text-brand-600 mb-4">404</div>
      <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $t('articles.notFound.title') }}</h1>
      <p class="text-gray-600 mb-8 max-w-md mx-auto">{{ $t('articles.notFound.description') }}</p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <router-link to="/artykuly" class="btn-primary">{{ $t('articles.back') }}</router-link>
        <router-link to="/kontakt" class="btn-secondary">{{ $t('nav.contact') }}</router-link>
      </div>
    </div>
  </div>
</template>
