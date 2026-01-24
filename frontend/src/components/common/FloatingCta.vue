<template>
  <Teleport to="body">
    <!-- Floating CTA Button -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
      <!-- Expanded Panel -->
      <Transition name="slide-up">
        <div v-if="isExpanded" class="glass-card p-4 mb-2 w-72 shadow-2xl border border-primary-500/30">
          <div class="flex items-center justify-between mb-3">
            <h4 class="text-white font-semibold">{{ $t('floatingCta.question') }}</h4>
            <button @click="isExpanded = false" class="text-dark-400 hover:text-white transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <p class="text-dark-400 text-sm mb-4">Odpowiemy w ciagu 1 godziny w godzinach pracy.</p>
          <div class="space-y-2">
            <a href="tel:+48517123374" class="flex items-center gap-3 p-3 bg-dark-700/50 rounded-lg hover:bg-dark-700 transition-colors group">
              <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
              </div>
              <div>
                <p class="text-white text-sm font-medium">Zadzwon teraz</p>
                <p class="text-dark-400 text-xs">+48 517 123 374</p>
              </div>
            </a>
            <router-link to="/kontakt" class="flex items-center gap-3 p-3 bg-dark-700/50 rounded-lg hover:bg-dark-700 transition-colors group" @click="isExpanded = false">
              <div class="w-10 h-10 bg-primary-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
              </div>
              <div>
                <p class="text-white text-sm font-medium">Wyslij wiadomosc</p>
                <p class="text-dark-400 text-xs">Darmowa wycena</p>
              </div>
            </router-link>
          </div>
        </div>
      </Transition>

      <!-- Main Button -->
      <button
        @click="isExpanded = !isExpanded"
        class="group relative w-14 h-14 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full shadow-lg hover:shadow-primary-500/50 transition-all duration-300 hover:scale-110 flex items-center justify-center"
        :class="{ 'rotate-45': isExpanded }"
      >
        <svg v-if="!isExpanded" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <svg v-else class="w-6 h-6 text-white transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <!-- Pulse Animation -->
        <span v-if="!isExpanded" class="absolute inset-0 rounded-full bg-primary-500 animate-ping opacity-25"></span>
      </button>

      <!-- Notification Badge -->
      <Transition name="fade">
        <div v-if="showNotification && !isExpanded"
             class="absolute -top-2 -left-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center animate-bounce">
          1
        </div>
      </Transition>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const isExpanded = ref(false)
const showNotification = ref(false)

let notificationTimeout = null

onMounted(() => {
  // Show notification after 10 seconds if not on contact page
  notificationTimeout = setTimeout(() => {
    if (!route.path.includes('kontakt') && !route.path.includes('admin')) {
      showNotification.value = true
    }
  }, 10000)
})

onUnmounted(() => {
  if (notificationTimeout) {
    clearTimeout(notificationTimeout)
  }
})
</script>

<style scoped>
.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.3s ease;
}

.slide-up-enter-from,
.slide-up-leave-to {
  opacity: 0;
  transform: translateY(20px);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
