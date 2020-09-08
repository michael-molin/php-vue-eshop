/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';                                                          //importo Vue dal node.js vue
import VueCarousel from 'vue-carousel';                                         //importo il carosello da vue-carousel
import store from "./store";                                                    // file per passare i dati ai component fratelli

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('welcome-component', require('./components/WelcomeComponent.vue').default);
Vue.component('welcome-component-cart', require('./components/WelcomeComponentCart.vue').default);
Vue.component('welcome-component-admin', require('./components/WelcomeComponentAdmin.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);
Vue.use(VueCarousel);
Vue.prototype.$userId = document.querySelector("meta[name='user_id']").getAttribute('content'); // invio la lo userId dell utente loggato
//Definisco i componenti creati e utilizzo tramito use quelli già pre-impostati
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  * /

const app = new Vue({
    store,
    el: '#app',
});
