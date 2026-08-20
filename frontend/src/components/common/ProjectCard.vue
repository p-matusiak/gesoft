<template>
  <component
    :is="to ? 'router-link' : 'article'"
    :to="to"
    class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md hover:border-brand-200 transition-all duration-200 text-left w-full"
    :class="to ? '' : 'cursor-pointer group'"
    @click="!to && $emit('select')"
  >
    <div class="aspect-video bg-gray-100 relative overflow-hidden">
      <img
        :src="project.image"
        :alt="title"
        class="w-full h-full object-cover"
        width="640"
        height="360"
        loading="lazy"
        decoding="async"
      />
      <div
        v-if="overlay"
        class="absolute inset-0 bg-gray-900/70 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center"
      >
        <span class="text-white font-medium">{{ overlay }}</span>
      </div>
    </div>
    <div :class="compact ? 'p-4' : 'p-6'">
      <span class="text-xs text-brand-600 uppercase tracking-wider font-semibold">{{ categoryLabel }}</span>
      <component :is="heading" :class="compact ? 'text-base font-semibold text-gray-900 mt-1 mb-2 leading-snug' : 'text-xl font-semibold text-gray-900 mt-2 mb-2'">
        {{ title }}
      </component>
      <p class="text-gray-600 text-sm" :class="compact ? 'line-clamp-2' : 'mb-4'">{{ description }}</p>
      <slot />
    </div>
  </component>
</template>

<script setup>
defineProps({
  project: {
    type: Object,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  categoryLabel: {
    type: String,
    required: true
  },
  to: {
    type: [String, Object],
    default: null
  },
  overlay: {
    type: String,
    default: ''
  },
  compact: {
    type: Boolean,
    default: false
  },
  heading: {
    type: String,
    default: 'h3'
  }
})

defineEmits(['select'])
</script>
