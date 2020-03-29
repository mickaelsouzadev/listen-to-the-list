/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vuex from 'vuex'
Vue.use(Vuex)

import storeData from "./store/index"

import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules'

extend('email', {
	...email,
	message: 'Email inválido'
});

extend('required', {
  ...required,
  message: 'Esse campo é obrigatório'
});


const store = new Vuex.Store(
   storeData
)

const token = localStorage.getItem('token');

if (token) {
    axios.defaults.headers.common['Authorization'] = token
}

Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('albums-component', require('./components/AlbumsComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('validation', ValidationProvider);
Vue.component('observer', ValidationObserver);

import { routes } from './routes';

//Register Routes
const router = new VueRouter({
    routes, 
    mode: 'history',

})

console.log(router)

const app = new Vue({
    el: '#app',
    router,
    store,
});
