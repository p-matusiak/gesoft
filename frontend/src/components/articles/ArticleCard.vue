<template>
  <article class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover:border-brand-200 transition-all duration-200 flex flex-col h-full">
    <div class="flex items-center gap-3 mb-4">
      <CategoryBadge :tone="article.category">
        {{ $t(`articles.categories.${article.category}`) }}
      </CategoryBadge>
      <time class="text-xs text-gray-500" :datetime="article.publishedAt">
        {{ formatArticleDate(article.publishedAt, locale) }}
      </time>
    </div>

    <component :is="heading" class="heading-3 text-gray-900 mb-3">
      <router-link :to="`/artykuly/${article.slug}`" class="hover:text-brand-600 transition-colors">
        {{ article.title }}
      </router-link>
    </component>

    <p class="text-gray-600 text-sm leading-relaxed mb-5 flex-grow">
      {{ article.excerpt }}
    </p>

    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
      <span class="text-xs text-gray-500">{{ article.readTime }} {{ $t('articles.readTime') }}</span>
      <router-link
        :to="`/artykuly/${article.slug}`"
        class="inline-flex items-center text-sm font-semibold text-brand-600 hover:text-brand-700"
      >
        {{ $t('articles.readMore') }}
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </router-link>
    </div>
  </article>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import CategoryBadge from '@/components/common/CategoryBadge.vue'
import { formatArticleDate } from '@/data/articles-format'

defineProps({
  article: {
    type: Object,
    required: true
  },
  heading: {
    type: String,
    default: 'h3'
  }
})

const { locale } = useI18n()
</script>
