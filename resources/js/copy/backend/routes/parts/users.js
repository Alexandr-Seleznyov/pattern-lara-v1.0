import UsersIndex from '../../components/admin/v1/users/UsersIndex.vue';
import UsersCreate from '../../components/admin/v1/users/UsersCreate.vue';
import UsersEdit from '../../components/admin/v1/users/UsersEdit.vue';


export default  [
    { path: '/users', component: UsersIndex, name: 'usersIndex' },
    { path: '/users/create', component: UsersCreate, name: 'usersCreate' },
    { path: '/users/edit/:id', component: UsersEdit, name: 'usersEdit' },
];
