<template>
  <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" role="navigation" aria-label="Nawigacja główna" :class="[
    isScrolled ? 'bg-dark-900/95 backdrop-blur-lg shadow-lg' : 'bg-transparent'
  ]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo -->
        <router-link to="/" class="flex items-center">
          <img src="/logo.svg" alt="GESOFT - Strony i aplikacje webowe" class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto" width="160" height="64" />
        </router-link>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
          <router-link
            v-for="link in navLinks"
            :key="link.path"
            :to="link.path"
            class="text-dark-300 hover:text-white transition-colors duration-300 font-medium"
            :class="{ 'text-white': $route.path === link.path }"
          >
            {{ $t(link.i18nKey) }}
          </router-link>

          <!-- Language Switcher -->
          <div class="relative">
            <button
              @click="isLangMenuOpen = !isLangMenuOpen"
              class="flex items-center space-x-1 text-dark-300 hover:text-white transition-colors duration-300 font-medium"
            >
              <span>{{ currentLocale === 'pl' ? 'PL' : 'EN' }}</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <transition
              enter-active-class="transition-all duration-200 ease-out"
              leave-active-class="transition-all duration-150 ease-in"
              enter-from-class="opacity-0 scale-95"
              leave-to-class="opacity-0 scale-95"
            >
              <div
                v-if="isLangMenuOpen"
                class="absolute right-0 mt-2 w-24 bg-dark-800 border border-dark-700 rounded-lg shadow-xl overflow-hidden"
              >
                <button
                  @click="changeLocale('pl')"
                  class="w-full px-4 py-2 text-left text-dark-300 hover:text-white hover:bg-dark-700 transition-colors"
                  :class="{ 'text-white bg-dark-700': currentLocale === 'pl' }"
                >
                  Polski
                </button>
                <button
                  @click="changeLocale('en')"
                  class="w-full px-4 py-2 text-left text-dark-300 hover:text-white hover:bg-dark-700 transition-colors"
                  :class="{ 'text-white bg-dark-700': currentLocale === 'en' }"
                >
                  English
                </button>
              </div>
            </transition>
          </div>

          <router-link to="/kontakt" class="btn-primary">
            {{ $t('nav.contact') }}
          </router-link>
        </div>

        <!-- Mobile Menu Button -->
        <button
          @click="isMobileMenuOpen = !isMobileMenuOpen"
          class="md:hidden p-2 text-dark-300 hover:text-white"
          :aria-expanded="isMobileMenuOpen"
          aria-controls="mobile-menu"
          aria-label="Otwórz menu nawigacji"
        >
          <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <transition
      enter-active-class="transition-all duration-300 ease-out"
      leave-active-class="transition-all duration-200 ease-in"
      enter-from-class="opacity-0 -translate-y-4"
      leave-to-class="opacity-0 -translate-y-4"
    >
      <div v-if="isMobileMenuOpen" id="mobile-menu" class="md:hidden bg-dark-900/95 backdrop-blur-lg border-t border-dark-700">
        <div class="px-4 py-4 space-y-3">
          <router-link
            v-for="link in navLinks"
            :key="link.path"
            :to="link.path"
            class="block px-4 py-2 text-dark-300 hover:text-white hover:bg-dark-800 rounded-lg transition-colors"
            :class="{ 'text-white bg-dark-800': $route.path === link.path }"
            @click="isMobileMenuOpen = false"
          >
            {{ $t(link.i18nKey) }}
          </router-link>

          <!-- Mobile Language Switcher -->
          <div class="flex px-4 py-2 space-x-2">
            <button
              @click="changeLocale('pl'); isMobileMenuOpen = false"
              class="px-3 py-1 rounded text-sm transition-colors"
              :class="currentLocale === 'pl' ? 'bg-primary-500 text-white' : 'bg-dark-800 text-dark-300 hover:text-white'"
            >
              PL
            </button>
            <button
              @click="changeLocale('en'); isMobileMenuOpen = false"
              class="px-3 py-1 rounded text-sm transition-colors"
              :class="currentLocale === 'en' ? 'bg-primary-500 text-white' : 'bg-dark-800 text-dark-300 hover:text-white'"
            >
              EN
            </button>
          </div>

          <router-link
            to="/kontakt"
            class="block btn-primary text-center"
            @click="isMobileMenuOpen = false"
          >
            {{ $t('nav.contact') }}
          </router-link>
        </div>
      </div>
    </transition>
  </nav>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()

const isScrolled = ref(false)
const isMobileMenuOpen = ref(false)
const isLangMenuOpen = ref(false)

const currentLocale = computed(() => locale.value)

const navLinks = [
  { i18nKey: 'nav.home', path: '/' },
  { i18nKey: 'nav.about', path: '/o-nas' },
  { i18nKey: 'nav.services', path: '/uslugi' },
  { i18nKey: 'nav.technologies', path: '/technologie' },
  { i18nKey: 'nav.portfolio', path: '/portfolio' },
]

const changeLocale = (newLocale) => {
  locale.value = newLocale
  localStorage.setItem('locale', newLocale)
  isLangMenuOpen.value = false
}

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

const handleClickOutside = (event) => {
  if (isLangMenuOpen.value && !event.target.closest('.relative')) {
    isLangMenuOpen.value = false
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  document.removeEventListener('click', handleClickOutside)
})
</script>
