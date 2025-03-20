import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/DashboardView.vue'),
    },
    {
      path: '/lead',
      name: 'lead',
      children: [
        {
          path: 'lead-list',
          component: () => import('../views/LeadListView.vue'),
          meta: {requiresAuth: true}
        },
        {
          path: 'lead-request',
          component: () => import('../views/LeadRequestView.vue'),
        },
      ],
    },
    {
      path: '/auth',
      name: 'auth',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AuthView.vue')
    }
  ],
})

export default router
