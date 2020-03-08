import './countDown';
import './loader';
import './scrollToTop';
import AOS from 'aos';
import 'aos/dist/aos.css';
import VueRouter from 'vue-router';


AOS.init();

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter)

import {routes} from './route_list.js';


const router = new VueRouter({
  routes,
   mode:'history'
})


Vue.component('admin', require('./components/AdminHome.vue').default);


const app = new Vue({
    el: '#app',
    router
});
