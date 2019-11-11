import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../pages/DashboardLayout.vue';
import DefaultContainer from '../layout/DefaultContainer.vue';


// Demo
//import DemoDashboard from '../demo/Dashboard.vue';
import demo from './parts/demo.js'

// Pages route
import users from './parts/users.js'

// Errors errors
import errors from './parts/errors.js'

Vue.use(Router)

const routes = [
    {
        path: '/admin',
        redirect : '/admin/dashboard',
        name     : 'Home',
        component: DefaultContainer,
        children : [
            {
                path     : 'dashboard',
                name     : 'Dashboard',
                component: Dashboard,
            },

            ...users,

            ...demo,

            ...errors,
        ],
    },
];


export default new Router({
    mode           : 'history',
    linkActiveClass: 'open active',
    scrollBehavior : () => ({ y: 0 }),
    routes         : routes,
})