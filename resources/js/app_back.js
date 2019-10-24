/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import DashboardLayout from './components/layout/DashboardLayout.vue'
// import DashboardLayout from './components/api/v1/DashboardLayout.vue';
import App from './components/App.vue'
import UsersIndex from './components/api/v1/users/UsersIndex.vue';
import UsersCreate from './components/api/v1/users/UsersCreate.vue';
import UsersEdit from './components/api/v1/users/UsersEdit.vue';

import Test from './components/Test.vue';

const routes = [
    {
        path: '/test',
        components: {
            UsersIndex: UsersIndex
        }
    },
    {
        path: '/admin',
        components: {
            UsersIndex: UsersIndex
        }
    },
    // { path: '/admin', components: DashboardLayout, name: 'admin' },
    // { path: '/admin', components: { usersIndex: UsersIndex }, name: 'users' },
    // // { path: '/admin', components: { dashboardLayout: DashboardLayout }, name: 'dashboardLayout' },
    // { path: '/admin/users', components: { usersIndex: UsersIndex }, name: 'users' },
    // { path: '/admin/users/create', component: UsersCreate, name: 'usersCreate' },
    // { path: '/admin/users/edit/:id', component: UsersEdit, name: 'usersEdit' },
];

const router = new VueRouter({
    routes,
    mode: 'history', //removes # (hashtag) from url
    fallback: true, //router should fallback to hash (#) mode when the browser does not support history.pushState
});

// const router = new VueRouter({ routes });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     'example-component',
//     require('./components/ExampleComponent.vue').default
// );
//
//
// Vue.component(
//     'passport-clients',
//     require('./components/passport/Clients.vue').default
// );
//
// Vue.component(
//     'passport-authorized-clients',
//     require('./components/passport/AuthorizedClients.vue').default
// );
//
// Vue.component(
//     'passport-personal-access-tokens',
//     require('./components/passport/PersonalAccessTokens.vue').default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

const app = new Vue({
    router
}).$mount('#app');

// const app = new Vue({
//     el: '#app',
//     router
// });

// new Vue({
//     el: '#app',
//     render: h => h(App),
//     router
//     // store
// })