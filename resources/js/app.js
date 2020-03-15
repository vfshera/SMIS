import './countDown';
import './loader';
import './scrollToTop';
import AOS from 'aos';
import 'aos/dist/aos.css';
import VueRouter from 'vue-router';


AOS.init();

require('./bootstrap');

window.Vue = require('vue');

import {routes} from './route_list.js';

Vue.use(VueRouter);

const router = new VueRouter({
  routes,
   mode:'history'
})


Vue.component('admin', require('./components/AdminHome.vue').default);
Vue.component('sidebar', require('./components/SideBar.vue').default);
Vue.component('notifications', require('./components/Notifications.vue').default);
Vue.component('messages', require('./components/Messages.vue').default);

const app = new Vue({
    el: '#app',
    router
});
