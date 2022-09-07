require('./bootstrap');

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import directives from './directives/OutsideClickDir';


createApp(App)
  .use(router)
  .use(directives)
  .mount('#app');