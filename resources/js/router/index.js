import { createRouter, createWebHashHistory } from 'vue-router';
import routes from './routes';
import dashboard from '@pages/dashboard.vue';

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    ...routes,
    {
      path: '/:pathMatch(.*)',
      component: () => dashboard
    },
  ]
});

export default router;