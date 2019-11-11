import Page404 from '../../pages/errors/Page404.vue'
import Page500 from '../../pages/errors/Page500.vue'


export default  [
    {
        path     : '/error',
        redirect : '/error/404',
        name     : 'Error',
        component: { render (c) { return c('router-view') } },
        children : [
            {
                path     : '404',
                name     : 'Error404',
                component: Page404,
            },
            {
                path     : '500',
                name     : 'Error500',
                component: Page500,
            },
        ],
    },
    {
        path     : '*',
        name     : '404',
        component: Page404,
    },
];
