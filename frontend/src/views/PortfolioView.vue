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
              @select="openModal(project)"
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

    <!-- Modal -->
    <transition name="modal">
      <div v-if="selectedProject" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" @click="closeModal">
        <div class="bg-white border border-gray-200 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
          <div class="aspect-video bg-gray-100 relative">
            <img :src="selectedProject.image" :alt="selectedProject.title" class="w-full h-full object-cover" />
            <button @click="closeModal" class="absolute top-4 right-4 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-gray-700 hover:bg-white transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="p-8">
            <span class="text-sm text-brand-600 uppercase tracking-wider block font-semibold">{{ getCategoryLabel(selectedProject.category) }}</span>
            <h2 class="text-2xl font-bold text-gray-900 mt-2 mb-4">{{ selectedProject.title }}</h2>
            <p class="text-gray-700 mb-6 whitespace-pre-line">{{ selectedProject.fullDescription }}</p>
            <div v-if="selectedProject.category === 'mobile'" class="flex items-start gap-3 bg-orange-50 border border-orange-200 rounded-md px-4 py-3 mb-6">
              <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
              </svg>
              <p class="text-sm text-orange-700">{{ $t('portfolio.mobileBackendNote') }}</p>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 mb-3">{{ $t('portfolio.technologiesUsed') }}</h4>
            <div class="flex flex-wrap gap-2 mb-6">
              <span
                v-for="tech in selectedProject.technologies"
                :key="tech"
                class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded"
              >
                {{ tech }}
              </span>
            </div>
            <button @click="goToContact(selectedProject)" class="btn-primary w-full text-center">
              {{ $t('portfolio.wantSimilar') }}
            </button>
          </div>
        </div>
      </div>
    </transition>

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
const selectedProject = ref(null)

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

const showProject = (project) => {
  selectedProject.value = project
  document.body.style.overflow = 'hidden'
}

const openModal = (project) => {
  showProject(project)
  if (route.query.projekt !== project.key) {
    router.replace({ query: { ...route.query, projekt: project.key } })
  }
}

const closeModal = () => {
  selectedProject.value = null
  document.body.style.overflow = ''
  if (route.query.projekt) {
    const query = { ...route.query }
    delete query.projekt
    router.replace({ query })
  }
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
  [() => route.query.projekt, projects],
  ([key]) => {
    if (!key) {
      return
    }
    const project = projects.value.find((item) => item.key === key)
    if (project && selectedProject.value?.key !== project.key) {
      showProject(project)
    }
  },
  { immediate: true }
)

const goToContact = (project) => {
  selectedProject.value = null
  document.body.style.overflow = ''
  router.push({ path: '/kontakt', query: { projekt: project.title } })
}
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
