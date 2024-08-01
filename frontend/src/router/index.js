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
      path: '/dashboard',
      name: 'Dashboard',
      component: () => import("@/views/Dashboard.vue"),
      meta: { title: "Dashboard" },
    },
    {
      path: '/stage/:id',
      name: 'Etapas',
      component: () => import("../views/Stages.vue"),
      meta: { title: "Etapas" },
    },
    // {
    // path: '/stage/',
    // name: 'Etapas',
    // component: () => import("../views/Stages.vue"),
    // meta: { title: "Etapas" },
    // },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || "Vue";
  next();
});

export default router;
