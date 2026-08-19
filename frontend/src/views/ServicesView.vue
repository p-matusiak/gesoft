<template>
  <div>
    <PageHero
      :title="$t('services.header.title')"
      :subtitle="$t('services.header.subtitle')"
    />

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
          <article v-for="service in services" :key="service.id">
            <h2 class="heading-3 text-gray-900 mb-2">{{ $t(service.titleKey) }}</h2>
            <p class="text-gray-600 text-sm sm:text-base mb-4 leading-relaxed">{{ $t(service.descKey) }}</p>
            <ul class="space-y-2">
              <li v-for="(feature, index) in $tm(service.featuresKey)" :key="index" class="text-gray-700 text-sm">
                {{ feature }}
              </li>
            </ul>
          </article>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-gray-50 border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
          <h2 class="section-title">{{ $t('services.process.title') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('services.process.subtitle') }}</p>
        </div>
        <ol class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <li v-for="(step, index) in processSteps" :key="step.title">
            <span class="block text-sm font-semibold text-brand-600 mb-3">{{ String(index + 1).padStart(2, '0') }}</span>
            <h3 class="heading-3 text-gray-900 mb-2">{{ step.title }}</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ step.description }}</p>
          </li>
        </ol>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
          <h2 class="section-title">{{ $t('services.deployment.title') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('services.deployment.subtitle') }}</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <div>
            <h3 class="heading-3 text-gray-900 mb-2">{{ $t('services.deployment.included.title') }}</h3>
            <p class="text-gray-600 text-sm mb-5">{{ $t('services.deployment.included.description') }}</p>
            <ul class="space-y-3">
              <li v-for="(item, i) in $tm('services.deployment.included.items')" :key="i" class="text-gray-700 text-sm leading-relaxed">
                {{ item }}
              </li>
            </ul>
          </div>
          <div>
            <h3 class="heading-3 text-gray-900 mb-2">{{ $t('services.deployment.addon.title') }}</h3>
            <p class="text-gray-600 text-sm mb-5">{{ $t('services.deployment.addon.description') }}</p>
            <ul class="space-y-3">
              <li v-for="(item, i) in $tm('services.deployment.addon.items')" :key="i" class="text-gray-700 text-sm leading-relaxed">
                {{ item }}
              </li>
            </ul>
          </div>
        </div>
        <div class="mt-14 max-w-3xl">
          <h3 class="heading-3 text-gray-900 mb-2">{{ $t('services.deployment.code.title') }}</h3>
          <p class="text-gray-600 text-sm mb-5">{{ $t('services.deployment.code.description') }}</p>
          <ul class="space-y-3">
            <li v-for="(item, i) in $tm('services.deployment.code.items')" :key="i" class="text-gray-700 text-sm leading-relaxed">
              {{ item }}
            </li>
          </ul>
        </div>
      </div>
    </section>

    <PageCta
      :title="$t('services.cta.title')"
      :subtitle="$t('services.cta.subtitle')"
      :button-label="$t('services.cta.button')"
      :phone="$t('home.cta.phone')"
    />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'
import PageHero from '@/components/common/PageHero.vue'
import PageCta from '@/components/common/PageCta.vue'

const { tm } = useI18n()

const services = [
  { id: 1, titleKey: 'services.items.websites.title', descKey: 'services.items.websites.description', featuresKey: 'services.items.websites.features' },
  { id: 2, titleKey: 'services.items.webapps.title', descKey: 'services.items.webapps.description', featuresKey: 'services.items.webapps.features' },
  { id: 3, titleKey: 'services.items.ecommerce.title', descKey: 'services.items.ecommerce.description', featuresKey: 'services.items.ecommerce.features' },
  { id: 4, titleKey: 'services.items.crm.title', descKey: 'services.items.crm.description', featuresKey: 'services.items.crm.features' },
  { id: 5, titleKey: 'services.items.android.title', descKey: 'services.items.android.description', featuresKey: 'services.items.android.features' },
  { id: 6, titleKey: 'services.items.api.title', descKey: 'services.items.api.description', featuresKey: 'services.items.api.features' },
  { id: 7, titleKey: 'services.items.support.title', descKey: 'services.items.support.description', featuresKey: 'services.items.support.features' },
  { id: 8, titleKey: 'services.items.photography.title', descKey: 'services.items.photography.description', featuresKey: 'services.items.photography.features' },
  { id: 9, titleKey: 'services.items.drone.title', descKey: 'services.items.drone.description', featuresKey: 'services.items.drone.features' },
  { id: 10, titleKey: 'services.items.seoAudit.title', descKey: 'services.items.seoAudit.description', featuresKey: 'services.items.seoAudit.features' }
]

const processSteps = computed(() => tm('home.process.steps'))
</script>
