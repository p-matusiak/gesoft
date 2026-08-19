<template>
  <template v-for="(part, index) in parts" :key="index">
    <router-link
      v-if="part.type === 'internal'"
      :to="part.href"
      class="text-brand-600 font-medium hover:underline"
    >{{ part.text }}</router-link>
    <a
      v-else-if="part.type === 'external'"
      :href="part.href"
      class="text-brand-600 font-medium hover:underline"
      target="_blank"
      rel="noopener noreferrer"
    >{{ part.text }}</a>
    <strong v-else-if="part.type === 'strong'" class="font-semibold text-gray-900">{{ part.text }}</strong>
    <em v-else-if="part.type === 'em'" class="italic text-gray-800">{{ part.text }}</em>
    <u v-else-if="part.type === 'u'" class="underline decoration-brand-600 decoration-2 underline-offset-2">{{ part.text }}</u>
    <span v-else>{{ part.text }}</span>
  </template>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  text: {
    type: String,
    required: true
  }
})

const TOKEN_RE = /(\*\*(.+?)\*\*|\+\+(.+?)\+\+|\*(.+?)\*|\[([^\]]+)\]\((\/[^)\s]+|https?:\/\/[^)\s]+)\))/g

const parts = computed(() => {
  const source = props.text || ''
  const result = []
  let lastIndex = 0
  let match

  TOKEN_RE.lastIndex = 0
  while ((match = TOKEN_RE.exec(source)) !== null) {
    if (match.index > lastIndex) {
      result.push({ type: 'text', text: source.slice(lastIndex, match.index) })
    }

    if (match[2]) {
      result.push({ type: 'strong', text: match[2] })
    } else if (match[3]) {
      result.push({ type: 'u', text: match[3] })
    } else if (match[4]) {
      result.push({ type: 'em', text: match[4] })
    } else {
      const href = match[6]
      result.push({
        type: href.startsWith('/') ? 'internal' : 'external',
        text: match[5],
        href
      })
    }

    lastIndex = match.index + match[0].length
  }

  if (lastIndex < source.length) {
    result.push({ type: 'text', text: source.slice(lastIndex) })
  }

  return result.length ? result : [{ type: 'text', text: source }]
})
</script>
