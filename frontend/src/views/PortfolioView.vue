<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-16 sm:py-20 bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-5">
          <span class="text-brand-600">{{ $t('portfolio.header.title') }}</span>
        </h1>
        <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
          {{ $t('portfolio.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Filter -->
    <section class="py-8 bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3">
          <button
            v-for="category in categories"
            :key="category.value"
            @click="activeCategory = category.value"
            class="px-5 py-2 rounded-full font-medium text-sm transition-colors duration-200"
            :class="[
              activeCategory === category.value
                ? 'bg-brand-600 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            ]"
          >
            {{ $t(category.labelKey) }}
          </button>
        </div>
      </div>
    </section>

    <!-- Stats Banner -->
    <!-- Portfolio Grid -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <transition-group name="fade">
            <div
              v-for="project in filteredProjects"
              :key="project.id"
              class="bg-white border border-gray-200 rounded-lg overflow-hidden group cursor-pointer hover:shadow-md transition-shadow duration-200"
              @click="openModal(project)"
            >
              <div class="aspect-video bg-gray-100 relative overflow-hidden">
                <img :src="project.image" :alt="project.title" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gray-900/70 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                  <span class="text-white font-medium">{{ $t('portfolio.viewProject') }}</span>
                </div>
              </div>
              <div class="p-6">
                <span class="text-xs text-brand-600 uppercase tracking-wider font-semibold">{{ getCategoryLabel(project.category) }}</span>
                <h3 class="text-xl font-semibold text-gray-900 mt-2 mb-2">{{ project.title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ project.description }}</p>
                <div class="flex flex-wrap gap-2">
                  <span
                    v-for="tech in project.technologies"
                    :key="tech"
                    class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded"
                  >
                    {{ tech }}
                  </span>
                </div>
              </div>
            </div>
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
            <router-link to="/kontakt" class="btn-primary w-full text-center">
              {{ $t('portfolio.wantSimilar') }}
            </router-link>
          </div>
        </div>
      </div>
    </transition>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
          {{ $t('portfolio.cta.title') }}
        </h2>
        <p class="text-lg text-gray-300 mb-8">
          {{ $t('portfolio.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-brand-700 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200">
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
  { value: 'mobile', labelKey: 'portfolio.filters.mobile' },
  { value: 'website', labelKey: 'portfolio.filters.websites' },
  { value: 'webapp', labelKey: 'portfolio.filters.webapps' },
  { value: 'ecommerce', labelKey: 'portfolio.filters.ecommerce' },
  { value: 'crm', labelKey: 'portfolio.filters.crm' },
]

const projectsData = [
  { id: 1, key: 'crm', image: '/portfolio/crm.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 2, key: 'furniture', image: '/portfolio/furniture.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 3, key: 'medical', image: '/portfolio/medical.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Redis', 'WebSockets'] },
  { id: 4, key: 'corporate', image: '/portfolio/corporate.svg', category: 'website', technologies: ['Laravel', 'TailwindCSS', 'Alpine.js'] },
  { id: 5, key: 'projectMgmt', image: '/portfolio/projectmgmt.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'WebSockets', 'PostgreSQL'] },
  { id: 6, key: 'booking', image: '/portfolio/booking.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Google API', 'MySQL'] },
  { id: 7, key: 'delivery', image: '/portfolio/delivery.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Laravel API', 'MySQL', 'Firebase FCM', 'Google Maps'] },
  { id: 8, key: 'fieldService', image: '/portfolio/fieldservice.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Laravel API', 'MySQL', 'Firebase FCM'] },
  { id: 9, key: 'restaurant', image: '/portfolio/restaurant.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'WebSockets'] },
  { id: 10, key: 'realEstate', image: '/portfolio/realestate.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Google Maps API'] },
  { id: 11, key: 'hr', image: '/portfolio/hr.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis'] },
  // Mobile apps
  { id: 12, key: 'fitness', image: '/portfolio/fitness.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Jetpack Compose', 'Laravel API', 'Health Connect'] },
  { id: 13, key: 'parking', image: '/portfolio/parking.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Google Maps SDK', 'Laravel API', 'Stripe'] },
  { id: 14, key: 'pharmacy', image: '/portfolio/pharmacy.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Room Database', 'Laravel API', 'Firebase FCM'] },
  { id: 15, key: 'fleet', image: '/portfolio/fleet.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Google Maps', 'Laravel API', 'Firebase FCM'] },
  { id: 16, key: 'schoolapp', image: '/portfolio/schoolapp.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Firebase Messaging', 'Laravel API', 'MySQL'] },
  { id: 17, key: 'warehousemobile', image: '/portfolio/warehousemobile.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'CameraX', 'Room Database', 'Laravel API'] },
  { id: 18, key: 'taxiapp', image: '/portfolio/taxiapp.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Google Maps', 'Firebase', 'Laravel API', 'Stripe'] },
  { id: 19, key: 'eventsapp', image: '/portfolio/eventsapp.svg', category: 'mobile', technologies: ['Android (Kotlin)', 'Jetpack Compose', 'Laravel API', 'Stripe'] },
  // E-commerce
  { id: 20, key: 'cosmetics', image: '/portfolio/cosmetics.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 21, key: 'electronics', image: '/portfolio/electronics.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL', 'Redis'] },
  { id: 22, key: 'foodshop', image: '/portfolio/foodshop.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Google Maps API', 'Stripe', 'MySQL'] },
  { id: 23, key: 'autoparts', image: '/portfolio/autoparts.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 24, key: 'bookstore', image: '/portfolio/bookstore.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL', 'Elasticsearch'] },
  { id: 25, key: 'sportsstore', image: '/portfolio/sportsstore.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 26, key: 'wholesale', image: '/portfolio/wholesale.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  // CRM / ERP
  { id: 27, key: 'invoicing', image: '/portfolio/invoicing.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Stripe'] },
  { id: 28, key: 'inventory', image: '/portfolio/inventory.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 29, key: 'rental', image: '/portfolio/rental.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 30, key: 'dental', image: '/portfolio/dental.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL'] },
  { id: 31, key: 'lawcrm', image: '/portfolio/lawcrm.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis'] },
  { id: 32, key: 'hotel', image: '/portfolio/hotel.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'WebSockets'] },
  { id: 33, key: 'construction', image: '/portfolio/construction.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 34, key: 'saloncrm', image: '/portfolio/saloncrm.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Twilio SMS'] },
  // Web apps
  { id: 35, key: 'elearning', image: '/portfolio/elearning.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Stripe', 'WebSockets'] },
  { id: 36, key: 'survey', image: '/portfolio/survey.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL'] },
  { id: 37, key: 'logistics', image: '/portfolio/logistics.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Google Maps', 'MySQL', 'WebSockets'] },
  { id: 38, key: 'helpdesk', image: '/portfolio/helpdesk.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis', 'WebSockets'] },
  { id: 39, key: 'timesheet', image: '/portfolio/timesheet.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL'] },
  { id: 40, key: 'monitoring', image: '/portfolio/monitoring.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Redis', 'WebSockets'] },
  { id: 41, key: 'recruitment', image: '/portfolio/recruitment.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 42, key: 'subscription', image: '/portfolio/subscription.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Stripe'] },
  { id: 43, key: 'analyticsapp', image: '/portfolio/analyticsapp.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis'] },
  { id: 44, key: 'chat', image: '/portfolio/chat.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'WebSockets', 'Redis'] },
  // Websites
  { id: 45, key: 'agencyweb', image: '/portfolio/agencyweb.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'TailwindCSS'] },
  { id: 46, key: 'constructionweb', image: '/portfolio/constructionweb.svg', category: 'website', technologies: ['Laravel', 'TailwindCSS', 'Alpine.js'] },
  { id: 47, key: 'clinicweb', image: '/portfolio/clinicweb.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'MySQL'] },
  { id: 48, key: 'lawweb', image: '/portfolio/lawweb.svg', category: 'website', technologies: ['Laravel', 'TailwindCSS', 'Vue.js'] },
  { id: 49, key: 'eventweb', image: '/portfolio/eventweb.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 50, key: 'gymweb', image: '/portfolio/gymweb.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 51, key: 'portfolioweb', image: '/portfolio/portfolioweb.svg', category: 'website', technologies: ['Laravel', 'Vue.js', 'TailwindCSS'] },
  // Platforms / SaaS
  { id: 52, key: 'marketplace', image: '/portfolio/marketplace.svg', category: 'ecommerce', technologies: ['Laravel', 'Vue.js', 'Stripe Connect', 'MySQL'] },
  { id: 53, key: 'posystem', image: '/portfolio/posystem.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'WebSockets'] },
  { id: 54, key: 'telemedicine', image: '/portfolio/telemedicine.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'WebRTC', 'MySQL'] },
  { id: 55, key: 'gymmanagement', image: '/portfolio/gymmanagement.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'Android', 'MySQL'] },
  { id: 56, key: 'property', image: '/portfolio/property.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Twilio SMS'] },
  { id: 57, key: 'schoollms', image: '/portfolio/schoollms.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'WebSockets'] },
  { id: 58, key: 'insurance', image: '/portfolio/insurance.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'MySQL', 'Redis'] },
  { id: 59, key: 'freelancer', image: '/portfolio/freelancer.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Stripe', 'MySQL'] },
  { id: 60, key: 'eventmgmt', image: '/portfolio/eventmgmt.svg', category: 'webapp', technologies: ['Laravel', 'Vue.js', 'Android', 'Stripe', 'MySQL'] },
  { id: 61, key: 'transport', image: '/portfolio/transport.svg', category: 'crm', technologies: ['Laravel', 'Vue.js', 'Google Maps', 'MySQL', 'Redis'] },
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
  transition: all 0.2s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
</style>
