<template>
  <div class="pt-20">
    <template v-if="article">
      <ArticleHero :article="article" />
      <ArticleBody :content="article.content" />
      <SectionCta
        variant="brand"
        :title="$t('articles.cta.title')"
        :subtitle="$t('articles.cta.subtitle')"
        :button-label="$t('articles.cta.button')"
      />
      <RelatedProjectList
        :projects="relatedProjectCards"
        :title="$t('articles.relatedProjects')"
        :subtitle="$t('articles.relatedProjectsSubtitle')"
        :all-label="$t('articles.viewAllProjects')"
      />
      <RelatedArticles
        :articles="related"
        :title="$t('articles.related')"
        :back-label="$t('articles.back')"
      />
    </template>
    <ArticleNotFound v-else-if="loaded" />
  </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import ArticleHero from '@/components/articles/ArticleHero.vue'
import ArticleBody from '@/components/articles/ArticleBody.vue'
import ArticleNotFound from '@/components/articles/ArticleNotFound.vue'
import RelatedProjectList from '@/components/articles/RelatedProjectList.vue'
import RelatedArticles from '@/components/articles/RelatedArticles.vue'
import SectionCta from '@/components/common/SectionCta.vue'
import { fetchArticle } from '@/composables/useArticles'
import { useSeo } from '@/composables/useSeo'
import { getProjectsByKeys } from '@/data/projects'

const route = useRoute()
const { t, locale } = useI18n()
const { updateSeo } = useSeo()

const article = ref(null)
const related = computed(() => article.value?.related || [])
const loaded = ref(false)

watch(
  [() => route.params.slug, locale],
  async () => {
    loaded.value = false
    try {
      article.value = await fetchArticle(route.params.slug, locale.value)
    } catch {
      article.value = null
    }
    loaded.value = true
    updateSeo()
  },
  { immediate: true }
)

const categoryLabelKeys = {
  mobile: 'portfolio.filters.mobile',
  website: 'portfolio.filters.websites',
  webapp: 'portfolio.filters.webapps',
  ecommerce: 'portfolio.filters.ecommerce',
  crm: 'portfolio.filters.crm'
}

const relatedProjectCards = computed(() => {
  if (!article.value?.relatedProjects?.length) return []
  return getProjectsByKeys(article.value.relatedProjects).map((project) => ({
    ...project,
    title: t(`portfolio.projects.${project.key}.title`),
    description: t(`portfolio.projects.${project.key}.description`),
    categoryLabel: t(categoryLabelKeys[project.category] || 'portfolio.filters.all')
  }))
})

watch(
  article,
  (value) => {
    let robotsMeta = document.querySelector('meta[name="robots"]')
    if (!robotsMeta) {
      robotsMeta = document.createElement('meta')
      robotsMeta.setAttribute('name', 'robots')
      document.head.appendChild(robotsMeta)
    }
    robotsMeta.setAttribute('content', value ? 'index, follow' : 'noindex, nofollow')
    if (!value && loaded.value) {
      document.title = 'Nie znaleziono artykułu | GESOFT'
    }
  },
  { immediate: true }
)
</script>
