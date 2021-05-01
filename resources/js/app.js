/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router'
import Vuetify from 'vuetify'
import "vuetify/dist/vuetify.min.css";


window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify)


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
});

const Router = [
    { path: '/admin', component: Admin },
    { path: '/place', component: Place },
    { path: '/photo-display', component: PhotoDisplay }
  ]