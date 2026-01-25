<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-20 bg-hero-gradient relative overflow-hidden">
      <div class="absolute inset-0 pattern-bg"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
          <span class="gradient-text">{{ $t('portfolio.header.title') }}</span>
        </h1>
        <p class="text-xl text-white/70 max-w-2xl mx-auto">
          {{ $t('portfolio.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Filter -->
    <section class="py-8 bg-dark-900 border-b border-dark-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
          <button
            v-for="category in categories"
            :key="category.value"
            @click="activeCategory = category.value"
            class="px-6 py-2 rounded-full font-medium transition-all duration-300"
            :class="[
              activeCategory === category.value
                ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white'
                : 'bg-dark-800 text-dark-300 hover:text-white hover:bg-dark-700'
            ]"
          >
            {{ $t(category.labelKey) }}
          </button>
        </div>
      </div>
    </section>

    <!-- Stats Banner -->
    <section class="py-8 bg-dark-950 border-b border-dark-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <div>
            <div class="text-3xl font-bold gradient-text">50+</div>
            <p class="text-dark-400 text-sm">Zrealizowanych projektow</p>
          </div>
          <div>
            <div class="text-3xl font-bold gradient-text">100%</div>
            <p class="text-dark-400 text-sm">Zadowolonych klientow</p>
          </div>
          <div>
            <div class="text-3xl font-bold gradient-text">4.9/5</div>
            <p class="text-dark-400 text-sm">Srednia ocena</p>
          </div>
          <div>
            <div class="text-3xl font-bold gradient-text">6+</div>
            <p class="text-dark-400 text-sm">Branz obslugiwanych</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <transition-group name="fade">
            <div
              v-for="project in filteredProjects"
              :key="project.id"
              class="glass-card overflow-hidden group cursor-pointer"
              @click="openModal(project)"
            >
              <div class="aspect-video bg-gradient-to-br from-primary-900 to-secondary-900 relative overflow-hidden">
                <img :src="project.image" :alt="project.title" class="w-full h-full object-cover" />
                <!-- Metric Badge -->
                <div v-if="project.metric" class="absolute top-4 right-4 bg-green-500/90 backdrop-blur-sm px-3 py-1 rounded-full">
                  <span class="text-white font-bold text-sm">{{ project.metric }}</span>
                  <span class="text-white/80 text-xs ml-1">{{ project.metricLabel }}</span>
                </div>
                <div class="absolute inset-0 bg-dark-900/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                  <span class="text-white font-medium">{{ $t('portfolio.viewProject') }}</span>
                </div>
              </div>
              <div class="p-6">
                <span class="text-xs text-primary-400 uppercase tracking-wider">{{ getCategoryLabel(project.category) }}</span>
                <h3 class="text-xl font-semibold text-white mt-2 mb-2">{{ project.title }}</h3>
                <p class="text-dark-400 text-sm mb-4">{{ project.description }}</p>
                <div class="flex flex-wrap gap-2">
                  <span
                    v-for="tech in project.technologies"
                    :key="tech"
                    class="px-2 py-1 bg-dark-700 text-dark-300 text-xs rounded"
                  >
                    {{ tech }}
                  </span>
                </div>
              </div>
            </div>
          </transition-group>
        </div>

        <div v-if="filteredProjects.length === 0" class="text-center py-20">
          <p class="text-dark-400 text-lg">{{ $t('portfolio.noProjects') }}</p>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <transition name="modal">
      <div v-if="selectedProject" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-dark-900/80 backdrop-blur-sm" @click="closeModal">
        <div class="glass-card max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
          <div class="aspect-video bg-gradient-to-br from-primary-900 to-secondary-900 relative">
            <img :src="selectedProject.image" :alt="selectedProject.title" class="w-full h-full object-cover" />
            <button @click="closeModal" class="absolute top-4 right-4 w-10 h-10 bg-dark-900/50 rounded-full flex items-center justify-center text-white hover:bg-dark-900 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="p-8">
            <!-- Result Badge -->
            <div v-if="selectedProject.metric" class="inline-flex items-center gap-2 bg-green-500/20 border border-green-500/30 px-4 py-2 rounded-lg mb-4">
              <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
              </svg>
              <span class="text-green-400 font-bold">{{ selectedProject.metric }}</span>
              <span class="text-green-300">{{ selectedProject.metricLabel }}</span>
            </div>
            <span class="text-sm text-primary-400 uppercase tracking-wider block">{{ getCategoryLabel(selectedProject.category) }}</span>
            <h2 class="text-2xl font-bold text-white mt-2 mb-4">{{ selectedProject.title }}</h2>
            <p class="text-dark-300 mb-6">{{ selectedProject.fullDescription }}</p>
            <h4 class="text-lg font-semibold text-white mb-3">{{ $t('portfolio.technologiesUsed') }}</h4>
            <div class="flex flex-wrap gap-2 mb-6">
              <span
                v-for="tech in selectedProject.technologies"
                :key="tech"
                class="px-3 py-1 bg-dark-700 text-dark-300 text-sm rounded"
              >
                {{ tech }}
              </span>
            </div>
            <router-link to="/kontakt" class="btn-primary w-full text-center">
              {{ $t('portfolio.wantSimilar') }}
            </router-link>
          </div>
        </div>
      </div>
    </transition>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('portfolio.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('portfolio.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg">
          {{ $t('portfolio.cta.button') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const activeCategory = ref('all')
const selectedProject = ref(null)

const categories = [
  { value: 'all', labelKey: 'portfolio.filters.all' },
  { value: 'website', labelKey: 'portfolio.filters.websites' },
  { value: 'webapp', labelKey: 'portfolio.filters.webapps' },
  { value: 'ecommerce', labelKey: 'portfolio.filters.ecommerce' },
  { value: 'crm', labelKey: 'portfolio.filters.crm' },
]

const projectsData = [
  { id: 1, key: 'crm', image: '/portfolio/crm.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'], metric: '-60%', metricLabel: 'czas obslugi' },
  { id: 2, key: 'furniture', image: '/portfolio/furniture.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'], metric: '+247%', metricLabel: 'wzrost sprzedazy' },
  { id: 3, key: 'medical', image: '/portfolio/medical.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Redis', 'WebSockets'], metric: '+180%', metricLabel: 'wiecej pacjentow' },
  { id: 4, key: 'corporate', image: '/portfolio/corporate.svg', category: 'website', technologies: ['Laravel', 'TailwindCSS', 'Alpine.js'], metric: '95+', metricLabel: 'PageSpeed' },
  { id: 5, key: 'projectMgmt', image: '/portfolio/projectmgmt.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'WebSockets', 'PostgreSQL'], metric: '3x', metricLabel: 'produktywnosc' },
  { id: 6, key: 'booking', image: '/portfolio/booking.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Google API', 'MySQL'], metric: '5x', metricLabel: 'wiecej rezerwacji' },
]

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

const openModal = (project) => {
  selectedProject.value = project
  document.body.style.overflow = 'hidden'
}

const closeModal = () => {
  selectedProject.value = null
  document.body.style.overflow = ''
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
  transition: all 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .glass-card,
.modal-leave-to .glass-card {
  transform: scale(0.9);
}
</style>
