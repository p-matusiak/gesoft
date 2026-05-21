<template>
  <div class="pt-20">
    <!-- Header -->
    <section class="py-16 sm:py-20 bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-5">
          <span class="text-brand-600">{{ $t('technologies.header.title') }}</span>
        </h1>
        <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
          {{ $t('technologies.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Main Technologies -->
    <section class="py-20 bg-dark-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('technologies.mainStack.title') }} <span class="text-brand-600">{{ $t('technologies.mainStack.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('technologies.mainStack.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Laravel -->
          <div class="glass-card p-8 hover:border-red-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/laravel" alt="Laravel" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.laravel.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.laravel.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.laravel.eloquent') }}</strong> - {{ $t('technologies.laravel.eloquentDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.laravel.artisan') }}</strong> - {{ $t('technologies.laravel.artisanDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.laravel.security') }}</strong> - {{ $t('technologies.laravel.securityDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.laravel.queue') }}</strong> - {{ $t('technologies.laravel.queueDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Vue.js -->
          <div class="glass-card p-8 hover:border-green-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/vuedotjs" alt="Vue.js" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.vue.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.vue.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.vue.reactivity') }}</strong> - {{ $t('technologies.vue.reactivityDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.vue.sfc') }}</strong> - {{ $t('technologies.vue.sfcDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.vue.pinia') }}</strong> - {{ $t('technologies.vue.piniaDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.vue.size') }}</strong> - {{ $t('technologies.vue.sizeDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- MySQL -->
          <div class="glass-card p-8 hover:border-blue-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/mysql" alt="MySQL" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.mysql.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.mysql.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.mysql.window') }}</strong> - {{ $t('technologies.mysql.windowDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.mysql.json') }}</strong> - {{ $t('technologies.mysql.jsonDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.mysql.cluster') }}</strong> - {{ $t('technologies.mysql.clusterDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.mysql.acid') }}</strong> - {{ $t('technologies.mysql.acidDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- PostgreSQL -->
          <div class="glass-card p-8 hover:border-indigo-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/postgresql" alt="PostgreSQL" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.postgresql.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.postgresql.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.postgresql.advanced') }}</strong> - {{ $t('technologies.postgresql.advancedDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.postgresql.fulltext') }}</strong> - {{ $t('technologies.postgresql.fulltextDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.postgresql.extensions') }}</strong> - {{ $t('technologies.postgresql.extensionsDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.postgresql.performance') }}</strong> - {{ $t('technologies.postgresql.performanceDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- TailwindCSS -->
          <div class="glass-card p-8 hover:border-cyan-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-cyan-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/tailwindcss" alt="TailwindCSS" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.tailwind.title') }}</h3>
                <p class="text-dark-300 mb-4">
                  {{ $t('technologies.tailwind.description') }}
                </p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.tailwind.jit') }}</strong> - {{ $t('technologies.tailwind.jitDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.tailwind.design') }}</strong> - {{ $t('technologies.tailwind.designDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.tailwind.responsive') }}</strong> - {{ $t('technologies.tailwind.responsiveDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.tailwind.dark') }}</strong> - {{ $t('technologies.tailwind.darkDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Android Mobile Stack -->
    <section class="py-20 bg-white border-t border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <div class="inline-flex items-center gap-2 bg-green-50 border border-green-200 rounded-full px-4 py-1.5 mb-4">
            <img src="https://cdn.simpleicons.org/android" alt="Android" class="w-4 h-4" />
            <span class="text-green-700 text-sm font-medium">{{ $t('technologies.android.badge') }}</span>
          </div>
          <h2 class="section-title">{{ $t('technologies.android.sectionTitle') }} <span class="text-brand-600">{{ $t('technologies.android.sectionTitleHighlight') }}</span></h2>
          <p class="section-subtitle">{{ $t('technologies.android.sectionSubtitle') }}</p>
        </div>

        <!-- Kotlin + Compose -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
          <!-- Kotlin -->
          <div class="glass-card p-8 hover:border-purple-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/kotlin" alt="Kotlin" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.android.kotlin.title') }}</h3>
                <p class="text-dark-300 mb-4">{{ $t('technologies.android.kotlin.description') }}</p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.kotlin.nullSafety') }}</strong> - {{ $t('technologies.android.kotlin.nullSafetyDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.kotlin.coroutines') }}</strong> - {{ $t('technologies.android.kotlin.coroutinesDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.kotlin.extensions') }}</strong> - {{ $t('technologies.android.kotlin.extensionsDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.kotlin.interop') }}</strong> - {{ $t('technologies.android.kotlin.interopDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Jetpack Compose -->
          <div class="glass-card p-8 hover:border-teal-300 transition-all duration-300">
            <div class="flex items-start gap-6">
              <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                <img src="https://cdn.simpleicons.org/jetpackcompose" alt="Jetpack Compose" class="w-10 h-10" />
              </div>
              <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $t('technologies.android.compose.title') }}</h3>
                <p class="text-dark-300 mb-4">{{ $t('technologies.android.compose.description') }}</p>
                <ul class="space-y-2 text-dark-400">
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.compose.declarative') }}</strong> - {{ $t('technologies.android.compose.declarativeDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.compose.state') }}</strong> - {{ $t('technologies.android.compose.stateDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.compose.animation') }}</strong> - {{ $t('technologies.android.compose.animationDesc') }}</span>
                  </li>
                  <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span><strong class="text-gray-900">{{ $t('technologies.android.compose.preview') }}</strong> - {{ $t('technologies.android.compose.previewDesc') }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Material Design 3 - full width featured card -->
        <div class="glass-card p-8 hover:border-brand-300 transition-all duration-300 mb-8">
          <div class="flex items-start gap-6">
            <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center flex-shrink-0">
              <img src="https://cdn.simpleicons.org/materialdesign" alt="Material Design" class="w-10 h-10" />
            </div>
            <div class="flex-1">
              <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $t('technologies.android.material3.title') }}</h3>
              <p class="text-dark-300 mb-6">{{ $t('technologies.android.material3.description') }}</p>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                  <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                  </div>
                  <h4 class="text-gray-900 font-semibold text-sm mb-1">{{ $t('technologies.android.material3.dynamicColor') }}</h4>
                  <p class="text-gray-500 text-xs">{{ $t('technologies.android.material3.dynamicColorDesc') }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                  <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm0 8a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zm12 0a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                  </div>
                  <h4 class="text-gray-900 font-semibold text-sm mb-1">{{ $t('technologies.android.material3.components') }}</h4>
                  <p class="text-gray-500 text-xs">{{ $t('technologies.android.material3.componentsDesc') }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                  <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                  </div>
                  <h4 class="text-gray-900 font-semibold text-sm mb-1">{{ $t('technologies.android.material3.theming') }}</h4>
                  <p class="text-gray-500 text-xs">{{ $t('technologies.android.material3.themingDesc') }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                  <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  </div>
                  <h4 class="text-gray-900 font-semibold text-sm mb-1">{{ $t('technologies.android.material3.accessibility') }}</h4>
                  <p class="text-gray-500 text-xs">{{ $t('technologies.android.material3.accessibilityDesc') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Android ecosystem small cards -->
        <div class="text-center mb-8">
          <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.android.ecosystem.title') }}</h3>
          <p class="text-gray-500 text-sm">{{ $t('technologies.android.ecosystem.subtitle') }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          <!-- Firebase -->
          <div class="glass-card p-4 hover:border-amber-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <img src="https://cdn.simpleicons.org/firebase" alt="Firebase" class="w-6 h-6" />
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.firebase.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.firebase.desc') }}</p>
          </div>
          <!-- Google Maps -->
          <div class="glass-card p-4 hover:border-green-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <img src="https://cdn.simpleicons.org/googlemaps" alt="Google Maps" class="w-6 h-6" />
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.maps.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.maps.desc') }}</p>
          </div>
          <!-- Room -->
          <div class="glass-card p-4 hover:border-blue-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.room.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.room.desc') }}</p>
          </div>
          <!-- Retrofit -->
          <div class="glass-card p-4 hover:border-orange-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.retrofit.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.retrofit.desc') }}</p>
          </div>
          <!-- Hilt -->
          <div class="glass-card p-4 hover:border-red-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.hilt.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.hilt.desc') }}</p>
          </div>
          <!-- WorkManager -->
          <div class="glass-card p-4 hover:border-indigo-300 transition-all duration-300 text-center">
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center mb-3 mx-auto">
              <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $t('technologies.android.ecosystem.workmanager.title') }}</h4>
            <p class="text-xs text-gray-500">{{ $t('technologies.android.ecosystem.workmanager.desc') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- DevOps & Infrastructure -->
    <section class="py-20 bg-dark-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="section-title">{{ $t('technologies.devops.title') }} <span class="text-brand-600">{{ $t('technologies.devops.titleHighlight') }}</span></h2>
          <p class="section-subtitle">
            {{ $t('technologies.devops.subtitle') }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Docker -->
          <div class="glass-card p-6 hover:border-blue-300 transition-all duration-300">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/docker" alt="Docker" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.docker.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.docker.description') }}
            </p>
          </div>

          <!-- Nginx -->
          <div class="glass-card p-6 hover:border-green-300 transition-all duration-300">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/nginx" alt="Nginx" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.nginx.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.nginx.description') }}
            </p>
          </div>

          <!-- Redis -->
          <div class="glass-card p-6 hover:border-red-300 transition-all duration-300">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/redis" alt="Redis" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.redis.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.redis.description') }}
            </p>
          </div>

          <!-- Git -->
          <div class="glass-card p-6 hover:border-orange-300 transition-all duration-300">
            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/git" alt="Git" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.git.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.git.description') }}
            </p>
          </div>

          <!-- Linux -->
          <div class="glass-card p-6 hover:border-yellow-300 transition-all duration-300">
            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/linux" alt="Linux" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.linux.title') }}</h3>
            <p class="text-dark-400 text-sm">
              {{ $t('technologies.linux.description') }}
            </p>
          </div>

          <!-- Vite -->
          <div class="glass-card p-6 hover:border-purple-300 transition-all duration-300">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
              <img src="https://cdn.simpleicons.org/vite" alt="Vite" class="w-7 h-7" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $t('technologies.vite.title') }}</h3>
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
            <h2 class="section-title mb-6">{{ $t('technologies.why.title') }} <span class="text-brand-600">{{ $t('technologies.why.titleHighlight') }}</span></h2>
            <p class="text-dark-300 mb-6">
              {{ $t('technologies.why.subtitle') }}
            </p>
            <div class="space-y-4">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-gray-900 font-semibold mb-1">{{ $t('technologies.why.performance.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.performance.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-gray-900 font-semibold mb-1">{{ $t('technologies.why.security.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.security.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-gray-900 font-semibold mb-1">{{ $t('technologies.why.scalability.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.scalability.description') }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-gray-900 font-semibold mb-1">{{ $t('technologies.why.community.title') }}</h4>
                  <p class="text-dark-400 text-sm">{{ $t('technologies.why.community.description') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="glass-card p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">{{ $t('technologies.stats.title') }}</h3>
            <div class="space-y-6">
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.laravelPopularity') }}</span>
                  <span class="text-brand-600 font-semibold">78%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-brand-600 rounded-full" style="width: 78%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.vueSatisfaction') }}</span>
                  <span class="text-green-600 font-semibold">92%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-green-600 rounded-full" style="width: 92%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.mysqlShare') }}</span>
                  <span class="text-blue-600 font-semibold">43%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-blue-600 rounded-full" style="width: 43%"></div>
                </div>
              </div>
              <div>
                <div class="flex justify-between text-sm mb-2">
                  <span class="text-dark-300">{{ $t('technologies.stats.tailwindGrowth') }}</span>
                  <span class="text-cyan-600 font-semibold">156%</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-cyan-600 rounded-full" style="width: 100%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
          {{ $t('technologies.cta.title') }}
        </h2>
        <p class="text-lg text-gray-300 mb-8">
          {{ $t('technologies.cta.subtitle') }}
        </p>
        <router-link to="/kontakt" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-brand-700 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200">
          {{ $t('technologies.cta.button') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
</script>
