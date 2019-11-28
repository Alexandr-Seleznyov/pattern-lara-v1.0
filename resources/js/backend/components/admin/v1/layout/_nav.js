// --------------------------------------------------------------------
// DEMO
// --------------------------------------------------------------------
var demo = [
    {
        title: true,
        name: '-------- DEMO --------',
        class: '',
        wrapper: {
            element: '',
            attributes: {}
        }
    },
    {
        name: 'Dashboard',
        url: '/admin/demo-dashboard',
        icon: 'icon-speedometer',
        badge: {
            variant: 'primary',
            text: 'NEW'
        }
    },
    {
        name: 'Users',
        url: '/admin/demo-users',
        // icon: 'icon-speedometer',
    },
    {
        title: true,
        name: 'Theme',
        class: '',
        wrapper: {
            element: '',
            attributes: {}
        }
    },
    {
        name: 'Colors',
        url: '/admin/demo-theme/colors',
        icon: 'icon-drop'
    },
    {
        name: 'Typography',
        url: '/admin/demo-theme/typography',
        icon: 'icon-pencil'
    },
    {
        title: true,
        name: 'Components',
        class: '',
        wrapper: {
            element: '',
            attributes: {}
        }
    },
    {
        name: 'Base',
        url: '/admin/demo-base',
        icon: 'icon-puzzle',
        children: [
            {
                name: 'Breadcrumbs',
                url: '/admin/demo-base/breadcrumbs',
                icon: 'icon-puzzle'
            },
            {
                name: 'Cards',
                url: '/admin/demo-base/cards',
                icon: 'icon-puzzle'
            },
            {
                name: 'Carousels',
                url: '/admin/demo-base/carousels',
                icon: 'icon-puzzle'
            },
            {
                name: 'Collapses',
                url: '/admin/demo-base/collapses',
                icon: 'icon-puzzle'
            },
            {
                name: 'Forms',
                url: '/admin/demo-base/forms',
                icon: 'icon-puzzle'
            },
            {
                name: 'Jumbotrons',
                url: '/admin/demo-base/jumbotrons',
                icon: 'icon-puzzle'
            },
            {
                name: 'List Groups',
                url: '/admin/demo-list-groups',
                icon: 'icon-puzzle'
            },
            {
                name: 'Navs',
                url: '/admin/demo-base/navs',
                icon: 'icon-puzzle'
            },
            {
                name: 'Navbars',
                url: '/admin/demo-base/navbars',
                icon: 'icon-puzzle'
            },
            {
                name: 'Paginations',
                url: '/admin/demo-base/paginations',
                icon: 'icon-puzzle'
            },
            {
                name: 'Popovers',
                url: '/admin/demo-base/popovers',
                icon: 'icon-puzzle'
            },
            {
                name: 'Progress Bars',
                url: '/admin/demo-base/progress-bars',
                icon: 'icon-puzzle'
            },
            {
                name: 'Switches',
                url: '/admin/demo-base/switches',
                icon: 'icon-puzzle'
            },
            {
                name: 'Tables',
                url: '/admin/demo-base/tables',
                icon: 'icon-puzzle'
            },
            {
                name: 'Tabs',
                url: '/admin/demo-base/tabs',
                icon: 'icon-puzzle'
            },
            {
                name: 'Tooltips',
                url: '/admin/demo-base/tooltips',
                icon: 'icon-puzzle'
            }
        ]
    },
    {
        name: 'Buttons',
        url: '/admin/demo-buttons',
        icon: 'icon-cursor',
        children: [
            {
                name: 'Buttons',
                url: '/admin/demo-buttons/standard-buttons',
                icon: 'icon-cursor'
            },
            {
                name: 'Button Dropdowns',
                url: '/admin/demo-buttons/dropdowns',
                icon: 'icon-cursor'
            },
            {
                name: 'Button Groups',
                url: '/admin/demo-buttons/button-groups',
                icon: 'icon-cursor'
            },
            {
                name: 'Brand Buttons',
                url: '/admin/demo-buttons/brand-buttons',
                icon: 'icon-cursor'
            }
        ]
    },
    {
        name: 'Charts',
        url: '/admin/demo-charts',
        icon: 'icon-pie-chart'
    },
    {
        name: 'Icons',
        url: '/admin/demo-icons',
        icon: 'icon-star',
        children: [
            {
                name: 'CoreUI Icons',
                url: '/admin/demo-icons/coreui-icons',
                icon: 'icon-star',
                badge: {
                    variant: 'info',
                    text: 'NEW'
                }
            },
            {
                name: 'Flags',
                url: '/admin/demo-icons/flags',
                icon: 'icon-star'
            },
            {
                name: 'Font Awesome',
                url: '/admin/demo-icons/font-awesome',
                icon: 'icon-star',
                badge: {
                    variant: 'secondary',
                    text: '4.7'
                }
            },
            {
                name: 'Simple Line Icons',
                url: '/admin/demo-icons/simple-line-icons',
                icon: 'icon-star'
            }
        ]
    },
    {
        name: 'Notifications',
        url: '/admin/demo-notifications',
        icon: 'icon-bell',
        children: [
            {
                name: 'Alerts',
                url: '/admin/demo-notifications/alerts',
                icon: 'icon-bell'
            },
            {
                name: 'Badges',
                url: '/admin/demo-notifications/badges',
                icon: 'icon-bell'
            },
            {
                name: 'Modals',
                url: '/admin/demo-notifications/modals',
                icon: 'icon-bell'
            }
        ]
    },
    {
        name: 'Widgets',
        url: '/admin/demo-widgets',
        icon: 'icon-calculator',
        badge: {
            variant: 'primary',
            text: 'NEW'
        }
    },
    {
        divider: true
    },
    {
        title: true,
        name: 'Extras'
    },
    // {
    //   name: 'Pages',
    //   url: '/admin/demo-pages',
    //   icon: 'icon-star',
    //   children: [
    //     {
    //       name: 'Login',
    //       url: '/admin/demo-pages/login',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Register',
    //       url: '/admin/demo-pages/register',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Error 404',
    //       url: '/admin/demo-pages/404',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Error 500',
    //       url: '/admin/demo-pages/500',
    //       icon: 'icon-star'
    //     }
    //   ]
    // },
    {
        name: 'Disabled',
        url: '/admin/dashboard',
        icon: 'icon-ban',
        badge: {
            variant: 'secondary',
            text: 'NEW'
        },
        attributes: { disabled: true },
    },
    {
        name: 'Download CoreUI',
        url: 'http://coreui.io/vue/',
        icon: 'icon-cloud-download',
        class: 'mt-auto',
        variant: 'success',
        attributes: { target: '_blank', rel: 'noopener' }
    },
    {
        name: 'Try CoreUI PRO',
        url: 'http://coreui.io/pro/vue/',
        icon: 'icon-layers',
        variant: 'danger',
        attributes: { target: '_blank', rel: 'noopener' }
    },
];


// --------------------------------------------------------------------
// USERS
// --------------------------------------------------------------------
var users = [
        {
            title: true,
            name: 'Administration',
            class: '',
        },
        {
            name: 'Users',
            url: '/admin/users',
            icon: 'fa fa-users',
        },
    ];


// --------------------------------------------------------------------
// Laravel file manager - demo
// --------------------------------------------------------------------
var lfm = [
    {
        title: true,
        name: 'Laravel File Manager',
        class: '',
    },
    {
        name: 'LFM - component',
        url: '/admin/lfm',
        icon: 'fa fa-file-o',
    },

    {
        name: 'Demo - LFM',
        url: '/admin/demo-lfm',
        icon: 'fa fa-file-o',
    },
];







export default {
  items: [
    {
      name: 'Dashboard',
      url: '/admin/dashboard',
      icon: 'icon-speedometer',
    },

      ...users,
      ...lfm,
      //...demo,
  ]
}
