<template>
  <article class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-12 xl:gap-16">
        <div class="lg:col-span-8 article-prose">
          <template v-for="(block, index) in content" :key="index">
            <h2 v-if="block.type === 'h2'" :id="headingId(block.text)">{{ block.text }}</h2>
            <h3 v-else-if="block.type === 'h3'">{{ block.text }}</h3>
            <p v-else-if="block.type === 'p'">
              <InlineText :text="block.text" />
            </p>
            <ul v-else-if="block.type === 'ul'">
              <li v-for="(item, itemIndex) in block.items" :key="itemIndex">
                <InlineText :text="item" />
              </li>
            </ul>
            <ol v-else-if="block.type === 'ol'">
              <li v-for="(item, itemIndex) in block.items" :key="itemIndex">
                <InlineText :text="item" />
              </li>
            </ol>
            <aside v-else-if="block.type === 'callout'" class="article-callout">
              <p class="article-callout-title">{{ block.title }}</p>
              <p><InlineText :text="block.text" /></p>
            </aside>
            <ArticleFaq v-else-if="block.type === 'faq'" :items="block.items" :title="block.title || faqTitle" />
          </template>
        </div>

        <aside v-if="headings.length" class="hidden lg:block lg:col-span-4">
          <nav class="sticky top-28 rounded-lg border border-gray-200 bg-gray-50 p-6" aria-label="Spis treści">
            <p class="text-sm font-semibold text-gray-900 mb-3">{{ tocTitle }}</p>
            <ol class="space-y-2">
              <li v-for="heading in headings" :key="heading.id">
                <a
                  :href="`#${heading.id}`"
                  class="block text-sm text-gray-600 hover:text-brand-600 leading-snug"
                >
                  {{ heading.text }}
                </a>
              </li>
            </ol>
          </nav>
        </aside>
      </div>
    </div>
  </article>
</template>

<script setup>
import InlineText from '@/components/articles/InlineText.vue'
import ArticleFaq from '@/components/articles/ArticleFaq.vue'
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'

const props = defineProps({
  content: {
    type: Array,
    required: true
  }
})

const { t } = useI18n()
const faqTitle = computed(() => t('articles.faqTitle'))
const tocTitle = computed(() => t('articles.toc'))

function headingId(text) {
  return String(text || '')
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '')
    .slice(0, 80)
}

const headings = computed(() => {
  return (props.content || [])
    .filter((block) => block.type === 'h2' && block.text)
    .map((block) => ({
      id: headingId(block.text),
      text: block.text
    }))
})
</script>
