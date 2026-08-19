<template>
  <section class="py-16 sm:py-20 bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="heading-2 text-white mb-4">{{ title }}</h2>
      <p v-if="subtitle" class="text-gray-300 mb-8 text-base sm:text-lg">{{ subtitle }}</p>
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <router-link
          :to="to"
          class="inline-flex items-center justify-center px-7 py-3 text-base font-semibold text-gray-900 bg-white rounded-md hover:bg-gray-100 transition-colors duration-200"
        >
          {{ buttonLabel }}
        </router-link>
        <a v-if="phone" :href="`tel:${phoneHref}`" class="text-white/80 text-sm hover:text-white">
          {{ phone }}
        </a>
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
  phone: {
    type: String,
    default: ''
  },
  phoneHref: {
    type: String,
    default: '+48517123374'
  }
})
</script>
