/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
// require('.../css/assets/css/theme-1.css');
require("vue-multiselect/dist/vue-multiselect.min.css");
window.Vue = require('vue');

// import Vue from 'vue';
import VueRouter from 'vue-router';

import swal from 'sweetalert2';

Vue.use(VueRouter);

import ReadMore from 'vue-read-more';
Vue.use(ReadMore);



Vue.filter('snippet', val => {
    if (!val || typeof(val) != 'string') return '';
    val = val.slice(0, 50)
    return val

});
// Vue.component('pagination', require('laravel-vue-pagination'));

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Event
window.Fire = new Vue();

window.swal = swal;

// sweet alert
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// My components
// Vue.component(
//     'post-container',
//     require('./modules/post/PostContainer.vue').default
// );

Vue.component(
    'card-component',
    require('./components/Card.vue').default
);

Vue.component(
    'nav-component',
    require('./components/Nav.vue').default
);

Vue.component(
    'comment-card',
    require('./components/Comment.vue').default
);

// route
let routes = [
    { path: '/create', name: 'create', component: require('./modules/post/PostAdd.vue').default },
    { path: '/edit/:id/:slug', name: 'postedit', component: require('./modules/post/PostEdit.vue').default },
    { path: '/', name: 'home', component: require('./modules/post/PostContainer.vue').default },
    { path: '/post/:id/:slug', name: 'detail', component: require('./modules/post/Detail.vue').default },
    // { path: '/user', component: require('./components/Users.vue').default },
    // { path: '/*', component: require('./components/NotFound.vue').default }

]

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router
});