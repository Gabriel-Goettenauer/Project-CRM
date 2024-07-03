import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/register',
      name: 'Registrar-se',
      component: () => import("@/views/Register.vue"),
      meta: { title: "Registrar-se"},
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || "Vue";
  next();
});

export default router;
