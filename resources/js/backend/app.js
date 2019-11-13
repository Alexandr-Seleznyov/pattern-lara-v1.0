/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import router from './components/admin/v1/routes/routes.js';
import BootstrapVue from 'bootstrap-vue';
import App from './components/admin/v1/layout/App.vue';
import PreloaderTable from './components/admin/v1/parts/PreloaderTable';
import Messager from './components/admin/v1/parts/Messager.vue';
// import Bus from 'bus.js';


window.Vue.use(VueRouter);
window.Vue.use(BootstrapVue);
// window.Vue.use(Bus);

Vue.component('app-preloader-table', PreloaderTable);
Vue.component('messager', Messager);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Vue.component('pagination', require('laravel-vue-pagination'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     'app',
//     require('./components/admin/v1/layout/App.vue').default
// );

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

// bus.js (создаем общую шину и экспортируем)
// export const bus = new Vue();

const vm = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: {
        App
    }
});
