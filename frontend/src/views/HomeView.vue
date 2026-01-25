<template>
  <div>
    <!-- Hero Section -->
    <HeroSection />

    <!-- Why Us Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.whyUs.title') }} <span class="gradient-text">{{ $t('home.whyUs.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.whyUs.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.fast.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.fast.description') }}</p>
          </div>
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.quality.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.quality.description') }}</p>
          </div>
          <div class="glass-card p-8 text-center hover:border-primary-500/50 transition-all duration-300">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500/20 to-secondary-500/20 rounded-2xl flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">{{ $t('home.whyUs.support.title') }}</h3>
            <p class="text-dark-400">{{ $t('home.whyUs.support.description') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Preview Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.services.title') }} <span class="gradient-text">{{ $t('home.services.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.services.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <ServiceCard
            v-for="service in services"
            :key="service.id"
            :title="service.title"
            :description="service.description"
            :icon="service.icon"
          />
        </div>

        <div class="text-center mt-12">
          <router-link to="/uslugi" class="btn-secondary">
            {{ $t('home.services.viewAll') }}
            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </router-link>
        </div>
      </div>
    </section>

    <!-- Technologies Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.technologies.title') }} <span class="gradient-text">{{ $t('home.technologies.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.technologies.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <svg class="w-12 h-12" viewBox="0 0 50 52" fill="none">
                <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="#FF2D20"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-white">Laravel</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.laravel') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <svg class="w-12 h-12" viewBox="0 0 256 221" fill="none">
                <path d="M204.8 0H256L128 220.8 0 0h97.92L128 51.2 157.44 0h47.36z" fill="#41B883"/>
                <path d="M0 0l128 220.8L256 0h-51.2L128 132.48 50.56 0H0z" fill="#41B883"/>
                <path d="M50.56 0L128 133.12 204.8 0h-47.36L128 51.2 97.92 0H50.56z" fill="#35495E"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-white">Vue.js</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.vue') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <svg class="w-14 h-14" viewBox="0 0 256 134" fill="none">
                <ellipse cx="128" cy="66.6" rx="128" ry="66.6" fill="#8892BF"/>
                <path d="M35.9 106.5l8.5-43.8h17.7c8.4 0 14.2 1.5 17.5 4.5 3.3 3 4.3 7.5 3.1 13.6-0.6 3.2-1.8 6.1-3.5 8.8-1.7 2.7-3.9 5-6.5 6.8-2.9 2.1-6 3.5-9.3 4.3-3.3 0.8-7.4 1.2-12.3 1.2h-7.2l-3 15.5H35.9zm13.5-25.5l-2.5 12.9h6.1c4.9 0 8.4-0.7 10.6-2.2 2.2-1.5 3.6-4.1 4.4-7.8 0.7-3.4 0.2-5.7-1.4-6.9-1.6-1.2-4.7-1.8-9.4-1.8h-4.7l-3.1 5.8zM93.3 106.5l8.5-43.8h12.1l-2.6 13.3h7.2c5.5 0 9.4 1 11.8 2.9 2.4 1.9 3.2 5 2.5 9.2l-3.5 18.4h-12.4l3.3-17.2c0.4-1.9 0.2-3.2-0.6-4-0.8-0.7-2.4-1.1-4.7-1.1h-6.1l-4.3 22.3H93.3zM141.8 106.5l8.5-43.8h17.7c8.4 0 14.2 1.5 17.5 4.5 3.3 3 4.3 7.5 3.1 13.6-0.6 3.2-1.8 6.1-3.5 8.8-1.7 2.7-3.9 5-6.5 6.8-2.9 2.1-6 3.5-9.3 4.3-3.3 0.8-7.4 1.2-12.3 1.2h-7.2l-3 15.5h-5zm13.5-25.5l-2.5 12.9h6.1c4.9 0 8.4-0.7 10.6-2.2 2.2-1.5 3.6-4.1 4.4-7.8 0.7-3.4 0.2-5.7-1.4-6.9-1.6-1.2-4.7-1.8-9.4-1.8h-4.7l-3.1 5.8z" fill="#FFFFFF"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-white">PHP</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.php') }}</p>
          </div>
          <div class="glass-card p-6 text-center hover:border-primary-500/50 transition-all duration-300 group">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <svg class="w-12 h-12" viewBox="0 0 128 128" fill="none">
                <path d="M116.948 97.807c-6.863-.187-12.104.452-16.585 2.341-1.273.537-3.305.552-3.513 2.147.7.733.807 1.83 1.355 2.731 1.052 1.72 2.836 4.027 4.439 5.251 1.748 1.336 3.544 2.76 5.451 3.909 3.387 2.044 7.171 3.215 10.403 5.251 1.905 1.201 3.796 2.722 5.648 4.049.916.659 1.531 1.679 2.733 2.147v-.195c-.628-.793-.79-1.884-1.356-2.732l-2.537-2.537c-2.48-3.292-5.629-6.184-8.976-8.585-2.669-1.916-8.642-4.504-9.755-7.609l-.195-.195c1.892-.214 4.107-.898 5.843-1.357 2.934-.771 5.556-.583 8.585-1.355l4.049-1.165v-.778c-1.514-1.555-2.596-3.6-4.244-5.057-4.308-3.808-9.001-7.61-13.856-10.792-2.697-1.769-6.029-2.913-8.976-4.244-.993-.449-2.743-.679-3.461-1.357-1.588-1.542-2.514-3.49-3.853-5.256-2.796-3.688-5.538-7.707-8.001-11.766-1.679-2.768-2.774-5.502-4.832-8.001-9.86-11.988-20.461-19.238-36.837-26.369-3.483-1.517-7.681-2.118-12.156-2.928L23.024 2.61c-2.686-.702-4.867-2.186-7.218-3.267-4.664-2.145-14.313-6.795-17.168-1.16-1.801 3.557 2.698 7.031 4.244 8.781 2.718 3.076 6.2 6.531 8.195 10.208 1.305 2.404 1.528 4.83 2.537 7.413 2.487 6.372 4.657 13.286 7.803 19.122 1.582 2.934 3.321 5.989 5.252 8.584 1.171 1.575 3.187 2.272 3.658 4.634-2.054 2.876-2.175 7.137-3.267 10.599-4.911 15.571-3.056 34.9 3.853 46.398 2.12 3.525 7.108 11.095 13.856 8.195 5.907-2.537 4.588-10.394 6.241-17.362.375-1.579.143-2.744.778-3.853v.195l4.634 9.366c3.436 5.512 9.52 11.277 14.636 15.122 2.653 1.993 4.744 5.436 8.198 6.632v-.195h-.195c-.667-1.035-1.708-1.466-2.537-2.343-1.964-2.073-4.145-4.643-5.647-6.829-4.254-6.189-8.007-12.969-11.376-19.899-1.617-3.325-3.024-6.996-4.244-10.403-.466-1.303-.461-3.264-1.553-3.855-1.441 2.227-3.566 4.022-4.635 6.829-1.706 4.481-1.927 9.96-2.537 15.704-.371.161-.191.054-.39.194-4.163-1.012-5.625-5.307-7.218-8.974-4.015-9.244-4.76-24.14-1.165-34.782.93-2.753 5.128-11.42 3.461-14.049-0.818-2.673-3.522-4.221-4.83-6.437-1.619-2.737-3.238-6.337-4.244-9.366-2.614-7.873-3.858-16.675-6.828-24.514-1.418-3.738-3.823-7.516-5.843-10.985-2.239-3.845-4.736-6.679-6.436-11.181-.601-1.594-1.415-4.139-.389-5.843 0.325-1.081 0.779-1.531 1.942-1.941 1.982-1.181 7.509.645 9.562 1.552 5.447 2.402 9.999 4.633 14.441 7.805 2.116 1.511 4.269 4.429 7.023 5.252h3.072c4.806 1.101 10.193.323 14.636 1.748 7.86 2.523 14.907 6.243 21.294 10.598 19.455 13.262 35.484 32.136 46.398 54.623 1.763 3.631 2.52 7.089 4.049 10.794 3.059 7.421 6.917 15.054 9.952 22.269 3.029 7.199 5.978 14.454 10.403 20.318 2.325 3.082 11.306 4.73 15.317 6.437 2.818 1.199 7.387 2.441 9.951 3.853 4.874 2.684 9.589 5.842 14.049 8.976 2.226 1.567 9.089 4.986 9.366 7.999z" fill="#00618A"/>
                <path d="M58.186 43.022c-2.197-.033-3.724.179-5.449.585v.39h.194c1.057 2.172 2.925 3.6 4.244 5.452l3.072 6.435.194-.194c1.902-1.343 2.771-3.487 2.732-6.633-.755-.791-.866-1.778-1.552-2.732-.912-1.267-2.678-1.988-3.435-3.303z" fill="#00618A"/>
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-white">MySQL</h3>
            <p class="text-sm text-dark-400 mt-1">{{ $t('home.technologies.mysql') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Results Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('results.title') }} <span class="gradient-text">{{ $t('results.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('results.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div v-for="(caseItem, index) in resultsCases" :key="index"
               class="glass-card p-6 text-center group hover:border-primary-500/50 transition-all duration-300 hover:-translate-y-1">
            <div class="text-4xl md:text-5xl font-bold gradient-text mb-2 group-hover:scale-110 transition-transform">
              {{ caseItem.metric }}
            </div>
            <p class="text-dark-300 text-sm mb-3">{{ caseItem.description }}</p>
            <p class="text-dark-500 text-xs">{{ caseItem.client }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Packages Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('packages.title') }} <span class="gradient-text">{{ $t('packages.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('packages.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Starter Package -->
          <div class="glass-card p-8 hover:border-dark-500/50 transition-all duration-300">
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.starter.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.starter.description') }}</p>
            <div class="mb-6">
              <span class="text-4xl font-bold text-white">{{ $t('packages.starter.price') }}</span>
              <span class="text-dark-400 ml-1">{{ $t('packages.starter.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.starter.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-green-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.starter.cta') }}</router-link>
          </div>

          <!-- Business Package - Popular -->
          <div class="glass-card p-8 border-2 border-primary-500/50 relative hover:border-primary-500 transition-all duration-300 transform scale-105">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
              <span class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white text-sm font-semibold px-4 py-1 rounded-full">
                {{ $t('packages.popular') }}
              </span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.business.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.business.description') }}</p>
            <div class="mb-6">
              <span class="text-4xl font-bold gradient-text">{{ $t('packages.business.price') }}</span>
              <span class="text-dark-400 ml-1">{{ $t('packages.business.currency') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.business.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-primary-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-primary w-full">{{ $t('packages.business.cta') }}</router-link>
          </div>

          <!-- Enterprise Package -->
          <div class="glass-card p-8 hover:border-secondary-500/50 transition-all duration-300">
            <h3 class="text-2xl font-bold text-white mb-2">{{ $t('packages.enterprise.name') }}</h3>
            <p class="text-dark-400 text-sm mb-6">{{ $t('packages.enterprise.description') }}</p>
            <div class="mb-6">
              <span class="text-2xl font-bold text-white">{{ $t('packages.enterprise.price') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li v-for="(feature, i) in $tm('packages.enterprise.features')" :key="i" class="flex items-start text-dark-300 text-sm">
                <svg class="w-5 h-5 text-secondary-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
            <router-link to="/kontakt" class="btn-secondary w-full">{{ $t('packages.enterprise.cta') }}</router-link>
          </div>
        </div>

        <p class="text-center text-dark-500 text-sm mt-8">{{ $t('packages.note') }}</p>
      </div>
    </section>

    <!-- Guarantees Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('guarantees.title') }} <span class="gradient-text">{{ $t('guarantees.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('guarantees.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="glass-card p-6 hover:border-green-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.satisfaction.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.satisfaction.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-blue-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.deadline.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.deadline.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-purple-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.quality.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.quality.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-red-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.security.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.security.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-yellow-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.support.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.support.description') }}</p>
          </div>

          <div class="glass-card p-6 hover:border-cyan-500/30 transition-all duration-300 group">
            <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">{{ $t('guarantees.items.transparency.title') }}</h3>
            <p class="text-dark-400 text-sm">{{ $t('guarantees.items.transparency.description') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Urgency Banner -->
    <section class="py-16 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 relative overflow-hidden">
      <div class="absolute inset-0 bg-black/20"></div>
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold text-white mb-4 animate-pulse">
          {{ $t('urgency.badge') }}
        </span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $t('urgency.title') }}</h2>
        <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">{{ $t('urgency.subtitle') }}</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-6">
          <router-link to="/kontakt" class="btn-primary bg-white text-dark-900 hover:bg-gray-100 px-8 py-4 text-lg">
            {{ $t('urgency.cta') }}
            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
          </router-link>
          <div class="flex items-center gap-2 text-white">
            <span class="text-white/70">{{ $t('urgency.spots') }}</span>
            <span class="text-3xl font-bold animate-pulse">{{ spotsLeft }}</span>
          </div>
        </div>
        <p class="text-white/60 text-sm">{{ $t('urgency.expires') }}</p>
      </div>
    </section>

    <!-- Comparison Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('comparison.title') }} <span class="gradient-text">{{ $t('comparison.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('comparison.subtitle') }}</p>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-dark-700">
                <th class="text-left py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.feature') }}</th>
                <th class="text-center py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.amateur') }}</th>
                <th class="text-center py-4 px-4 text-dark-400 font-medium">{{ $t('comparison.headers.agency') }}</th>
                <th class="text-center py-4 px-4 text-white font-bold bg-primary-500/10 rounded-t-lg">{{ $t('comparison.headers.gesoft') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(feature, index) in comparisonFeatures" :key="index" class="border-b border-dark-800">
                <td class="py-4 px-4 text-white font-medium">{{ feature.name }}</td>
                <td class="text-center py-4 px-4 text-dark-400">{{ feature.amateur }}</td>
                <td class="text-center py-4 px-4 text-dark-300">{{ feature.agency }}</td>
                <td class="text-center py-4 px-4 text-primary-400 font-medium bg-primary-500/5">{{ feature.gesoft }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Tech Details Section -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('techDetails.title') }} <span class="gradient-text">{{ $t('techDetails.titleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('techDetails.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Performance -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.performance.title') }}</h3>
            </div>
            <div class="space-y-4">
              <div v-for="(metric, i) in performanceMetrics" :key="i" class="flex items-center justify-between p-3 bg-dark-800/50 rounded-lg">
                <div>
                  <p class="text-white font-medium">{{ metric.label }}</p>
                  <p class="text-dark-400 text-xs">{{ metric.description }}</p>
                </div>
                <span class="text-2xl font-bold text-green-400">{{ metric.value }}</span>
              </div>
            </div>
          </div>

          <!-- Security -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.security.title') }}</h3>
            </div>
            <ul class="space-y-3">
              <li v-for="(feature, i) in $tm('techDetails.security.features')" :key="i" class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-red-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ feature }}
              </li>
            </ul>
          </div>

          <!-- Standards -->
          <div class="glass-card p-8">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white">{{ $t('techDetails.standards.title') }}</h3>
            </div>
            <ul class="space-y-3">
              <li v-for="(item, i) in $tm('techDetails.standards.items')" :key="i" class="flex items-center text-dark-300">
                <svg class="w-5 h-5 text-blue-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ item }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('home.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('home.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg bg-white text-dark-900 hover:bg-dark-100">
          {{ $t('home.cta.button') }}
        </router-link>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('home.testimonials.title') }} <span class="gradient-text">{{ $t('home.testimonials.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('home.testimonials.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <article v-for="(testimonial, index) in testimonials" :key="index" class="glass-card p-8" itemscope itemtype="https://schema.org/Review">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold text-lg" aria-hidden="true">
                {{ testimonial.name.charAt(0) }}
              </div>
              <div class="ml-4">
                <h4 class="text-white font-semibold" itemprop="author">{{ testimonial.name }}</h4>
                <p class="text-dark-400 text-sm">{{ testimonial.company }}</p>
              </div>
            </div>
            <blockquote class="text-dark-300 italic" itemprop="reviewBody">"{{ testimonial.text }}"</blockquote>
            <div class="flex mt-4 text-yellow-400" role="img" aria-label="Ocena: 5 na 5 gwiazdek" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
              <meta itemprop="ratingValue" content="5">
              <meta itemprop="bestRating" content="5">
              <svg v-for="i in 5" :key="i" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
            </div>
          </article>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import axios from 'axios'
import HeroSection from '@/components/home/HeroSection.vue'
import ServiceCard from '@/components/common/ServiceCard.vue'

const { t, tm } = useI18n()

const services = ref([])
const spotsLeft = ref(3)

const resultsCases = computed(() => tm('results.cases'))

const comparisonFeatures = computed(() => tm('comparison.features'))

const performanceMetrics = [
  { label: 'Czas ladowania', value: '< 2s', description: 'Optymalizacja dla Core Web Vitals' },
  { label: 'PageSpeed Score', value: '95+', description: 'Zielone wyniki w Google PageSpeed' },
  { label: 'Uptime', value: '99.9%', description: 'Gwarantowana dostepnosc serwisu' }
]

const testimonials = computed(() => {
  return tm('home.testimonials.items')
})

onMounted(async () => {
  try {
    const response = await axios.get('/api/services')
    services.value = response.data.data
  } catch (error) {
    services.value = [
      { id: 1, title: t('home.services.websites.title'), description: t('home.services.websites.description'), icon: 'globe' },
      { id: 2, title: t('home.services.webapps.title'), description: t('home.services.webapps.description'), icon: 'code' },
      { id: 3, title: t('home.services.ecommerce.title'), description: t('home.services.ecommerce.description'), icon: 'shopping-cart' },
    ]
  }
})
</script>
