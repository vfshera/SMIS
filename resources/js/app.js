import './countDown';
import './loader';
import './scrollToTop';
import AOS from 'aos';
import 'aos/dist/aos.css';
import VueRouter from 'vue-router';
import Vue from 'vue';
import Swal from 'sweetalert2'




window.Swal = Swal;

require('./bootstrap');

window.Vue = require('vue');

window.Fire = new Vue();

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })


// Vue.use(Swal);

AOS.init();



import {routes} from './route_list.js';

Vue.use(VueRouter);

import store from './store';

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
    router,
    store
});
