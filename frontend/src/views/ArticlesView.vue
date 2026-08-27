<template>
  <div class="pt-12 sm:pt-14 lg:pt-16">
    <PageHeader
      :title="$t('articles.header.title')"
      :subtitle="$t('articles.header.subtitle')"
      brand
    />

    <section class="py-12 sm:py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <FilterPills :items="filters" :model-value="activeFilter" class="mb-12" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <ArticleCard
            v-for="article in visibleArticles"
            :key="article.slug"
            :article="article"
            heading="h2"
          />
        </div>
      </div>
    </section>

    <SectionCta
      :title="$t('articles.cta.title')"
      :subtitle="$t('articles.cta.subtitle')"
      :button-label="$t('articles.cta.button')"
    />
  </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import PageHeader from '@/components/common/PageHeader.vue'
import FilterPills from '@/components/common/FilterPills.vue'
import SectionCta from '@/components/common/SectionCta.vue'
import ArticleCard from '@/components/articles/ArticleCard.vue'
import { fetchArticles } from '@/composables/useArticles'

const { t, locale } = useI18n()
const route = useRoute()
const visibleArticles = ref([])

const activeFilter = computed(() => {
  const category = route.query.kategoria
  if (['industry', 'laravel', 'security', 'business'].includes(category)) {
    return category
  }
  return 'all'
})

const filters = computed(() => [
  { id: 'all', label: t('articles.filters.all'), to: '/artykuly' },
  { id: 'industry', label: t('articles.filters.industry'), to: { path: '/artykuly', query: { kategoria: 'industry' } } },
  { id: 'laravel', label: t('articles.filters.laravel'), to: { path: '/artykuly', query: { kategoria: 'laravel' } } },
  { id: 'security', label: t('articles.filters.security'), to: { path: '/artykuly', query: { kategoria: 'security' } } },
  { id: 'business', label: t('articles.filters.business'), to: { path: '/artykuly', query: { kategoria: 'business' } } }
])

watch(
  [activeFilter, locale],
  async () => {
    try {
      const category = activeFilter.value === 'all' ? null : activeFilter.value
      visibleArticles.value = await fetchArticles(locale.value, category)
    } catch {
      visibleArticles.value = []
    }
  },
  { immediate: true }
)
</script>
