/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
//import routes from './routes';
import vRouter from './routes';

Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('about-component', require('./components/About.vue').default);
Vue.component('products-component', require('./components/Products.vue').default);

Vue.component('register-component', require('./components/Register.vue').default);
Vue.component('login-component', require('./components/Login.vue').default);


Vue.component('notfound-component', require('./components/NotFound.vue').default);
Vue.component('main-component', require('./components/Main.vue').default);
Vue.component('leftsidebar-component', require('./components/LeftSidebar.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);

Vue.component('users-component', require('./components/Users.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//const vueRouter = new VueRouter(routes);
const app = new Vue({
    el: '#app',
    // router:new VueRouter(routes),
    //router: vueRouter
    router: vRouter
});


// $(document).ready(function() {
//     $('#myTable').DataTable();
//     });
