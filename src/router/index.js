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
          import(/* webpackChunkName: "dashboard" */ '@/views/dashboard/Dashboard.vue'),
      },
      {
        path: '/liste',
        name: 'Liste des pc',
        component: () => import(/* webpackChunkName: "liste" */ '@/views/dashboard/Liste.vue'),
        children: [
          {
            path: 'consultation/:id',
            name: 'Consultation',
            component: () =>
              import(/* webpackChunkName: "consultation" */ '@/views/dashboard/Consultation.vue'),
          },
        ],
      },
      {
        path: '/support',
        name: 'Système de support',
        component: () => import(/* webpackChunkName: "liste" */ '@/views/support/ListeTicket.vue'),
        children: [
          {
            path: 'create',
            name: 'Créer un ticket de support',
            component: () =>
              import(/* webpackChunkName: "consultation" */ '@/views/support/CreateTicket.vue'),
          },
        ],
      },
    ],
  },
  {
    path: '/login',
    name: 'Connexion | TrackIT',
    component: () => import(/* webpackChunkName: "login" */ '@/views/pages/Login.vue'),
  },
]

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior() {
    return { top: 0 }
  },
})

// Middleware global pour éviter les redirections automatiques
router.beforeEach((to, from, next) => {
  const isAuthenticated = false // Remplacez par votre logique d'authentification réelle
  if (to.name === 'Connexion | TrackIT') {
    next() // Autorise l'accès à la page de connexion
  } else if (!isAuthenticated) {
    next({ name: 'Connexion | TrackIT' }) // Redirige les utilisateurs non authentifiés vers /login
  } else {
    next() // Autorise toutes les autres routes
  }
})

export default router