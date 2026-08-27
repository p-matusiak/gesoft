import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/HomeView.vue'),
    meta: { title: 'GESOFT - Strony i aplikacje webowe' }
  },
  {
    path: '/o-nas',
    name: 'about',
    component: () => import('@/views/AboutView.vue'),
    meta: { title: 'O nas - GESOFT' }
  },
  {
    path: '/uslugi',
    name: 'services',
    component: () => import('@/views/ServicesView.vue'),
    meta: { title: 'Usługi - GESOFT' }
  },
  {
    path: '/technologie',
    name: 'technologies',
    component: () => import('@/views/TechnologiesView.vue'),
    meta: { title: 'Technologie - GESOFT' }
  },
  {
    path: '/portfolio',
    name: 'portfolio',
    component: () => import('@/views/PortfolioView.vue'),
    meta: { title: 'Inspiracje - GESOFT' }
  },
  {
    path: '/portfolio/:key',
    name: 'inspiration',
    component: () => import('@/views/InspirationView.vue'),
    meta: { title: 'Inspiracje - GESOFT' }
  },
  {
    path: '/kontakt',
    name: 'contact',
    component: () => import('@/views/ContactView.vue'),
    meta: { title: 'Kontakt - GESOFT' }
  },
  {
    path: '/artykuly',
    name: 'articles',
    component: () => import('@/views/ArticlesView.vue'),
    meta: { title: 'Artykuły - GESOFT' }
  },
  {
    path: '/artykuly/:slug',
    name: 'article',
    component: () => import('@/views/ArticleView.vue'),
    meta: { title: 'Artykuł - GESOFT' }
  },
  {
    path: '/admin',
    name: 'admin-login',
    component: () => import('@/views/admin/LoginView.vue'),
    meta: { title: 'Logowanie - Panel Admina' }
  },
  {
    path: '/admin/dashboard',
    name: 'admin-dashboard',
    component: () => import('@/views/admin/DashboardView.vue'),
    meta: { title: 'Dashboard - Panel Admina', requiresAuth: true }
  },
  {
    path: '/admin/requests',
    name: 'admin-requests',
    component: () => import('@/views/admin/RequestsView.vue'),
    meta: { title: 'Zapytania - Panel Admina', requiresAuth: true }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('@/views/NotFoundView.vue'),
    meta: { title: '404 - Strona nie znaleziona | GESOFT' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    return { top: 0 }
  }
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'GESOFT'

  if (to.meta.requiresAuth) {
    const authStore = useAuthStore()
    if (!authStore.isAuthenticated) {
      next({ name: 'admin-login' })
      return
    }
  }

  next()
})

export default router
