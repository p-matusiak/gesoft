<template>
  <div class="flex flex-wrap items-center justify-center gap-2" role="tablist">
    <component
      :is="item.to ? 'router-link' : 'button'"
      v-for="item in items"
      :key="item.id"
      :to="item.to"
      :type="item.to ? undefined : 'button'"
      role="tab"
      class="px-4 py-2 rounded-full text-sm font-medium border transition-colors"
      :class="isActive(item)
        ? 'bg-brand-600 text-white border-brand-600'
        : 'bg-white text-gray-700 border-gray-200 hover:border-brand-300 hover:text-brand-600'"
      :aria-selected="isActive(item) ? 'true' : 'false'"
      @click="!item.to && $emit('update:modelValue', item.id)"
    >
      {{ item.label }}
    </component>
  </div>
</template>

<script setup>
const props = defineProps({
  items: {
    type: Array,
    required: true
  },
  modelValue: {
    type: String,
    default: 'all'
  }
})

defineEmits(['update:modelValue'])

const isActive = (item) => item.id === props.modelValue
</script>
