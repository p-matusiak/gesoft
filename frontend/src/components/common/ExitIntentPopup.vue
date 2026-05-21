<template>
  <Teleport to="body">
    <Transition name="modal">
      <div
        v-if="isVisible"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm"
        @click="close"
      >
        <div
          class="bg-white border border-gray-200 rounded-lg shadow-xl max-w-lg w-full p-8 relative"
          @click.stop
        >
          <!-- Close button -->
          <button
            @click="close"
            class="absolute top-4 right-4 w-8 h-8 text-gray-500 hover:text-gray-900 transition-colors flex items-center justify-center"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>

          <div class="text-center">
            <!-- Icon -->
            <div class="w-16 h-16 mx-auto bg-brand-50 rounded-full flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-3">Zanim wyjdziesz...</h2>
            <p class="text-gray-700 mb-6">
              Odbierz <span class="text-brand-600 font-semibold">bezplatna wycene</span> swojego projektu!
              Odpowiemy w ciagu 24 godzin z szczegolowa propozycja.
            </p>

            <!-- Benefits -->
            <div class="flex flex-wrap justify-center gap-4 mb-6">
              <div class="flex items-center gap-2 text-sm text-gray-700">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Bez zobowiazan</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-700">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Odpowiedz 24h</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-700">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>100% darmowo</span>
              </div>
            </div>

            <!-- CTA Buttons -->
            <div class="space-y-3">
              <router-link
                to="/kontakt"
                @click="close"
                class="btn-primary w-full py-3 text-base"
              >
                Tak, chce bezplatna wycene
                <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
              </router-link>
              <button
                @click="close"
                class="w-full py-3 text-gray-500 hover:text-gray-900 transition-colors text-sm"
              >
                Nie teraz, dziekuje
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const isVisible = ref(false)
const hasShown = ref(false)

const STORAGE_KEY = 'gesoft_exit_popup_shown'

const close = () => {
  isVisible.value = false
  localStorage.setItem(STORAGE_KEY, Date.now().toString())
}

const handleMouseLeave = (e) => {
  // Only trigger if mouse leaves from top of viewport
  if (e.clientY <= 0 && !hasShown.value) {
    // Don't show on admin or contact pages
    if (route.path.includes('admin') || route.path.includes('kontakt')) {
      return
    }

    // Check if popup was shown recently (within 24 hours)
    const lastShown = localStorage.getItem(STORAGE_KEY)
    if (lastShown) {
      const hoursSinceShown = (Date.now() - parseInt(lastShown)) / (1000 * 60 * 60)
      if (hoursSinceShown < 24) {
        return
      }
    }

    isVisible.value = true
    hasShown.value = true
  }
}

onMounted(() => {
  // Add delay before enabling exit intent
  setTimeout(() => {
    document.addEventListener('mouseleave', handleMouseLeave)
  }, 5000) // Wait 5 seconds before enabling
})

onUnmounted(() => {
  document.removeEventListener('mouseleave', handleMouseLeave)
})
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

.modal-enter-from .glass-card,
.modal-leave-to .glass-card {
  transform: scale(0.9) translateY(-20px);
}
</style>
