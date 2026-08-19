<template>
  <span
    class="inline-flex items-center rounded-full text-xs font-semibold"
    :class="[sizeClass, toneClass]"
  >
    <slot>{{ label }}</slot>
  </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  label: {
    type: String,
    default: ''
  },
  tone: {
    type: String,
    default: 'neutral'
  },
  size: {
    type: String,
    default: 'md'
  }
})

const toneClass = computed(() => {
  const map = {
    laravel: 'bg-red-50 text-red-700',
    security: 'bg-green-50 text-green-700',
    business: 'bg-blue-50 text-blue-700',
    industry: 'bg-amber-50 text-amber-800',
    brand: 'bg-brand-50 text-brand-700',
    neutral: 'bg-gray-100 text-gray-700'
  }
  return map[props.tone] || map.neutral
})

const sizeClass = computed(() => {
  return props.size === 'sm' ? 'px-2 py-0.5' : 'px-2.5 py-1'
})
</script>
