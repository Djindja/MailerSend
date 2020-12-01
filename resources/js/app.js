require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Index from './views/index.vue'
import singleEmail from './views/singleEmail.vue'
import listEmails from './views/list.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
    {
        path: '/mails',
        name: 'list',
        component: listEmails
        },
      {
        path: '/mails/:mailId',
        name: 'single',
        component: singleEmail
      }
    ]
})

const app = new Vue({
    el: '#app',
    router,
    components: { Index }
});