<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-20 bg-hero-gradient relative overflow-hidden">
      <div class="absolute inset-0 pattern-bg"></div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
          <span class="gradient-text">{{ $t('technologies.header.title') }}</span>
        </h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto">
          {{ $t('technologies.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Main Technologies -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('technologies.mainStack.title') }} <span class="gradient-text">{{ $t('technologies.mainStack.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('technologies.mainStack.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Laravel -->
          <div class="glass-card p-8 hover:border-red-500/50 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-red-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-red-400" viewBox="0 0 50 52" fill="currentColor">
                  <path d="M49.626 11.564a.809.809 0 01.028.209v10.972a.8.8 0 01-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 01-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 010 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 01.8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 01.028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 01.8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-white mb-3">{{ $t('technologies.laravel.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.laravel.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.laravel.eloquent') }}</strong> - {{ $t('technologies.laravel.eloquentDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.laravel.artisan') }}</strong> - {{ $t('technologies.laravel.artisanDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.laravel.security') }}</strong> - {{ $t('technologies.laravel.securityDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.laravel.queue') }}</strong> - {{ $t('technologies.laravel.queueDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Vue.js -->
          <div class="glass-card p-8 hover:border-green-500/50 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-green-400" viewBox="0 0 256 221" fill="currentColor">
                  <path d="M204.8 0H256L128 220.8 0 0h97.92L128 51.2 157.44 0h47.36z"/>
                  <path d="M0 0l128 220.8L256 0h-51.2L128 132.48 51.2 0H0z" opacity="0.5"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-white mb-3">{{ $t('technologies.vue.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.vue.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.vue.reactivity') }}</strong> - {{ $t('technologies.vue.reactivityDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.vue.sfc') }}</strong> - {{ $t('technologies.vue.sfcDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.vue.pinia') }}</strong> - {{ $t('technologies.vue.piniaDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.vue.size') }}</strong> - {{ $t('technologies.vue.sizeDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- MySQL -->
          <div class="glass-card p-8 hover:border-blue-500/50 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 3C7.58 3 4 4.79 4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7c0-2.21-3.58-4-8-4zm0 2c3.87 0 6 1.5 6 2s-2.13 2-6 2-6-1.5-6-2 2.13-2 6-2zm6 12c0 .5-2.13 2-6 2s-6-1.5-6-2v-2.23c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V17zm0-4c0 .5-2.13 2-6 2s-6-1.5-6-2v-2.23c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V13zm0-4c0 .5-2.13 2-6 2s-6-1.5-6-2V6.77c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V9z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-white mb-3">{{ $t('technologies.mysql.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.mysql.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.mysql.window') }}</strong> - {{ $t('technologies.mysql.windowDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.mysql.json') }}</strong> - {{ $t('technologies.mysql.jsonDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.mysql.cluster') }}</strong> - {{ $t('technologies.mysql.clusterDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.mysql.acid') }}</strong> - {{ $t('technologies.mysql.acidDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- PostgreSQL -->
          <div class="glass-card p-8 hover:border-indigo-500/50 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-indigo-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-indigo-400" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 3C7.58 3 4 4.79 4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7c0-2.21-3.58-4-8-4zm0 2c3.87 0 6 1.5 6 2s-2.13 2-6 2-6-1.5-6-2 2.13-2 6-2zm6 12c0 .5-2.13 2-6 2s-6-1.5-6-2v-2.23c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V17zm0-4c0 .5-2.13 2-6 2s-6-1.5-6-2v-2.23c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V13zm0-4c0 .5-2.13 2-6 2s-6-1.5-6-2V6.77c1.61.78 3.72 1.23 6 1.23s4.39-.45 6-1.23V9z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-white mb-3">{{ $t('technologies.postgresql.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.postgresql.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.postgresql.advanced') }}</strong> - {{ $t('technologies.postgresql.advancedDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.postgresql.fulltext') }}</strong> - {{ $t('technologies.postgresql.fulltextDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.postgresql.extensions') }}</strong> - {{ $t('technologies.postgresql.extensionsDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.postgresql.performance') }}</strong> - {{ $t('technologies.postgresql.performanceDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- TailwindCSS -->
          <div class="glass-card p-8 hover:border-cyan-500/50 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-cyan-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-cyan-400" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-white mb-3">{{ $t('technologies.tailwind.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.tailwind.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.tailwind.jit') }}</strong> - {{ $t('technologies.tailwind.jitDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.tailwind.design') }}</strong> - {{ $t('technologies.tailwind.designDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.tailwind.responsive') }}</strong> - {{ $t('technologies.tailwind.responsiveDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-white">{{ $t('technologies.tailwind.dark') }}</strong> - {{ $t('technologies.tailwind.darkDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DevOps & Infrastructure -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('technologies.devops.title') }} <span class="gradient-text">{{ $t('technologies.devops.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('technologies.devops.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Docker -->
          <div class="glass-card p-6 hover:border-blue-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.983 11.078h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 00.186-.186V3.574a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.186m0 2.716h2.118a.187.187 0 00.186-.186V6.29a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.887c0 .102.082.185.185.186m-2.93 0h2.12a.186.186 0 00.184-.186V6.29a.185.185 0 00-.185-.185H8.1a.185.185 0 00-.185.185v1.887c0 .102.083.185.185.186m-2.964 0h2.119a.186.186 0 00.185-.186V6.29a.185.185 0 00-.185-.185H5.136a.186.186 0 00-.186.185v1.887c0 .102.084.185.186.186m5.893 2.715h2.118a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m-2.93 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.083.185.185.185m-2.964 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.184-.186h-2.12a.186.186 0 00-.186.186v1.887c0 .102.084.185.186.185m-2.92 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.082.185.185.185M23.763 9.89c-.065-.051-.672-.51-1.954-.51-.338.001-.676.03-1.01.087-.248-1.7-1.653-2.53-1.716-2.566l-.344-.199-.226.327c-.284.438-.49.922-.612 1.43-.23.97-.09 1.882.403 2.661-.595.332-1.55.413-1.744.42H.751a.751.751 0 00-.75.748 11.376 11.376 0 00.692 4.062c.545 1.428 1.355 2.48 2.41 3.124 1.18.723 3.1 1.137 5.275 1.137.983.003 1.963-.086 2.93-.266a12.248 12.248 0 003.823-1.389c.98-.567 1.86-1.288 2.61-2.136 1.252-1.418 1.998-2.997 2.553-4.4h.221c1.372 0 2.215-.549 2.68-1.009.309-.293.55-.65.707-1.046l.098-.288z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.docker.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.docker.description') }}
            </p>
          </div>

          <!-- Nginx -->
          <div class="glass-card p-6 hover:border-green-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-green-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0L1.605 6v12L12 24l10.395-6V6L12 0zm6 16.59c0 .705-.646 1.29-1.529 1.29-.631 0-1.351-.255-1.801-.81l-6-7.141v6.66c0 .721-.57 1.29-1.274 1.29H7.32c-.721 0-1.29-.6-1.29-1.29V7.41c0-.705.63-1.29 1.5-1.29.646 0 1.38.255 1.83.81l5.97 7.141V7.41c0-.721.6-1.29 1.29-1.29h.075c.72 0 1.29.6 1.29 1.29v9.18h.015z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.nginx.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.nginx.description') }}
            </p>
          </div>

          <!-- Redis -->
          <div class="glass-card p-6 hover:border-red-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-red-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10.5 2.661l.54.997-1.797.644 2.409.218.748 1.246.467-1.412 2.409.218-1.796-.645.54-.997-1.536.718zm8.112 4.183l-1.373-.234-.235 1.373.942-1.139zM3.56 8.157l1.372.233.236-1.373-.943 1.14zM12 19.62l-7.14-3.536v-4.97L12 14.65v4.97zm.561-5.726L5.142 10.49l2.275-.837 6.462 2.564-.318.677zm6.862-.472l-6.421 3.183v4.97l7.141-3.536v-4.97l-.72.353zm-5.791-2.932l2.258.857 2.22-.817-2.258-.857-2.22.817zM10.5 7.933l2.258.858 2.22-.817L12.72 7.116l-2.22.817z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.redis.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.redis.description') }}
            </p>
          </div>

          <!-- Git -->
          <div class="glass-card p-6 hover:border-orange-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-orange-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.546 10.93L13.067.452c-.604-.603-1.582-.603-2.188 0L8.708 2.627l2.76 2.76c.645-.215 1.379-.07 1.889.441.516.515.658 1.258.438 1.9l2.658 2.66c.645-.223 1.387-.078 1.9.435.721.72.721 1.884 0 2.604-.719.719-1.881.719-2.6 0-.539-.541-.674-1.337-.404-1.996L12.86 8.955v6.525c.176.086.342.203.488.348.713.721.713 1.883 0 2.6-.719.721-1.889.721-2.609 0-.719-.719-.719-1.879 0-2.598.182-.18.387-.316.605-.406V8.835c-.217-.091-.424-.222-.6-.401-.545-.545-.676-1.342-.396-2.009L7.636 3.7.45 10.881c-.6.605-.6 1.584 0 2.189l10.48 10.477c.604.604 1.582.604 2.186 0l10.43-10.43c.605-.603.605-1.582 0-2.187"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.git.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.git.description') }}
            </p>
          </div>

          <!-- Linux -->
          <div class="glass-card p-6 hover:border-yellow-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.504 0c-.155 0-.315.008-.48.021-4.226.333-3.105 4.807-3.17 6.298-.076 1.092-.3 1.953-1.05 3.02-.885 1.051-2.127 2.75-2.716 4.521-.278.832-.41 1.684-.287 2.489a.424.424 0 00-.11.135c-.26.268-.45.6-.663.839-.199.199-.485.267-.797.4-.313.136-.658.269-.864.68-.09.189-.136.394-.132.602 0 .199.027.4.055.536.058.399.116.728.04.97-.249.68-.28 1.145-.106 1.484.174.334.535.47.94.601.81.2 1.91.135 2.774.6.926.466 1.866.67 2.616.47.526-.116.97-.464 1.208-.946.587-.003 1.23-.269 2.26-.334.699-.058 1.574.267 2.577.2.025.134.063.198.114.333l.003.003c.391.778 1.113 1.132 1.884 1.071.771-.06 1.592-.536 2.257-1.306.631-.765 1.683-1.084 2.378-1.503.348-.199.629-.469.649-.853.023-.4-.2-.811-.714-1.376v-.097l-.003-.003c-.17-.2-.25-.535-.338-.926-.085-.401-.182-.786-.492-1.046h-.003c-.059-.054-.123-.067-.188-.135a.357.357 0 00-.19-.064c.431-1.278.264-2.55-.173-3.694-.533-1.41-1.465-2.638-2.175-3.483-.796-1.005-1.576-1.957-1.56-3.368.026-2.152.236-6.133-3.544-6.139z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.linux.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.linux.description') }}
            </p>
          </div>

          <!-- Vite -->
          <div class="glass-card p-6 hover:border-purple-400/50 transition-all duration-300">
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-purple-400" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $t('technologies.vite.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.vite.description') }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Why This Stack -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="section-title mb-6">{{ $t('technologies.why.title') }} <span class="gradient-text">{{ $t('technologies.why.titleHighlight') }}</span></h2>
            <p class="text-dark-300 mb-6">
              {{ $t('technologies.why.subtitle') }}
            </p>
            <div class="space-y-4">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-primary-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">{{ $t('technologies.why.performance.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.performance.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">{{ $t('technologies.why.security.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.security.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-secondary-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">{{ $t('technologies.why.scalability.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.scalability.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-accent-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-semibold mb-1">{{ $t('technologies.why.community.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.community.description') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="glass-card p-8">
            <h3 class="text-xl font-bold text-white mb-6">{{ $t('technologies.stats.title') }}</h3>
            <div class="space-y-6">
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.laravelPopularity') }}</span>
                  <span class="text-primary-400 font-semibold">78%</span>
                </div>
                <div class="h-2 bg-dark-700 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full" style="width: 78%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.vueSatisfaction') }}</span>
                  <span class="text-green-400 font-semibold">92%</span>
                </div>
                <div class="h-2 bg-dark-700 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" style="width: 92%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.mysqlShare') }}</span>
                  <span class="text-blue-400 font-semibold">43%</span>
                </div>
                <div class="h-2 bg-dark-700 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full" style="width: 43%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.tailwindGrowth') }}</span>
                  <span class="text-cyan-400 font-semibold">156%</span>
                </div>
                <div class="h-2 bg-dark-700 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-cyan-500 to-teal-500 rounded-full" style="width: 100%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary-900 to-secondary-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ $t('technologies.cta.title') }}
        </h2>
        <p class="text-xl text-white/70 mb-8">
          {{ $t('technologies.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="btn-primary px-10 py-4 text-lg">
          {{ $t('technologies.cta.button') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>
