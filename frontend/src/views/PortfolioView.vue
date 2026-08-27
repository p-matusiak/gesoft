<template>
  <div>
    <PageHero
      :title="$t('portfolio.header.title')"
      :subtitle="$t('portfolio.header.subtitle')"
    />

    <section class="py-8 bg-white border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <FilterPills
          :items="filterItems"
          :model-value="activeCategory"
          @update:model-value="setCategory"
        />
      </div>
    </section>

    <!-- Stats Banner -->
    <!-- Portfolio Grid -->
    <section class="py-16 sm:py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <transition-group name="fade">
            <ProjectCard
              v-for="project in filteredProjects"
              :key="project.id"
              :project="project"
              :title="project.title"
              :description="project.description"
              :category-label="getCategoryLabel(project.category)"
              :overlay="$t('portfolio.viewProject')"
              :to="'/portfolio/' + project.key"
            >
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="tech in project.technologies"
                  :key="tech"
                  class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded"
                >
                  {{ tech }}
                </span>
              </div>
            </ProjectCard>
          </transition-group>
        </div>

        <div v-if="filteredProjects.length === 0" class="text-center py-20">
          <p class="text-gray-500 text-lg">{{ $t('portfolio.noProjects') }}</p>
        </div>
      </div>
    </section>

    <PageCta
      :title="$t('portfolio.cta.title')"
      :subtitle="$t('portfolio.cta.subtitle')"
      :button-label="$t('portfolio.cta.button')"
      :phone="$t('home.cta.phone')"
    />
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRoute, useRouter } from 'vue-router'
import { projectsData } from '@/data/projects'
import ProjectCard from '@/components/common/ProjectCard.vue'
import PageHero from '@/components/common/PageHero.vue'
import PageCta from '@/components/common/PageCta.vue'
import FilterPills from '@/components/common/FilterPills.vue'

const { t } = useI18n()
const route = useRoute()
const router = useRouter()

const activeCategory = ref('all')

const categories = [
  { value: 'all', labelKey: 'portfolio.filters.all' },
  { value: 'mobile', labelKey: 'portfolio.filters.mobile' },
  { value: 'website', labelKey: 'portfolio.filters.websites' },
  { value: 'webapp', labelKey: 'portfolio.filters.webapps' },
  { value: 'ecommerce', labelKey: 'portfolio.filters.ecommerce' },
  { value: 'crm', labelKey: 'portfolio.filters.crm' },
]

const filterItems = computed(() =>
  categories.map((category) => ({
    id: category.value,
    label: t(category.labelKey)
  }))
)

const setCategory = (value) => {
  activeCategory.value = value
  const query = { ...route.query }
  if (value === 'all') {
    delete query.kategoria
  } else {
    query.kategoria = value
  }
  router.replace({ query })
}

const projects = computed(() => {
  return projectsData.map(p => ({
    ...p,
    title: t(`portfolio.projects.${p.key}.title`),
    description: t(`portfolio.projects.${p.key}.description`),
    fullDescription: t(`portfolio.projects.${p.key}.fullDescription`)
  }))
})

const filteredProjects = computed(() => {
  if (activeCategory.value === 'all') {
    return projects.value
  }
  return projects.value.filter(p => p.category === activeCategory.value)
})

const getCategoryLabel = (value) => {
  const category = categories.find(c => c.value === value)
  return category ? t(category.labelKey) : value
}

watch(
  () => route.query.kategoria,
  (value) => {
    if (value && categories.some((category) => category.value === value)) {
      activeCategory.value = value
    }
  },
  { immediate: true }
)

watch(
  () => route.query.projekt,
  (key) => {
    if (!key) {
      return
    }
    const query = { ...route.query }
    delete query.projekt
    router.replace({ path: '/portfolio/' + key, query })
  },
  { immediate: true }
)
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}

.modal-enter-active,
.modal-leave-active {
  transition: all 0.2s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
</style>
