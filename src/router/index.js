import { createRouter, createWebHashHistory } from 'vue-router'

import DefaultLayout from '@/layouts/DefaultLayout'

const routes = [
  {
    path: '/',
    name: 'Accueil',
    component: DefaultLayout,
    redirect: '/dashboard',
    children: [
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: () =>
          import(
            /* webpackChunkName: "dashboard" */ '@/views/dashboard/Dashboard.vue'
          ),
      },
      {
        path: '/consultation',
        name: 'Consultation',
        component: () =>
          import(
            /* webpackChunkName: "consultation" */ '@/views/dashboard/Consultation.vue'
          ),
      },
      {
        path: '/liste',
        name: 'Liste des pc',
        component: () =>
          import(
            /* webpackChunkName: "liste" */ '@/views/dashboard/Liste.vue'
          ),
        children: [
          {
            path: 'consultation',
            name: 'Consultation',
            component: () =>
              import(
                /* webpackChunkName: "consultation" */ '@/views/dashboard/Consultation.vue'
              ),
          }
        ]
      }
    ],
  },
  
]

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior() {
    return { top: 0 }
  },
})

export default router
