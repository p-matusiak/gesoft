<template>
  <div class="pt-12 sm:pt-14 lg:pt-16">
    <template v-if="project">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-2">
          <li>
            <router-link to="/portfolio" class="hover:text-brand-600">{{ $t('nav.portfolio') }}</router-link>
          </li>
          <li aria-hidden="true">/</li>
          <li class="text-gray-900 font-medium line-clamp-1">{{ project.title }}</li>
        </ol>
      </nav>

      <article class="pb-16 sm:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
              <img :src="project.image" :alt="project.title" class="w-full h-full object-cover" width="960" height="540" />
            </div>
            <div>
              <span class="text-sm text-brand-600 uppercase tracking-wider font-semibold">{{ categoryLabel }}</span>
              <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-2 mb-4">{{ project.title }}</h1>
              <p class="text-gray-700 mb-6 whitespace-pre-line">{{ project.fullDescription }}</p>
              <div v-if="project.category === 'mobile'" class="flex items-start gap-3 bg-orange-50 border border-orange-200 rounded-md px-4 py-3 mb-6">
                <p class="text-sm text-orange-700">{{ $t('portfolio.mobileBackendNote') }}</p>
              </div>
              <h2 class="text-lg font-semibold text-gray-900 mb-3">{{ $t('portfolio.technologiesUsed') }}</h2>
              <div class="flex flex-wrap gap-2 mb-8">
                <span
                  v-for="tech in project.technologies"
                  :key="tech"
                  class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded"
                >
                  {{ tech }}
                </span>
              </div>
              <router-link
                :to="{ path: '/kontakt', query: { projekt: project.title } }"
                class="btn-primary inline-flex"
              >
                {{ $t('portfolio.wantSimilar') }}
              </router-link>
            </div>
          </div>
        </div>
      </article>

      <section v-if="related.length" class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ $t('portfolio.related') }}</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <ProjectCard
              v-for="item in related"
              :key="item.key"
              :project="item"
              :title="item.title"
              :description="item.description"
              :category-label="item.categoryLabel"
              :to="'/portfolio/' + item.key"
              compact
            />
          </div>
          <router-link to="/portfolio" class="inline-block mt-8 text-sm font-semibold text-brand-600 hover:text-brand-700">
            {{ $t('home.work.viewAll') }}
            <span aria-hidden="true"> →</span>
          </router-link>
        </div>
      </section>

      <PageCta
        :title="$t('portfolio.cta.title')"
        :subtitle="$t('portfolio.cta.subtitle')"
        :button-label="$t('portfolio.cta.button')"
        :phone="$t('home.cta.phone')"
      />
    </template>
    <div v-else class="max-w-3xl mx-auto px-4 py-24 text-center">
      <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $t('notFound.title') }}</h1>
      <router-link to="/portfolio" class="text-brand-600 font-semibold">{{ $t('nav.portfolio') }}</router-link>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { projectsData } from '@/data/projects'
import ProjectCard from '@/components/common/ProjectCard.vue'
import PageCta from '@/components/common/PageCta.vue'

const route = useRoute()
const { t } = useI18n()

const categoryLabelKeys = {
  mobile: 'portfolio.filters.mobile',
  website: 'portfolio.filters.websites',
  webapp: 'portfolio.filters.webapps',
  ecommerce: 'portfolio.filters.ecommerce',
  crm: 'portfolio.filters.crm'
}

const localized = (item) => ({
  ...item,
  title: t(`portfolio.projects.${item.key}.title`),
  description: t(`portfolio.projects.${item.key}.description`),
  fullDescription: t(`portfolio.projects.${item.key}.fullDescription`),
  categoryLabel: t(categoryLabelKeys[item.category] || 'portfolio.filters.all')
})

const project = computed(() => {
  const item = projectsData.find((entry) => entry.key === route.params.key)
  return item ? localized(item) : null
})

const categoryLabel = computed(() => project.value?.categoryLabel || '')

const related = computed(() => {
  if (!project.value) {
    return []
  }
  return projectsData
    .filter((item) => item.key !== project.value.key && item.category === project.value.category)
    .slice(0, 3)
    .map(localized)
})
</script>
