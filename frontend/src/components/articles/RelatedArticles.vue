<template>
  <section v-if="articles.length" class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ title }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <ArticleCard
          v-for="article in articles"
          :key="article.slug"
          :article="article"
        />
      </div>
      <div class="text-center mt-10">
        <router-link to="/artykuly" class="btn-secondary">{{ backLabel }}</router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import ArticleCard from '@/components/articles/ArticleCard.vue'

defineProps({
  articles: {
    type: Array,
    default: () => []
  },
  title: {
    type: String,
    required: true
  },
  backLabel: {
    type: String,
    required: true
  }
})
</script>
