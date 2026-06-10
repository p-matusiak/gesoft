<template>
  <section class="relative bg-white pt-32 pb-16 sm:pt-36 sm:pb-20 border-b border-gray-200">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <!-- Logo -->
      <div class="mb-8 flex items-center justify-center">
        <img
          src="/logo.svg"
          alt="GESOFT"
          class="h-8 sm:h-10 md:h-12 w-auto"
          width="200"
          height="48"
        />
      </div>

      <!-- Tech Badge -->
      <div class="mb-6 flex items-center justify-center">
        <span class="inline-block px-3 py-1.5 bg-gray-100 rounded-full text-xs sm:text-sm font-medium text-gray-700 border border-gray-200">
          {{ $t('hero.badge') }}
        </span>
      </div>

      <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-5 leading-tight">
        {{ $t('hero.title1') }}
        <span class="text-brand-600"> {{ $t('hero.title2') }} </span>
        <br class="hidden sm:block" />
        {{ $t('hero.title3') }}
      </h1>

      <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-6 px-2">
        {{ $t('hero.subtitle') }}
      </p>

      <!-- Trust Badges -->
      <div class="flex flex-wrap items-center justify-center gap-4 mb-8 sm:mb-10">
        <div class="flex items-center gap-2 text-gray-600 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Bezpłatna wycena 24h</span>
        </div>
        <div class="flex items-center gap-2 text-gray-600 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>6 miesięcy gwarancji</span>
        </div>
        <div class="flex items-center gap-2 text-gray-600 text-xs sm:text-sm">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span>Faktura VAT</span>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
        <router-link to="/kontakt" class="btn-primary w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 text-base">
          <span class="flex items-center justify-center">
            {{ $t('hero.cta') }}
            <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </span>
        </router-link>
        <router-link to="/portfolio" class="btn-secondary w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 text-base">
          {{ $t('hero.ctaSecondary') }}
        </router-link>
      </div>

      <!-- Tech Stack Cards -->
      <div class="mt-12 sm:mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <!-- Laravel -->
        <div class="text-center p-4 bg-white border border-gray-200 rounded-lg hover:border-red-200 hover:shadow-sm transition-all duration-200">
          <div class="w-10 h-10 mx-auto mb-3 flex items-center justify-center">
            <svg class="w-8 h-8 text-red-600" viewBox="0 0 50 52" fill="currentColor">
              <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z"/>
            </svg>
          </div>
          <div class="text-gray-900 font-semibold text-sm">Laravel</div>
          <div class="text-gray-500 text-xs mt-0.5">{{ $t('hero.stack.laravel') }}</div>
        </div>
        <!-- Vue.js -->
        <div class="text-center p-4 bg-white border border-gray-200 rounded-lg hover:border-green-200 hover:shadow-sm transition-all duration-200">
          <div class="w-10 h-10 mx-auto mb-3 flex items-center justify-center">
            <svg class="w-8 h-8" viewBox="0 0 256 221" fill="none">
              <path d="M204.8 0H256L128 220.8 0 0h97.92L128 51.2 157.44 0h47.36z" fill="#41B883"/>
              <path d="M0 0l128 220.8L256 0h-51.2L128 132.48 50.56 0H0z" fill="#41B883"/>
              <path d="M50.56 0L128 133.12 204.8 0h-47.36L128 51.2 97.92 0H50.56z" fill="#35495E"/>
            </svg>
          </div>
          <div class="text-gray-900 font-semibold text-sm">Vue.js 3</div>
          <div class="text-gray-500 text-xs mt-0.5">{{ $t('hero.stack.vue') }}</div>
        </div>
        <!-- PHP -->
        <div class="text-center p-4 bg-white border border-gray-200 rounded-lg hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
          <div class="w-10 h-10 mx-auto mb-3 flex items-center justify-center">
            <svg class="w-10 h-10" viewBox="0 0 128 134" fill="none">
              <ellipse cx="64" cy="66.6" rx="64" ry="66.6" fill="#8892BF"/>
              <path d="M17.9 106.5l8.5-43.8h17.7c8.4 0 14.2 1.5 17.5 4.5 3.3 3 4.3 7.5 3.1 13.6-0.6 3.2-1.8 6.1-3.5 8.8-1.7 2.7-3.9 5-6.5 6.8-2.9 2.1-6 3.5-9.3 4.3-3.3 0.8-7.4 1.2-12.3 1.2h-7.2l-3 15.5H17.9zm13.5-25.5l-2.5 12.9h6.1c4.9 0 8.4-0.7 10.6-2.2 2.2-1.5 3.6-4.1 4.4-7.8 0.7-3.4 0.2-5.7-1.4-6.9-1.6-1.2-4.7-1.8-9.4-1.8h-4.7l-3.1 5.8zM46.7 106.5l8.5-43.8h12.1l-2.6 13.3h7.2c5.5 0 9.4 1 11.8 2.9 2.4 1.9 3.2 5 2.5 9.2l-3.5 18.4H70.3l3.3-17.2c0.4-1.9 0.2-3.2-0.6-4-0.8-0.7-2.4-1.1-4.7-1.1h-6.1l-4.3 22.3H46.7zM95.2 106.5l8.5-43.8h17.7c8.4 0 14.2 1.5 17.5 4.5 3.3 3 4.3 7.5 3.1 13.6-0.6 3.2-1.8 6.1-3.5 8.8-1.7 2.7-3.9 5-6.5 6.8-2.9 2.1-6 3.5-9.3 4.3-3.3 0.8-7.4 1.2-12.3 1.2h-7.2l-3 15.5h-5zm13.5-25.5l-2.5 12.9h6.1c4.9 0 8.4-0.7 10.6-2.2 2.2-1.5 3.6-4.1 4.4-7.8 0.7-3.4 0.2-5.7-1.4-6.9-1.6-1.2-4.7-1.8-9.4-1.8h-4.7l-3.1 5.8z" fill="#FFFFFF"/>
            </svg>
          </div>
          <div class="text-gray-900 font-semibold text-sm">PHP 8.3</div>
          <div class="text-gray-500 text-xs mt-0.5">{{ $t('hero.stack.php') }}</div>
        </div>
        <!-- Android -->
        <div class="text-center p-4 bg-white border border-gray-200 rounded-lg hover:border-green-200 hover:shadow-sm transition-all duration-200">
          <div class="w-10 h-10 mx-auto mb-3 flex items-center justify-center">
            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none">
              <path d="M17.523 15.341A4.5 4.5 0 0 1 12 19.5a4.5 4.5 0 0 1-5.523-4.159M12 3.75c-4.97 0-9 3.582-9 8 0 1.89.687 3.627 1.837 5.009L3 21l4.5-1.5A9.2 9.2 0 0 0 12 20.25c4.97 0 9-3.582 9-8s-4.03-8.5-9-8.5z" stroke="#3DDC84" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="9" cy="11.75" r="0.75" fill="#3DDC84"/>
              <circle cx="12" cy="11.75" r="0.75" fill="#3DDC84"/>
              <circle cx="15" cy="11.75" r="0.75" fill="#3DDC84"/>
              <path d="M8.5 7.5L7 5M15.5 7.5L17 5" stroke="#3DDC84" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </div>
          <div class="text-gray-900 font-semibold text-sm">Android</div>
          <div class="text-gray-500 text-xs mt-0.5">{{ $t('hero.stack.android') }}</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
