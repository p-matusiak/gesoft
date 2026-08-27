<template>
  <nav
    class="fixed top-0 left-0 right-0 z-50 transition-transform duration-200 ease-out"
    role="navigation"
    aria-label="Nawigacja główna"
    :class="[
      isHidden ? '-translate-y-full lg:translate-y-0' : 'translate-y-0',
      isScrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-200' : 'bg-white border-b border-gray-100'
    ]"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between py-1.5 sm:py-2">
        <router-link to="/" class="flex items-center">
          <img
            src="/logo.png"
            alt="GESOFT - Strony i aplikacje webowe"
            class="h-10 sm:h-11 lg:h-12 w-auto"
            width="240"
            height="48"
          />
        </router-link>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
          <router-link
            v-for="link in navLinks"
            :key="link.path"
            :to="link.path"
            class="text-gray-700 hover:text-brand-600 transition-colors duration-200 font-medium"
            :class="{ 'text-brand-600': isActive(link.path) }"
          >
            {{ $t(link.i18nKey) }}
          </router-link>

          <!-- Language Switcher -->
          <div class="relative">
            <button
              @click="isLangMenuOpen = !isLangMenuOpen"
              class="flex items-center space-x-1 text-gray-700 hover:text-brand-600 transition-colors duration-200 font-medium"
            >
              <span>{{ currentLocale === 'pl' ? 'PL' : 'EN' }}</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <transition
              enter-active-class="transition-all duration-150 ease-out"
              leave-active-class="transition-all duration-100 ease-in"
              enter-from-class="opacity-0 scale-95"
              leave-to-class="opacity-0 scale-95"
            >
              <div
                v-if="isLangMenuOpen"
                class="absolute right-0 mt-2 w-28 bg-white border border-gray-200 rounded-md shadow-md overflow-hidden"
              >
                <button
                  @click="changeLocale('pl')"
                  class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 hover:text-brand-600 transition-colors"
                  :class="{ 'text-brand-600 bg-gray-50': currentLocale === 'pl' }"
                >
                  Polski
                </button>
                <button
                  @click="changeLocale('en')"
                  class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 hover:text-brand-600 transition-colors"
                  :class="{ 'text-brand-600 bg-gray-50': currentLocale === 'en' }"
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
          class="lg:hidden p-1.5 -mr-1.5 text-gray-700 hover:text-brand-600"
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
      enter-active-class="transition-all duration-200 ease-out"
      leave-active-class="transition-all duration-150 ease-in"
      enter-from-class="opacity-0 -translate-y-2"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div v-if="isMobileMenuOpen" id="mobile-menu" class="lg:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-4 space-y-2">
          <router-link
            v-for="link in navLinks"
            :key="link.path"
            :to="link.path"
            class="block px-4 py-2 text-gray-700 hover:text-brand-600 hover:bg-gray-50 rounded-md transition-colors"
            :class="{ 'text-brand-600 bg-gray-50': isActive(link.path) }"
            @click="isMobileMenuOpen = false"
          >
            {{ $t(link.i18nKey) }}
          </router-link>

          <!-- Mobile Language Switcher -->
          <div class="flex px-4 py-2 space-x-2">
            <button
              @click="changeLocale('pl'); isMobileMenuOpen = false"
              class="px-3 py-1 rounded text-sm transition-colors"
              :class="currentLocale === 'pl' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-700 hover:text-brand-600'"
            >
              PL
            </button>
            <button
              @click="changeLocale('en'); isMobileMenuOpen = false"
              class="px-3 py-1 rounded text-sm transition-colors"
              :class="currentLocale === 'en' ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-700 hover:text-brand-600'"
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
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRoute, useRouter } from 'vue-router'

const { locale } = useI18n()
const route = useRoute()
const router = useRouter()

const isScrolled = ref(false)
const isHidden = ref(false)
const isMobileMenuOpen = ref(false)
const isLangMenuOpen = ref(false)
let lastScrollY = 0

const currentLocale = computed(() => locale.value)

const navLinks = [
  { i18nKey: 'nav.home', path: '/' },
  { i18nKey: 'nav.about', path: '/o-nas' },
  { i18nKey: 'nav.services', path: '/uslugi' },
  { i18nKey: 'nav.technologies', path: '/technologie' },
  { i18nKey: 'nav.portfolio', path: '/portfolio' },
  { i18nKey: 'nav.articles', path: '/artykuly' },
]

const isActive = (path) => {
  if (path === '/') {
    return route.path === '/'
  }
  return route.path === path || route.path.startsWith(`${path}/`)
}

const changeLocale = (newLocale) => {
  locale.value = newLocale
  localStorage.setItem('locale', newLocale)
  isLangMenuOpen.value = false
  const query = { ...route.query }
  if (newLocale === 'en') {
    query.lang = 'en'
  } else {
    delete query.lang
  }
  router.replace({ path: route.path, query })
}

const handleScroll = () => {
  const y = window.scrollY
  isScrolled.value = y > 8

  if (isMobileMenuOpen.value || y < 16) {
    isHidden.value = false
    lastScrollY = y
    return
  }

  const delta = y - lastScrollY
  if (delta > 6) {
    isHidden.value = true
  } else if (delta < -6) {
    isHidden.value = false
  }
  lastScrollY = y
}

const handleClickOutside = (event) => {
  if (isLangMenuOpen.value && !event.target.closest('.relative')) {
    isLangMenuOpen.value = false
  }
}

watch(
  () => route.fullPath,
  () => {
    isHidden.value = false
    isMobileMenuOpen.value = false
  }
)

onMounted(() => {
  lastScrollY = window.scrollY
  window.addEventListener('scroll', handleScroll, { passive: true })
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  document.removeEventListener('click', handleClickOutside)
})
</script>
