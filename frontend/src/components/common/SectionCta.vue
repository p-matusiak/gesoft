<template>
  <section :class="variant === 'brand' ? 'pb-8 bg-white' : 'py-20 bg-gray-900'">
    <div
      :class="variant === 'brand'
        ? 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'
        : 'max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center'"
    >
      <div :class="variant === 'brand' ? 'bg-brand-600 rounded-lg p-8 sm:p-10 text-center' : ''">
        <h2
          :class="variant === 'brand'
            ? 'text-2xl sm:text-3xl font-bold text-white mb-3'
            : 'text-3xl md:text-4xl font-bold text-white mb-5'"
        >
          {{ title }}
        </h2>
        <p
          v-if="subtitle"
          :class="variant === 'brand'
            ? 'text-white/90 mb-6 max-w-xl mx-auto'
            : 'text-lg text-gray-300 mb-8'"
        >
          {{ subtitle }}
        </p>
        <router-link
          :to="to"
          :class="variant === 'brand'
            ? 'inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-brand-700 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200'
            : 'inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-brand-700 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200'"
        >
          {{ buttonLabel }}
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  subtitle: {
    type: String,
    default: ''
  },
  buttonLabel: {
    type: String,
    required: true
  },
  to: {
    type: String,
    default: '/kontakt'
  },
  variant: {
    type: String,
    default: 'dark'
  }
})
</script>
