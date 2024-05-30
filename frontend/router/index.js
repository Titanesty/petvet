import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes.js';

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from) {
    if (to.path === '/services' && to.query.section) {
      return;
    }
    return { top: 0 };
  },
});

router.beforeEach((to, from, next) => {
  const accessToken = localStorage.getItem('access_token');
  if (accessToken) {
    if (to.path === '/sign-in' || to.path === '/sign-up') {
      next({ path: '/login' });
    } else next();
  } else {
    if (to.path === '/login') {
      next({ path: '/sign-in' });
    } else {
      next();
    }
  }
});

export default router;
