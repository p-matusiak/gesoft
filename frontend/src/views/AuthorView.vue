<template>
  <div class="pt-12 sm:pt-14 lg:pt-16 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="mb-6 text-sm text-gray-500">
        <router-link to="/o-nas" class="hover:text-brand-600">{{ $t('nav.about') }}</router-link>
        <span class="mx-2" aria-hidden="true">/</span>
        <span class="text-gray-900 font-medium">Paweł Matusiak</span>
      </nav>
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Paweł Matusiak</h1>
      <p class="text-brand-600 font-medium mb-6">{{ $t('author.role') }}</p>
      <p class="text-gray-700 leading-relaxed mb-4">{{ $t('author.bio1') }}</p>
      <p class="text-gray-700 leading-relaxed mb-8">{{ $t('author.bio2') }}</p>
      <p class="text-sm text-gray-600 mb-10">
        GESOFT Paweł Matusiak · NIP 9372553467 ·
        <a href="mailto:biuro@gesoft.pl" class="text-brand-600">biuro@gesoft.pl</a>
      </p>
    </div>

    <section v-if="articles.length" class="bg-gray-50 border-y border-gray-100 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ $t('author.articles') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <ArticleCard
            v-for="article in articles"
            :key="article.slug"
            :article="article"
            heading="h3"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import ArticleCard from '@/components/articles/ArticleCard.vue'
import { fetchArticles } from '@/composables/useArticles'

const { locale } = useI18n()
const articles = ref([])

watch(
  locale,
  async () => {
    try {
      articles.value = (await fetchArticles(locale.value)).slice(0, 12)
    } catch {
      articles.value = []
    }
  },
  { immediate: true }
)
</script>
