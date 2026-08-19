<template>
  <div>
    <PageHero
      :title="$t('technologies.header.title')"
      :subtitle="$t('technologies.header.subtitle')"
    />

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
          <h2 class="section-title">{{ $t('technologies.mainStack.title') }}</h2>
          <p class="text-gray-600 text-base sm:text-lg">{{ $t('technologies.mainStack.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
          <div v-for="group in groups" :key="group.title">
            <h3 class="heading-3 text-gray-900 mb-4">{{ group.title }}</h3>
            <ul class="space-y-4">
              <li v-for="item in group.items" :key="item.name">
                <p class="font-semibold text-gray-900">{{ item.name }}</p>
                <p class="text-gray-600 text-sm leading-relaxed mt-1">{{ item.description }}</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-gray-50 border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
          <h2 class="section-title">{{ $t('technologies.why.title') }}</h2>
          <p class="text-gray-700 mb-4 leading-relaxed">{{ $t('technologies.why.subtitle') }}</p>
          <p class="text-gray-700 leading-relaxed">{{ $t('technologies.why.note') }}</p>
        </div>
      </div>
    </section>

    <PageCta
      :title="$t('technologies.cta.title')"
      :subtitle="$t('technologies.cta.subtitle')"
      :button-label="$t('technologies.cta.button')"
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
const groups = computed(() => tm('technologies.groups'))
</script>
