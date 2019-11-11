import DemoDashboard from '../../demo/Dashboard.vue';

import Colors from '../../demo/theme/Colors';
import Typography from '../../demo/theme/Typography';

import Charts from '../../demo/Charts';
import Widgets from '../../demo/Widgets';

// Views - Components
import Cards from '../../demo/base/Cards';
import Forms from '../../demo/base/Forms';
import Switches from '../../demo/base/Switches';
import Tables from '../../demo/base/Tables';
import Tabs from '../../demo/base/Tabs';
import Breadcrumbs from '../../demo/base/Breadcrumbs';
import Carousels from '../../demo/base/Carousels';
import Collapses from '../../demo/base/Collapses';
import Jumbotrons from '../../demo/base/Jumbotrons';
import ListGroups from '../../demo/base/ListGroups';
import Navs from '../../demo/base/Navs';
import Navbars from '../../demo/base/Navbars';
import Paginations from '../../demo/base/Paginations';
import Popovers from '../../demo/base/Popovers';
import ProgressBars from '../../demo/base/ProgressBars';
import Tooltips from '../../demo/base/Tooltips';

// Views - Buttons
import StandardButtons from '../../demo/buttons/StandardButtons';
import ButtonGroups from '../../demo/buttons/ButtonGroups';
import Dropdowns from '../../demo/buttons/Dropdowns';
import BrandButtons from '../../demo/buttons/BrandButtons';

// Views - Icons
import Flags from '../../demo/icons/Flags';
import FontAwesome from '../../demo/icons/FontAwesome';
import SimpleLineIcons from '../../demo/icons/SimpleLineIcons';
import CoreUIIcons from '../../demo/icons/CoreUIIcons';

// Views - Notifications
import Alerts from '../../demo/notifications/Alerts';
import Badges from '../../demo/notifications/Badges';
import Modals from '../../demo/notifications/Modals';

// Users
import Users from '../../demo/users/Users';
import User from '../../demo/users/User';


export default  [
    { path: 'demo-dashboard', name: 'DemoDashboard', component: DemoDashboard},
    {
        path: 'demo-theme',
        redirect: '/demo-theme/colors',
        name: 'DemoTheme',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: 'colors',
                name: 'DemoColors',
                component: Colors
            },
            {
                path: 'typography',
                name: 'DemoTypography',
                component: Typography
            }
        ]
    },
    {
        path: 'demo-charts',
        name: 'DemoCharts',
        component: Charts
    },
    {
        path: 'demo-widgets',
        name: 'DemoWidgets',
        component: Widgets
    },
    {
        path: 'demo-users',
        meta: { label: 'Users'},
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: '',
                component: Users,
            },
            {
                path: ':id',
                meta: { label: 'User Details'},
                name: 'DemoUser',
                component: User,
            },
        ]
    },
    {
        path: 'demo-base',
        redirect: '/base/cards',
        name: 'DemoBase',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: 'cards',
                name: 'DemoCards',
                component: Cards
            },
            {
                path: 'forms',
                name: 'DemoForms',
                component: Forms
            },
            {
                path: 'switches',
                name: 'DemoSwitches',
                component: Switches
            },
            {
                path: 'tables',
                name: 'DemoTables',
                component: Tables
            },
            {
                path: 'tabs',
                name: 'DemoTabs',
                component: Tabs
            },
            {
                path: 'breadcrumbs',
                name: 'DemoBreadcrumbs',
                component: Breadcrumbs
            },
            {
                path: 'carousels',
                name: 'DemoCarousels',
                component: Carousels
            },
            {
                path: 'collapses',
                name: 'DemoCollapses',
                component: Collapses
            },
            {
                path: 'jumbotrons',
                name: 'DemoJumbotrons',
                component: Jumbotrons
            },
            {
                path: 'list-groups',
                name: 'DemoList Groups',
                component: ListGroups
            },
            {
                path: 'navs',
                name: 'DemoNavs',
                component: Navs
            },
            {
                path: 'navbars',
                name: 'DemoNavbars',
                component: Navbars
            },
            {
                path: 'paginations',
                name: 'DemoPaginations',
                component: Paginations
            },
            {
                path: 'popovers',
                name: 'DemoPopovers',
                component: Popovers
            },
            {
                path: 'progress-bars',
                name: 'DemoProgress Bars',
                component: ProgressBars
            },
            {
                path: 'tooltips',
                name: 'DemoTooltips',
                component: Tooltips
            }
        ]
    },
    {
        path: 'demo-buttons',
        redirect: '/demo-buttons/standard-buttons',
        name: 'DemoButtons',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: 'standard-buttons',
                name: 'DemoStandard Buttons',
                component: StandardButtons
            },
            {
                path: 'button-groups',
                name: 'DemoButton Groups',
                component: ButtonGroups
            },
            {
                path: 'dropdowns',
                name: 'DemoDropdowns',
                component: Dropdowns
            },
            {
                path: 'brand-buttons',
                name: 'DemoBrand Buttons',
                component: BrandButtons
            }
        ]
    },
    {
        path: 'demo-icons',
        redirect: '/demo-icons/font-awesome',
        name: 'DemoIcons',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: 'coreui-icons',
                name: 'DemoCoreUI Icons',
                component: CoreUIIcons
            },
            {
                path: 'flags',
                name: 'DemoFlags',
                component: Flags
            },
            {
                path: 'font-awesome',
                name: 'DemoFont Awesome',
                component: FontAwesome
            },
            {
                path: 'simple-line-icons',
                name: 'DemoSimple Line Icons',
                component: SimpleLineIcons
            }
        ]
    },
    {
        path: 'demo-notifications',
        redirect: '/demo-notifications/alerts',
        name: 'DemoNotifications',
        component: {
            render (c) { return c('router-view') }
        },
        children: [
            {
                path: 'alerts',
                name: 'DemoAlerts',
                component: Alerts
            },
            {
                path: 'badges',
                name: 'DemoBadges',
                component: Badges
            },
            {
                path: 'modals',
                name: 'DemoModals',
                component: Modals
            }
        ]
    }
];
