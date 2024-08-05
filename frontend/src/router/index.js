import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/register',
      name: 'Cadastro',
      component: () => import("@/views/Register.vue"),
      meta: { title: "Registrar-se"},
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import("@/views/Login.vue"),
      meta: { title: "Acesso" },
    },
    {
      path: '/reset_password',
      name: 'Recuperar Senha',
      component: () => import("@/views/ResetPassword.vue"),
      meta: { title: "Recuperar Senha" },
    },
    {
      path: '/dashboard/:id',
      name: 'Dashboard',
      component: () => import("@/views/Dashboard.vue"),
      meta: { title: "Dashboard", requiresAuth: true },
    },
    {
      path: '/stage/:id',
      name: 'Etapas',
      component: () => import("../views/Stages.vue"),
      meta: { title: "Etapas", requiresAuth: true },
    },
    {
      path: '/home',
      name: 'Home',
      component:() => import("../views/Home.vue"),
      meta: {title: "Home"},
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: () => import('../views/NotFound.vue'),
      meta: { title: "404 - Page Not Found" },
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || "Vue";
  
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const token = localStorage.getItem('token')
    if (!token) {
      next({ name: 'NotFound' })
    } else {
      next()
    }
  } else {
    next()
  }
});

export default router;
