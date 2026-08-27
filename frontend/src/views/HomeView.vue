<template>
  <div>
    <HeroSection />

    <section class="py-16 sm:py-20 bg-gray-50 border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-10">
          <h2 class="section-title">{{ $t('home.work.title') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('home.work.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <ProjectCard
            v-for="project in featuredProjects"
            :key="project.key"
            :project="project"
            :title="project.title"
            :description="project.description"
            :category-label="project.categoryLabel"
            :to="'/portfolio/' + project.key"
            heading="h3"
            compact
          />
        </div>

        <div class="mt-10">
          <router-link to="/portfolio" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
            {{ $t('home.work.viewAll') }}
            <span aria-hidden="true"> →</span>
          </router-link>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
          <h2 class="section-title">{{ $t('home.process.title') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('home.process.subtitle') }}</p>
        </div>

        <ol class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12">
          <li v-for="(step, index) in processSteps" :key="index" class="relative">
            <span class="block text-sm font-semibold text-brand-600 mb-3">{{ String(index + 1).padStart(2, '0') }}</span>
            <h3 class="heading-3 text-gray-900 mb-2">{{ step.title }}</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ step.description }}</p>
          </li>
        </ol>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-gray-50 border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="section-title">{{ $t('packages.title') }}</h2>
          <p class="section-subtitle">{{ $t('packages.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white border border-gray-200 rounded-lg p-8">
            <h3 class="heading-3 text-gray-900 mb-2">{{ $t('packages.starter.name') }}</h3>
            <p class="text-gray-600 text-sm mb-6">{{ $t('packages.starter.description') }}</p>
            <div class="mb-6">
              <span class="text-3xl font-bold text-gray-900">{{ $t('packages.starter.price') }}</span>
              <span class="text-gray-500 ml-1">{{ $t('packages.starter.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.starter.features')" :key="i" class="flex items-start text-gray-700 text-sm">
                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.starter.cta') }}</router-link>
          </div>

          <div class="bg-white border-2 border-brand-600 rounded-lg p-8 relative">
            <div class="absolute -top-3 left-6">
              <span class="bg-brand-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $t('packages.popular') }}
              </span>
            </div>
            <h3 class="heading-3 text-gray-900 mb-2">{{ $t('packages.business.name') }}</h3>
            <p class="text-gray-600 text-sm mb-6">{{ $t('packages.business.description') }}</p>
            <div class="mb-6">
              <span class="text-3xl font-bold text-gray-900">{{ $t('packages.business.price') }}</span>
              <span class="text-gray-500 ml-1">{{ $t('packages.business.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.business.features')" :key="i" class="flex items-start text-gray-700 text-sm">
                <svg class="w-5 h-5 text-brand-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-primary w-full">{{ $t('packages.business.cta') }}</router-link>
          </div>

          <div class="bg-white border border-gray-200 rounded-lg p-8">
            <h3 class="heading-3 text-gray-900 mb-2">{{ $t('packages.enterprise.name') }}</h3>
            <p class="text-gray-600 text-sm mb-6">{{ $t('packages.enterprise.description') }}</p>
            <div class="mb-6">
              <span class="text-2xl font-bold text-gray-900">{{ $t('packages.enterprise.price') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.enterprise.features')" :key="i" class="flex items-start text-gray-700 text-sm">
                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.enterprise.cta') }}</router-link>
          </div>
        </div>

        <p class="text-center text-gray-500 text-sm mt-8">{{ $t('packages.note') }}</p>

        <ul class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
          <li v-for="item in promiseItems" :key="item.title" class="text-center md:text-left">
            <h3 class="heading-3 text-gray-900 mb-1">{{ item.title }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed">{{ item.description }}</p>
          </li>
        </ul>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-8">
          <h2 class="section-title">{{ $t('articles.homeTitle') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('articles.homeSubtitle') }}</p>
        </div>

        <div class="flex flex-wrap gap-2 mb-10">
          <router-link
            v-for="topic in industryTopics"
            :key="topic.to"
            :to="topic.to"
            class="px-3 py-1.5 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-full hover:border-brand-600 hover:text-brand-600 transition-colors"
          >
            {{ topic.label }}
          </router-link>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <ArticleCard
            v-for="article in latestArticles"
            :key="article.slug"
            :article="article"
            heading="h3"
          />
        </div>

        <div class="mt-10">
          <router-link to="/artykuly" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
            {{ $t('articles.viewAll') }}
            <span aria-hidden="true"> →</span>
          </router-link>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-gray-900">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="heading-2 text-white mb-4">
          {{ $t('home.cta.title') }}
        </h2>
        <p class="text-gray-300 mb-8 text-base sm:text-lg">
          {{ $t('home.cta.subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
          <router-link to="/kontakt" class="inline-flex items-center justify-center px-7 py-3 text-base font-semibold text-gray-900 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200">
            {{ $t('home.cta.button') }}
          </router-link>
          <a href="tel:+48517123374" class="text-white/80 text-sm hover:text-white">
            {{ $t('home.cta.phone') }}
          </a>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import HeroSection from '@/components/home/HeroSection.vue'
import ProjectCard from '@/components/common/ProjectCard.vue'
import ArticleCard from '@/components/articles/ArticleCard.vue'
import { fetchArticles } from '@/composables/useArticles'
import { getProjectsByKeys } from '@/data/projects'

const FEATURED_KEYS = ['restaurant', 'invoicing', 'transport']

const { t, tm, locale } = useI18n()
const latestArticles = ref([])

watch(
  locale,
  async () => {
    try {
      const items = await fetchArticles(locale.value)
      latestArticles.value = items.slice(0, 3)
    } catch {
      latestArticles.value = []
    }
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

const featuredProjects = computed(() => {
  return getProjectsByKeys(FEATURED_KEYS).map((project) => ({
    ...project,
    title: t(`portfolio.projects.${project.key}.title`),
    description: t(`portfolio.projects.${project.key}.description`),
    categoryLabel: t(categoryLabelKeys[project.category] || 'portfolio.filters.all')
  }))
})

const processSteps = computed(() => tm('home.process.steps'))
const promiseItems = computed(() => tm('home.promises'))
const industryTopics = computed(() => tm('home.topics'))
</script>
