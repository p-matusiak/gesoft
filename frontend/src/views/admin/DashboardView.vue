<template>
  <div class="min-h-screen bg-dark-900">
    <!-- Admin Navbar -->
    <nav class="bg-dark-800 border-b border-dark-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center space-x-8">
            <router-link to="/" class="flex items-center space-x-2">
              <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold">G</span>
              </div>
              <span class="text-lg font-bold gradient-text">GESOFT Admin</span>
            </router-link>
            <div class="hidden md:flex space-x-4">
              <router-link
                to="/admin/dashboard"
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                :class="$route.name === 'admin-dashboard' ? 'bg-dark-700 text-white' : 'text-dark-400 hover:text-white'"
              >
                Dashboard
              </router-link>
              <router-link
                to="/admin/requests"
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                :class="$route.name === 'admin-requests' ? 'bg-dark-700 text-white' : 'text-dark-400 hover:text-white'"
              >
                Zapytania
              </router-link>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-dark-400 text-sm hidden sm:block">{{ authStore.user?.email }}</span>
            <button
              @click="handleLogout"
              class="px-4 py-2 bg-dark-700 text-dark-300 rounded-lg hover:bg-dark-600 hover:text-white transition-colors text-sm"
            >
              Wyloguj
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        <p class="text-dark-400 mt-1">Przegląd zapytań ofertowych</p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="glass-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-dark-400 text-sm">Wszystkie zapytania</p>
              <p class="text-3xl font-bold text-white mt-1">{{ stats.total }}</p>
            </div>
            <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="glass-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-dark-400 text-sm">Nowe</p>
              <p class="text-3xl font-bold text-white mt-1">{{ stats.new }}</p>
            </div>
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="glass-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-dark-400 text-sm">Przeczytane</p>
              <p class="text-3xl font-bold text-white mt-1">{{ stats.read }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="glass-card p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-dark-400 text-sm">Obsłużone</p>
              <p class="text-3xl font-bold text-white mt-1">{{ stats.responded }}</p>
            </div>
            <div class="w-12 h-12 bg-secondary-500/20 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Requests -->
      <div class="glass-card overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-700 flex items-center justify-between">
          <h2 class="text-lg font-semibold text-white">Ostatnie zapytania</h2>
          <router-link to="/admin/requests" class="text-primary-400 hover:text-primary-300 text-sm">
            Zobacz wszystkie →
          </router-link>
        </div>
        <div v-if="isLoading" class="p-8 text-center">
          <svg class="animate-spin h-8 w-8 text-primary-400 mx-auto" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
        </div>
        <div v-else-if="recentRequests.length === 0" class="p-8 text-center text-dark-400">
          Brak zapytań ofertowych
        </div>
        <div v-else class="divide-y divide-dark-700">
          <div
            v-for="request in recentRequests"
            :key="request.id"
            class="px-6 py-4 hover:bg-dark-800/50 transition-colors cursor-pointer"
            @click="$router.push('/admin/requests')"
          >
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold">
                  {{ request.email.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <p class="text-white font-medium">{{ request.email }}</p>
                  <p class="text-dark-400 text-sm truncate max-w-md">{{ request.message }}</p>
                </div>
              </div>
              <div class="flex items-center space-x-4">
                <span
                  class="px-2 py-1 rounded-full text-xs font-medium"
                  :class="getStatusClass(request.status)"
                >
                  {{ getStatusLabel(request.status) }}
                </span>
                <span class="text-dark-500 text-sm">{{ formatDate(request.created_at) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'

const router = useRouter()
const authStore = useAuthStore()

const isLoading = ref(true)
const stats = reactive({
  total: 0,
  new: 0,
  read: 0,
  responded: 0
})
const recentRequests = ref([])

onMounted(async () => {
  await authStore.fetchUser()
  await fetchStats()
})

const fetchStats = async () => {
  try {
    const response = await axios.get('/api/admin/stats')
    const data = response.data.data
    stats.total = data.total
    stats.new = data.new
    stats.read = data.read
    stats.responded = data.responded
    recentRequests.value = data.recent || []
  } catch (error) {
    console.error('Failed to fetch stats:', error)
  } finally {
    isLoading.value = false
  }
}

const handleLogout = async () => {
  await authStore.logout()
  router.push('/admin')
}

const getStatusClass = (status) => {
  const classes = {
    new: 'bg-green-500/20 text-green-400',
    read: 'bg-yellow-500/20 text-yellow-400',
    responded: 'bg-secondary-500/20 text-secondary-400'
  }
  return classes[status] || classes.new
}

const getStatusLabel = (status) => {
  const labels = {
    new: 'Nowe',
    read: 'Przeczytane',
    responded: 'Obsłużone'
  }
  return labels[status] || status
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('pl-PL', {
    day: 'numeric',
    month: 'short',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>
