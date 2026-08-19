<template>
  <header class="bg-white border-b border-gray-200" :class="compact ? 'py-12 sm:py-16' : 'py-16 sm:py-20'">
    <div
      class="mx-auto px-4 sm:px-6 lg:px-8"
      :class="[narrow ? 'max-w-3xl' : 'max-w-7xl', align === 'left' ? 'text-left' : 'text-center']"
    >
      <slot name="before" />
      <component :is="heading" class="font-bold text-gray-900 mb-5" :class="headingClass">
        <span :class="brand ? 'text-brand-600' : ''">{{ title }}</span>
        <span v-if="highlight" class="text-brand-600"> {{ highlight }}</span>
      </component>
      <p
        v-if="subtitle"
        class="text-lg sm:text-xl text-gray-600 leading-relaxed"
        :class="align === 'left' ? 'max-w-4xl' : 'max-w-3xl mx-auto'"
      >
        {{ subtitle }}
      </p>
      <slot />
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  highlight: {
    type: String,
    default: ''
  },
  subtitle: {
    type: String,
    default: ''
  },
  heading: {
    type: String,
    default: 'h1'
  },
  brand: {
    type: Boolean,
    default: false
  },
  compact: {
    type: Boolean,
    default: false
  },
  align: {
    type: String,
    default: 'center'
  },
  narrow: {
    type: Boolean,
    default: false
  }
})

const headingClass = computed(() => {
  return props.compact
    ? 'heading-1'
    : 'text-4xl md:text-5xl'
})
</script>
