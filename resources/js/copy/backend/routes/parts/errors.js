import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'


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
