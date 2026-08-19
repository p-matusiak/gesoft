<template>
  <div>
    <PageHero
      :title="$t('about.header.title')"
      :subtitle="$t('about.header.subtitle')"
    />

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
          <h2 class="section-title">{{ $t('about.story.title') }}</h2>
          <p class="text-gray-700 mb-4 leading-relaxed">{{ $t('about.story.content1') }}</p>
          <p class="text-gray-700 mb-4 leading-relaxed">{{ $t('about.story.content2') }}</p>
          <p class="text-gray-700 leading-relaxed">{{ $t('about.story.content3') }}</p>
        </div>
      </div>
    </section>

    <section class="py-16 sm:py-20 bg-gray-50 border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-10">
          <h2 class="section-title">{{ $t('about.factsTitle') }}</h2>
        </div>
        <ul class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl">
          <li v-for="item in facts" :key="item.title">
            <h3 class="heading-3 text-gray-900 mb-2">{{ item.title }}</h3>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ item.description }}</p>
          </li>
        </ul>
      </div>
    </section>

    <PageCta
      :title="$t('about.cta.title')"
      :subtitle="$t('about.cta.subtitle')"
      :button-label="$t('about.cta.button')"
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
const facts = computed(() => tm('about.facts'))
</script>
