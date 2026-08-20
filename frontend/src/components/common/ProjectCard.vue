<template>
  <component
    :is="to ? 'router-link' : 'article'"
    :to="to"
    class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md hover:border-brand-200 transition-all duration-200 text-left w-full"
    :class="to ? '' : 'cursor-pointer group'"
    @click="!to && $emit('select')"
  >
    <div class="aspect-video bg-gray-100 relative overflow-hidden isolate">
      <div
        v-if="!imageLoaded && !imageError"
        class="absolute inset-0 z-10 flex items-center justify-center bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200"
        role="status"
        aria-live="polite"
      >
        <div class="flex flex-col items-center gap-3 text-gray-500">
          <span class="relative flex h-10 w-10 items-center justify-center rounded-full bg-white/90 shadow-sm ring-1 ring-gray-200">
            <span class="absolute inset-1 rounded-full border-2 border-gray-200" />
            <span class="absolute inset-1 rounded-full border-2 border-transparent border-t-brand-600 animate-spin motion-reduce:animate-none" />
          </span>
          <span class="text-xs font-medium">Ładowanie podglądu…</span>
        </div>
      </div>

      <div
        v-else-if="imageError"
        class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-2 bg-gray-100 px-6 text-center text-gray-500"
        role="status"
      >
        <svg class="h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v11.25a1.5 1.5 0 0 0 1.5 1.5Zm12-10.5h.008v.008h-.008V8.25Z" />
        </svg>
        <span class="text-xs font-medium">Nie udało się załadować podglądu</span>
      </div>

      <img
        :src="project.image"
        :alt="title"
        class="w-full h-full object-cover transition-opacity duration-300"
        :class="imageLoaded ? 'opacity-100' : 'opacity-0'"
        width="640"
        height="360"
        loading="lazy"
        decoding="async"
        @load="handleImageLoad"
        @error="handleImageError"
      />
      <div
        v-if="overlay && imageLoaded"
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
import { ref, watch } from 'vue'

const props = defineProps({
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

const imageLoaded = ref(false)
const imageError = ref(false)

function handleImageLoad() {
  imageLoaded.value = true
  imageError.value = false
}

function handleImageError() {
  imageLoaded.value = false
  imageError.value = true
}

watch(
  () => props.project.image,
  () => {
    imageLoaded.value = false
    imageError.value = false
  }
)
</script>
