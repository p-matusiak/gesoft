<template>
  <section class="pt-28 sm:pt-32 pb-12 sm:pb-16 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl">
        <p v-if="eyebrow" class="text-sm font-medium text-brand-600 mb-4">{{ eyebrow }}</p>
        <h1 class="font-heading font-bold text-gray-900 text-[1.7rem] sm:text-[2.1rem] md:text-[2.5rem] leading-[1.15] mb-4">
          {{ title }}
        </h1>
        <p v-if="subtitle" class="text-base sm:text-lg text-gray-600 leading-relaxed max-w-2xl">
          {{ subtitle }}
        </p>
        <slot />
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
  eyebrow: {
    type: String,
    default: ''
  }
})
</script>
