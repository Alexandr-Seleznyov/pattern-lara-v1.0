import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import Datepicker from 'vuejs-datepicker';
import { id } from 'vuejs-datepicker/dist/locale';
import Notifications from 'vue-notification';
import Sweetalert from 'vue-sweetalert2';
import Vuelidate from 'vuelidate';
import Loading from './coreui/components/Loading';
import Select2 from './coreui/components/Select';

import App from './coreui/App';
// Vue.component('App', require('./coreui/App').default);

import router from './routes/routes';
import store from "./coreui/store";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import './coreui/main.js'

// window.Vue = require('vue');
// import VueRouter from 'vue-router';
//
// window.Vue.use(VueRouter);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('app', require('./components/admin/v1/layout/App.vue').default);
// Vue.component('header', require('./components/admin/v1/layout/Header.vue').default);

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

Vue.use(BootstrapVue);
Vue.use(Notifications);
Vue.use(Sweetalert);
Vue.use(Vuelidate);

Vue.filter('state', (value, dirtyOnly = true) => {
    if (dirtyOnly) {
        if (!value.$dirty)
            return null
    }

    return !value.$invalid ? 'valid' : 'invalid'
})

Vue.component('b-loading', Loading);
Vue.component('b-select-2', Select2);
Vue.component('b-datepicker', {
    extends: Datepicker,
    props  : {
        bootstrapStyling: {
            type   : Boolean,
            default: true,
        },
        language: {
            type   : Object,
            default: () => id,
        },
    },
});



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el        : '#app',
//     router    : router,
//     store     : store,
//     components: { App },
//     template  : '<App/>',
// });

Vue.component(
    'app',
    require('./coreui/App').default
);

const app = new Vue({
    el        : '#app',
    router    : router,
    // store     : store,
    // components: { App },
    // template  : '<App/>',
});

// const app = new Vue({
//     el        : '#app',
//     router    : router,
//     // store     : store,
//     // components: { App },
//     // template  : '<App/>',
// });

// const app = new Vue({
//     router    : router,
//     store     : store,
//     components: { App },
//     template  : '<App/>',
// }).$mount('#app')


// export default new Vue({
//     el        : '#app',
//     router    : router,
//     store     : store,
//     components: { App },
//     template  : '<App/>',
// })


// new Vue({
//     el: '#app',
//     render: h => h(App),
//     router,
//     store
// })

// new Vue({
//     ...App, // ES7 Object rest spread operator (or Object.assign)
//     router,
//     store
// }).$mount('#app');
