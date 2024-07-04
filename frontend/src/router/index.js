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
      name: 'Acesso',
      component: () => import("@/views/Login.vue"),
      meta: { title: "Acesso" },
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || "Vue";
  next();
});

export default router;
