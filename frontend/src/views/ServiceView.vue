<template>
  <div class="pt-12 sm:pt-14 lg:pt-16">
    <template v-if="service">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-2">
          <li>
            <router-link to="/uslugi" class="hover:text-brand-600">{{ $t('nav.services') }}</router-link>
          </li>
          <li aria-hidden="true">/</li>
          <li class="text-gray-900 font-medium">{{ service.navLabel }}</li>
        </ol>
      </nav>

      <article class="pb-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ service.h1 }}</h1>
          <p class="text-lg text-gray-700 mb-10 leading-relaxed">{{ service.lead }}</p>

          <section v-for="section in service.sections" :key="section.title" class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ section.title }}</h2>
            <p v-if="section.text" class="text-gray-700 leading-relaxed">{{ section.text }}</p>
            <ul v-if="section.items?.length" class="mt-4 space-y-2">
              <li v-for="item in section.items" :key="item" class="text-gray-700">{{ item }}</li>
            </ul>
          </section>

          <section v-if="service.faq?.length" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('articles.faqTitle') }}</h2>
            <dl class="space-y-6">
              <div v-for="item in service.faq" :key="item.q">
                <dt class="font-semibold text-gray-900">{{ item.q }}</dt>
                <dd class="text-gray-700 mt-1 leading-relaxed">{{ item.a }}</dd>
              </div>
            </dl>
          </section>

          <router-link to="/kontakt" class="btn-primary inline-flex">{{ $t('hero.cta') }}</router-link>
        </div>
      </article>

      <RelatedProjectList
        v-if="relatedProjects.length"
        :projects="relatedProjects"
        :title="$t('articles.relatedProjects')"
        :all-label="$t('articles.viewAllProjects')"
      />

      <section v-if="relatedArticles.length" class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ $t('articles.related') }}</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <ArticleCard
              v-for="article in relatedArticles"
              :key="article.slug"
              :article="article"
              heading="h3"
            />
          </div>
        </div>
      </section>

      <PageCta
        :title="$t('services.cta.title')"
        :subtitle="$t('services.cta.subtitle')"
        :button-label="$t('services.cta.button')"
        :phone="$t('home.cta.phone')"
      />
    </template>
    <div v-else class="max-w-3xl mx-auto px-4 py-24 text-center">
      <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $t('notFound.title') }}</h1>
      <router-link to="/uslugi" class="text-brand-600 font-semibold">{{ $t('nav.services') }}</router-link>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { findService } from '@/data/services'
import { getProjectsByKeys } from '@/data/projects'
import { fetchArticle } from '@/composables/useArticles'
import RelatedProjectList from '@/components/articles/RelatedProjectList.vue'
import ArticleCard from '@/components/articles/ArticleCard.vue'
import PageCta from '@/components/common/PageCta.vue'

const route = useRoute()
const { t, locale } = useI18n()

const service = computed(() => findService(route.params.slug, locale.value))
const relatedArticles = ref([])

const categoryLabelKeys = {
  mobile: 'portfolio.filters.mobile',
  website: 'portfolio.filters.websites',
  webapp: 'portfolio.filters.webapps',
  ecommerce: 'portfolio.filters.ecommerce',
  crm: 'portfolio.filters.crm'
}

const relatedProjects = computed(() => {
  if (!service.value?.relatedInspirations?.length) {
    return []
  }
  return getProjectsByKeys(service.value.relatedInspirations).map((project) => ({
    ...project,
    title: t(`portfolio.projects.${project.key}.title`),
    description: t(`portfolio.projects.${project.key}.description`),
    categoryLabel: t(categoryLabelKeys[project.category] || 'portfolio.filters.all')
  }))
})

watch(
  [service, locale],
  async () => {
    relatedArticles.value = []
    if (!service.value?.relatedArticles?.length) {
      return
    }
    const loaded = await Promise.all(
      service.value.relatedArticles.map((slug) => fetchArticle(slug, locale.value).catch(() => null))
    )
    relatedArticles.value = loaded.filter(Boolean)
  },
  { immediate: true }
)
</script>
