<template>
  <nav class="mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2">
      <li v-for="(item, index) in items" :key="`${item.label}-${index}`" class="flex items-center gap-2">
        <router-link
          v-if="item.to && index < items.length - 1"
          :to="item.to"
          class="hover:text-brand-600"
        >
          {{ item.label }}
        </router-link>
        <span
          v-else
          class="text-gray-900 font-medium line-clamp-1"
          :aria-current="index === items.length - 1 ? 'page' : undefined"
        >
          {{ item.label }}
        </span>
        <span v-if="index < items.length - 1" aria-hidden="true">/</span>
      </li>
    </ol>
  </nav>
</template>

<script setup>
defineProps({
  items: {
    type: Array,
    required: true
  }
})
</script>
