<template>
  <PageHeader
    :title="article.title"
    :subtitle="article.excerpt"
    align="left"
    compact
  >
    <template #before>
      <div>
        <BreadcrumbNav :items="breadcrumbs" />
        <div class="flex flex-wrap items-center gap-3 mb-5">
          <CategoryBadge :tone="article.category">
            {{ $t(`articles.categories.${article.category}`) }}
          </CategoryBadge>
          <time class="text-sm text-gray-500" :datetime="article.publishedAt">
            {{ formatArticleDate(article.publishedAt, locale) }}
          </time>
          <span class="text-sm text-gray-400" aria-hidden="true">·</span>
          <span class="text-sm text-gray-500">{{ article.readTime }} {{ $t('articles.readTime') }}</span>
        </div>
      </div>
    </template>
  </PageHeader>
</template>

<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'
import PageHeader from '@/components/common/PageHeader.vue'
import BreadcrumbNav from '@/components/common/BreadcrumbNav.vue'
import CategoryBadge from '@/components/common/CategoryBadge.vue'
import { formatArticleDate } from '@/data/articles-format'

const props = defineProps({
  article: {
    type: Object,
    required: true
  }
})

const { t, locale } = useI18n()

const breadcrumbs = computed(() => [
  { label: t('nav.home'), to: '/' },
  { label: t('nav.articles'), to: '/artykuly' },
  { label: props.article.title }
])
</script>
