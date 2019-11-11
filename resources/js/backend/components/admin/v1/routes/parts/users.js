import UsersIndex from '../../pages/users/UsersIndex.vue';
import UsersCreate from '../../pages/users/UsersCreate.vue';
import UsersEdit from '../../pages/users/UsersEdit.vue';


export default  [
    { path: 'users', component: UsersIndex, name: 'Users' },
    { path: 'users/create', component: UsersCreate, name: 'UserCreate' },
    { path: 'users/edit/:id', component: UsersEdit, name: 'UserEdit' },
];
