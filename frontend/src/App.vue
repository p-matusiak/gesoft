<template>
  <div class="min-h-screen flex flex-col">
    <NavBar v-if="!isAdminRoute" />
    <main id="main-content" class="flex-grow" role="main">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>
    <Footer v-if="!isAdminRoute" />
    <FloatingCta v-if="!isAdminRoute && !isContactRoute" />
    <ExitIntentPopup v-if="!isAdminRoute" />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import NavBar from '@/components/layout/NavBar.vue'
import Footer from '@/components/layout/Footer.vue'
import FloatingCta from '@/components/common/FloatingCta.vue'
import ExitIntentPopup from '@/components/common/ExitIntentPopup.vue'
import { useSeo } from '@/composables/useSeo'

const route = useRoute()

// Initialize SEO - automatically updates on route/locale change
useSeo()

const isAdminRoute = computed(() => {
  return route.path.startsWith('/admin')
})

const isContactRoute = computed(() => {
  return route.path.includes('kontakt')
})
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
