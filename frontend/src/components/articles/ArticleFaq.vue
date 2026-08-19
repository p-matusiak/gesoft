<template>
  <section class="article-faq" aria-labelledby="article-faq-heading">
    <h2 id="article-faq-heading">{{ title }}</h2>
    <dl class="space-y-5">
      <div v-for="(item, index) in items" :key="index">
        <dt class="font-semibold text-gray-900 mb-1">{{ item.q }}</dt>
        <dd class="text-gray-700">
          <InlineText :text="item.a" />
        </dd>
      </div>
    </dl>
  </section>
</template>

<script setup>
import InlineText from '@/components/articles/InlineText.vue'

defineProps({
  items: {
    type: Array,
    default: () => []
  },
  title: {
    type: String,
    default: 'Najczęściej zadawane pytania'
  }
})
</script>
