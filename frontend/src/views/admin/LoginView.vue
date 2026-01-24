<template>
  <div class="min-h-screen bg-dark-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="text-center mb-8">
        <router-link to="/" class="inline-flex items-center space-x-2">
          <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-2xl">G</span>
          </div>
          <span class="text-2xl font-bold gradient-text">GESOFT</span>
        </router-link>
        <h1 class="text-2xl font-bold text-white mt-6">Panel Administracyjny</h1>
        <p class="text-dark-400 mt-2">Zaloguj się, aby zarządzać zapytaniami</p>
      </div>

      <!-- Login Form -->
      <div class="glass-card p-8">
        <form @submit.prevent="handleLogin" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-dark-300 mb-2">
              Adres email
            </label>
            <input
              type="email"
              id="email"
              v-model="form.email"
              required
              class="input-field"
              placeholder="admin@gesoft.pl"
              :class="{ 'border-red-500': error }"
            />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-dark-300 mb-2">
              Hasło
            </label>
            <input
              type="password"
              id="password"
              v-model="form.password"
              required
              class="input-field"
              placeholder="********"
              :class="{ 'border-red-500': error }"
            />
          </div>

          <transition name="fade">
            <div v-if="error" class="p-4 bg-red-500/20 border border-red-500/50 rounded-lg">
              <p class="text-red-400 text-sm">{{ error }}</p>
            </div>
          </transition>

          <button
            type="submit"
            :disabled="isSubmitting"
            class="btn-primary w-full"
            :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }"
          >
            <span v-if="isSubmitting" class="flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Logowanie...
            </span>
            <span v-else>Zaloguj się</span>
          </button>
        </form>

        <div class="mt-6 text-center">
          <router-link to="/" class="text-dark-400 hover:text-white text-sm transition-colors">
            ← Powrót do strony głównej
          </router-link>
        </div>
      </div>

      <!-- Demo credentials -->
      <div class="mt-6 glass-card p-4 text-center">
        <p class="text-dark-400 text-sm">
          <strong class="text-dark-300">Demo:</strong> admin@gesoft.pl / password
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()

const form = reactive({
  email: '',
  password: ''
})

const isSubmitting = ref(false)
const error = ref('')

onMounted(() => {
  if (authStore.isAuthenticated) {
    router.push('/admin/dashboard')
  }
})

const handleLogin = async () => {
  error.value = ''
  isSubmitting.value = true

  try {
    const result = await authStore.login(form.email, form.password)
    if (result.success) {
      router.push('/admin/dashboard')
    } else {
      error.value = result.message
    }
  } catch (err) {
    error.value = 'Wystąpił błąd. Spróbuj ponownie.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
