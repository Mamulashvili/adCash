// Default view
import dashboard from '@pages/dashboard.vue';

// Lazy loading
const userList = () =>
  import(/* webpackChunkName: "user-list" */ '@pages/UserList.vue');

const userAdd = () =>
  import(/* webpackChunkName: "user-add" */ '@pages/UserAdd.vue');

const stockList = () =>
  import(/* webpackChunkName: "stock-list" */ '@pages/StocksList.vue');

const stockAdd = () =>
  import(/* webpackChunkName: "stock-add" */ '@pages/StockAdd.vue');

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: dashboard,
    icon: 'menu'
  },
  {
    path: '/user-list',
    name: 'Users list',
    component: userList,
    icon: 'group'
  },
  {
    path: '/user-add',
    name: 'Add user',
    component: userAdd,
    icon: 'add-user'
  },
  {
    path: '/stock-list',
    name: 'Stocks list',
    component: stockList,
    icon: 'clipboard'
  },
  {
    path: '/stock-add',
    name: 'Add stock',
    component: stockAdd,
    icon: 'add'
  },
];

export default routes;