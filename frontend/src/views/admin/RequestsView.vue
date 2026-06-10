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
                :class="$route.name === 'admin-dashboard' ? 'bg-dark-700 text-gray-900' : 'text-dark-400 hover:text-gray-900'"
              >
                Dashboard
              </router-link>
              <router-link
                to="/admin/requests"
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                :class="$route.name === 'admin-requests' ? 'bg-dark-700 text-gray-900' : 'text-dark-400 hover:text-gray-900'"
              >
                Zapytania
              </router-link>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-dark-400 text-sm hidden sm:block">{{ authStore.user?.email }}</span>
            <button
              @click="handleLogout"
              class="px-4 py-2 bg-dark-700 text-dark-300 rounded-lg hover:bg-dark-600 hover:text-gray-900 transition-colors text-sm"
            >
              Wyloguj
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Zapytania ofertowe</h1>
          <p class="text-dark-400 mt-1">Zarządzaj zapytaniami od klientów</p>
        </div>
        <div class="flex gap-2">
          <button
            v-for="filter in filters"
            :key="filter.value"
            @click="currentFilter = filter.value"
            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
            :class="currentFilter === filter.value ? 'bg-primary-500 text-white' : 'bg-dark-800 text-dark-400 hover:text-gray-900'"
          >
            {{ filter.label }}
          </button>
        </div>
      </div>

      <!-- Requests List -->
      <div class="glass-card overflow-hidden">
        <div v-if="isLoading" class="p-8 text-center">
          <svg class="animate-spin h-8 w-8 text-primary-400 mx-auto" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
        </div>
        <div v-else-if="requests.length === 0" class="p-8 text-center text-dark-400">
          Brak zapytań ofertowych
        </div>
        <div v-else class="divide-y divide-dark-700">
          <div
            v-for="request in requests"
            :key="request.id"
            class="px-6 py-4 hover:bg-dark-800/50 transition-colors cursor-pointer"
            @click="openDetail(request)"
          >
            <div class="flex items-start justify-between gap-4">
              <div class="flex items-start space-x-4 flex-1 min-w-0">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                  {{ request.email.charAt(0).toUpperCase() }}
                </div>
                <div class="flex-1 min-w-0">
                  <div class="flex items-center gap-2 flex-wrap">
                    <p class="text-gray-900 font-medium">{{ request.email }}</p>
                    <span
                      class="px-2 py-0.5 rounded-full text-xs font-medium"
                      :class="getStatusClass(request.status)"
                    >
                      {{ getStatusLabel(request.status) }}
                    </span>
                  </div>
                  <p v-if="request.phone" class="text-dark-400 text-sm mt-1">{{ request.phone }}</p>
                  <p class="text-dark-300 text-sm mt-2 line-clamp-2">{{ request.message }}</p>
                </div>
              </div>
              <div class="text-right flex-shrink-0">
                <span class="text-dark-500 text-sm">{{ formatDate(request.created_at) }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="pagination.lastPage > 1" class="px-6 py-4 border-t border-dark-700 flex items-center justify-between">
          <p class="text-dark-400 text-sm">
            Strona {{ pagination.currentPage }} z {{ pagination.lastPage }}
          </p>
          <div class="flex gap-2">
            <button
              @click="goToPage(pagination.currentPage - 1)"
              :disabled="pagination.currentPage === 1"
              class="px-3 py-1 bg-dark-700 text-dark-300 rounded hover:bg-dark-600 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Poprzednia
            </button>
            <button
              @click="goToPage(pagination.currentPage + 1)"
              :disabled="pagination.currentPage === pagination.lastPage"
              class="px-3 py-1 bg-dark-700 text-dark-300 rounded hover:bg-dark-600 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Następna
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Detail Modal -->
    <transition name="modal">
      <div v-if="selectedRequest" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" @click="closeDetail">
        <div class="glass-card max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
          <div class="px-6 py-4 border-b border-dark-700 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Szczegóły zapytania</h2>
            <button @click="closeDetail" class="text-dark-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="p-6">
            <div class="space-y-4">
              <div>
                <label class="text-dark-400 text-sm">Email</label>
                <p class="text-gray-900">{{ selectedRequest.email }}</p>
              </div>
              <div v-if="selectedRequest.phone">
                <label class="text-dark-400 text-sm">Telefon</label>
                <p class="text-gray-900">{{ selectedRequest.phone }}</p>
              </div>
              <div>
                <label class="text-dark-400 text-sm">Wiadomość</label>
                <p class="text-gray-900 whitespace-pre-wrap">{{ selectedRequest.message }}</p>
              </div>
              <div>
                <label class="text-dark-400 text-sm">Data</label>
                <p class="text-gray-900">{{ formatDateFull(selectedRequest.created_at) }}</p>
              </div>
              <div>
                <label class="text-dark-400 text-sm mb-2 block">Status</label>
                <div class="flex gap-2">
                  <button
                    v-for="status in statuses"
                    :key="status.value"
                    @click="updateStatus(selectedRequest.id, status.value)"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                    :class="selectedRequest.status === status.value ? status.activeClass : 'bg-dark-700 text-dark-400 hover:text-gray-900'"
                  >
                    {{ status.label }}
                  </button>
                </div>
              </div>

              <!-- Poprzednia odpowiedź -->
              <div v-if="selectedRequest.admin_reply" class="border border-dark-600 rounded-lg p-4 bg-dark-800/50">
                <label class="text-dark-400 text-sm block mb-1">Wysłana odpowiedź <span class="text-dark-500">({{ formatDateFull(selectedRequest.replied_at) }})</span></label>
                <p class="text-dark-300 whitespace-pre-wrap text-sm">{{ selectedRequest.admin_reply }}</p>
              </div>

              <!-- Formularz odpowiedzi -->
              <div class="border-t border-dark-700 pt-4">
                <label class="text-dark-400 text-sm mb-2 block">
                  {{ selectedRequest.admin_reply ? 'Wyślij ponowną odpowiedź' : 'Odpowiedz klientowi' }}
                </label>
                <textarea
                  v-model="replyText"
                  rows="5"
                  class="w-full bg-dark-800 border border-dark-600 text-gray-900 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-primary-500 resize-none placeholder-gray-400"
                  placeholder="Wpisz odpowiedź dla klienta..."
                ></textarea>
                <div v-if="replyMessage" class="mt-2 text-sm" :class="replySuccess ? 'text-green-400' : 'text-red-400'">
                  {{ replyMessage }}
                </div>
                <div class="mt-3 flex items-center gap-3">
                  <button
                    @click="sendReply(selectedRequest.id)"
                    :disabled="isSendingReply || !replyText.trim()"
                    class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white rounded-lg text-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                  >
                    <svg v-if="isSendingReply" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg v-else class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    {{ isSendingReply ? 'Wysyłanie...' : 'Wyślij odpowiedź' }}
                  </button>
                  <span v-if="selectedRequest.phone" class="text-dark-400 text-xs">
                    📱 SMS zostanie wysłany na {{ selectedRequest.phone }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'

const router = useRouter()
const authStore = useAuthStore()

const isLoading = ref(true)
const requests = ref([])
const selectedRequest = ref(null)
const currentFilter = ref('all')
const replyText = ref('')
const isSendingReply = ref(false)
const replyMessage = ref('')
const replySuccess = ref(false)

const pagination = reactive({
  currentPage: 1,
  lastPage: 1,
  total: 0
})

const filters = [
  { value: 'all', label: 'Wszystkie' },
  { value: 'new', label: 'Nowe' },
  { value: 'read', label: 'Przeczytane' },
  { value: 'responded', label: 'Obsłużone' },
]

const statuses = [
  { value: 'new', label: 'Nowe', activeClass: 'bg-green-500 text-white' },
  { value: 'read', label: 'Przeczytane', activeClass: 'bg-yellow-500 text-white' },
  { value: 'responded', label: 'Obsłużone', activeClass: 'bg-secondary-500 text-white' },
]

onMounted(async () => {
  await authStore.fetchUser()
  await fetchRequests()
})

watch(currentFilter, () => {
  pagination.currentPage = 1
  fetchRequests()
})

const fetchRequests = async () => {
  isLoading.value = true
  try {
    const params = { page: pagination.currentPage }
    if (currentFilter.value !== 'all') {
      params.status = currentFilter.value
    }
    const response = await axios.get('/api/admin/requests', { params })
    requests.value = response.data.data
    pagination.currentPage = response.data.current_page
    pagination.lastPage = response.data.last_page
    pagination.total = response.data.total
  } catch (error) {
    console.error('Failed to fetch requests:', error)
  } finally {
    isLoading.value = false
  }
}

const goToPage = (page) => {
  if (page >= 1 && page <= pagination.lastPage) {
    pagination.currentPage = page
    fetchRequests()
  }
}

const openDetail = (request) => {
  selectedRequest.value = { ...request }
  replyText.value = ''
  replyMessage.value = ''
  replySuccess.value = false
  document.body.style.overflow = 'hidden'
  if (request.status === 'new') {
    updateStatus(request.id, 'read')
  }
}

const closeDetail = () => {
  selectedRequest.value = null
  replyText.value = ''
  replyMessage.value = ''
  document.body.style.overflow = ''
}

const sendReply = async (id) => {
  if (!replyText.value.trim()) return
  isSendingReply.value = true
  replyMessage.value = ''
  try {
    const response = await axios.post(`/api/admin/requests/${id}/reply`, { reply: replyText.value })
    replySuccess.value = true
    replyMessage.value = response.data.message
    selectedRequest.value = response.data.data
    replyText.value = ''
    const index = requests.value.findIndex(r => r.id === id)
    if (index !== -1) requests.value[index] = response.data.data
  } catch (error) {
    replySuccess.value = false
    replyMessage.value = error.response?.data?.message || 'Błąd wysyłania odpowiedzi.'
  } finally {
    isSendingReply.value = false
  }
}

const updateStatus = async (id, status) => {
  try {
    await axios.patch(`/api/admin/requests/${id}`, { status })
    selectedRequest.value.status = status
    const index = requests.value.findIndex(r => r.id === id)
    if (index !== -1) {
      requests.value[index].status = status
    }
  } catch (error) {
    console.error('Failed to update status:', error)
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

const formatDateFull = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('pl-PL', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: all 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
