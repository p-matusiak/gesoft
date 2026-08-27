<template>
  <section v-if="projects.length" class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
          <h2 class="text-2xl font-bold text-gray-900">{{ title }}</h2>
          <p v-if="subtitle" class="text-gray-600 mt-2 max-w-2xl">{{ subtitle }}</p>
        </div>
        <router-link :to="allTo" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
          {{ allLabel }}
        </router-link>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <ProjectCard
          v-for="project in projects"
          :key="project.key"
          :project="project"
          :title="project.title"
          :description="project.description"
          :category-label="project.categoryLabel"
          :to="'/portfolio/' + project.key"
          compact
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import ProjectCard from '@/components/common/ProjectCard.vue'

defineProps({
  projects: {
    type: Array,
    default: () => []
  },
  title: {
    type: String,
    required: true
  },
  subtitle: {
    type: String,
    default: ''
  },
  allLabel: {
    type: String,
    required: true
  },
  allTo: {
    type: String,
    default: '/portfolio'
  }
})
</script>
