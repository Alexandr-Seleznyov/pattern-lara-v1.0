import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../components/admin/v1/dashboard/DashboardLayout.vue';

// Containers
// import Full from '@/containers/Full'
// import Full from '@/containers/Full'
import Full from '../coreui/containers/Full'

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
        component: Full,
        children : [
            {
                path     : 'dashboard',
                name     : 'Dashboard',
                component: Dashboard,
            },
            ...users,
            ...errors
        ],
    },
];


export default new Router({
    mode           : 'history',
    linkActiveClass: 'open active',
    scrollBehavior : () => ({ y: 0 }),
    routes         : routes,
})