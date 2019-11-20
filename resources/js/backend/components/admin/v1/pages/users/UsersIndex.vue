<template>

    <b-row>
        <b-col>
            <transition name="slide">
                <b-card>

                    <div slot="header">
                        <span style="font-size: 20px; font-weight: bold;">{{ usersTable.caption }}</span>
                        <span :class="'badge badge-info'">{{ total }}</span>
                    </div>

                    <b-navbar type="light" variant="light">
                        <div class="row pl-row">
                            <div class="col col-xl-1">
                                <p class="app-label">ID</p>
                                <input class="form-control"
                                       type="number"
                                       :value="usersSearch.id"
                                       @input="filterInput('id', $event.target.value)"
                                       @keydown="startFilter"
                                       style="color: black;">
                                <!--width: 65px;-->
                            </div>

                            <div class="col col-xl-2">
                                <p class="app-label">Фамилия</p>
                                <input class="form-control"
                                       type="text"
                                       :value="usersSearch.last_name"
                                       @input="filterInput('last_name', $event.target.value)"
                                       @keydown="startFilter"
                                       style="color: black;">
                                <!--width: 120px;-->
                            </div>

                            <div class="col col-xl-2">
                                <p class="app-label">Email</p>
                                <input class="form-control"
                                       type="text"
                                       :value="usersSearch.email"
                                       @input="filterInput('email', $event.target.value)"
                                       @keydown="startFilter"
                                       style="color: black;">
                                <!--width: 120px;-->
                            </div>

                            <div class="col col-xl-1">
                                <p class="app-label">Вериф.</p>
                                <select class="form-control" @input="filterInput('is_verified', $event.target.value)">
                                    <option value="0" selected></option>
                                    <option class="badge-success" value="1">Да</option>
                                    <option class="badge-danger" value="2">Нет</option>
                                </select>
                                <!--style="width: 120px;"-->
                            </div>

                            <div class="col col-xl-1">
                                <p class="app-label">Роль</p>
                                <select class="form-control" @input="filterInput('role_id', $event.target.value)">
                                    <option value="0" selected></option>
                                    <option v-for="role in all_roles" :class="'badge-' + role.type" :value="role.id">{{ role.title }}</option>
                                </select>
                                <!--style="width: 120px;"-->
                            </div>

                            <div class="col col-xl-2">
                                <p class="app-label">С (дата создания)</p>
                                <input class="form-control"
                                       type="date"
                                       :value="usersSearch.date_start"
                                       @input="filterInput('date_start', $event.target.value)"
                                       @keydown="startFilter"
                                       style="color: black;">
                                <!--width: 150px;-->
                            </div>

                            <div class="col col-xl-2">
                                <p class="app-label">По (дата создания)</p>
                                <input class="form-control"
                                       type="date"
                                       :value="usersSearch.date_end"
                                       @input="filterInput('date_end', $event.target.value)"
                                       @keydown="startFilter"
                                       style="color: black;">
                                <!--width: 150px;-->
                            </div>

                            <div class="col col-xl-1">
                                <b-button variant="outline-success"
                                          class="my-2 my-sm-0"
                                          style="margin-top: 20px !important; margin-left: 5px;"
                                          @click="usersFilter">
                                    Поиск
                                </b-button>
                            </div>
                        </div>
                    </b-navbar>

                    <app-preloader-table v-if="loading"></app-preloader-table>

                    <b-table :hover="usersTable.hover"
                             :striped="usersTable.striped"
                             :bordered="usersTable.bordered"
                             :small="usersTable.small"
                             :fixed="usersTable.fixed"
                             :items="items"
                             :fields="fields">


                        <template slot="top-row" slot-scope="{ fields }">
                            <td v-for="field in fields" :key="field.key">
                                <div v-if="field.key != 'roles' && field.key != 'actions'" style="margin-top: -7px;margin-bottom: -7px;">
                                    <b-button size="sm" :variant="'outline-' + field.sort_up" @click="changeSort('up', field.key)"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></b-button>
                                    <b-button size="sm" :variant="'outline-' + field.sort_down" @click="changeSort('down', field.key)"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></b-button>
                                </div>
                            </td>
                        </template>

                        <template slot="full_name" slot-scope="data">
                            <strong>{{data.item.full_name}}</strong>
                        </template>

                        <template slot="email" slot-scope="data">
                            {{data.item.email}} <b-badge :variant="data.item.verified">{{data.item.verified_title}}</b-badge>
                        </template>



                        <template slot="roles" slot-scope="data">
                            <span v-for="role in data.item.roles" :class="'badge badge-' + role.type">{{ role.title }}</span>
                        </template>



                        <template slot="actions" slot-scope="data">
                            <div v-if="!data.item.is_admin">
                                <router-link :to="{name: 'UserEdit', params: {id: data.item.id}}" class="btn btn-xs btn-success">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </router-link>
                                <a href="#"
                                   class="btn btn-xs btn-danger"
                                   v-on:click="deleteEntry(data.item.id, data.index)">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        </template>

                    </b-table>

                    <pagination
                        :total-rows="total"
                        :per-page="per_page"
                        :current_page="current_page"
                        @changePagination="changePagination">
                    </pagination>


                </b-card>
            </transition>
        </b-col>
    </b-row>

</template>



<script>
    import Pagination from '../../parts/pagination.vue'
    import {bus} from '../../../../../bus.js';

    export default {

        name: 'Users',

        components: {
            Pagination
        },

        data: function () {
            return {
                items: [],
                fields: [
                    {key: 'id', label: 'ID', sort_up: 'secondary', sort_down: 'secondary'},
                    {key: 'full_name', label: 'ФИО', sort_up: 'secondary', sort_down: 'secondary'},
                    {key: 'email', label: 'Email / Вериф.', sort_up: 'secondary', sort_down: 'secondary'},
                    {key: 'roles', label: 'Роли'},
                    {key: 'created_at', label: 'Дата создания', sort_up: 'secondary', sort_down: 'secondary'},
                    {key: 'actions', label: 'Действия'}
                ],

                current_user: null,
                current_roles: [],

                total: 1,
                current_page: 1,
                per_page: 10,

                usersTable: {
                    caption: 'Пользователи',
                    hover: true,
                    striped: false,
                    bordered: true,
                    small: false,
                    fixed: false
                },

                usersSearch: {
                    id: null,
                    last_name: null,
                    email: null,
                    is_verified: 0,
                    date_start: null,
                    date_end: null,
                },

                sort: {
                    field: null,
                    sort_type: null
                },

                all_roles: null,
                loading: false
            }
        },

        mounted() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;
                var app = this;
                var par = {
                        current_page: this.current_page,
                        count: this.per_page,
                        filter: this.usersSearch,
                        sort: this.sort
                    };

                axios.get('/api/v1/users',{
                        params: {
                            ...par
                        }
                    })
                    .then(function (resp) {
                        app.loading = false;
                        // console.log(resp);
                        app.total = resp['data']['pagination']['total'];
                        app.per_page = resp['data']['pagination']['per_page'];
                        app.current_page = resp['data']['pagination']['current_page'];
                        app.current_user = resp['data']['current_user'];
                        app.current_roles = resp['data']['current_roles'];
                        app.refreshItems(resp['data']['data']['data']);
                        app.all_roles = app.setTypeRole(resp['data']['roles_all'], null);
                        bus.$emit('setmess', {
                            mess: 'Данные загружены',
                            variant: 'info'
                        });
                    })
                    .catch(function (resp) {
                        app.loading = false;
                        console.log(resp.response);
                        bus.$emit('setmess', {
                            mess: 'Ошибка: ' + resp.response.data.message,
                            variant: 'danger'
                        });
                    });
            },

            refreshItems(users){
                this.items = [];
                var row;
                for (var i = 0; i < users.length; i++){
                    row = {};
                    row.id = users[i].id;
                    row.full_name = users[i].last_name + ' ' + users[i].name[0] + '. ' + users[i].patronymic[0] + '.';
                    row.email = users[i].email;
                    row.created_at = users[i].created_at;

                    if(users[i].email_verified_at){
                        row.verified = 'success';
                        row.verified_title = 'Да';
                    } else {
                        row.verified = 'danger';
                        row.verified_title = 'Нет';
                    }

                    row.roles = this.setTypeRole(users[i].roles, row);
                    row.is_admin = this.setIsAdmin(users[i].roles, row);

                    this.items.push(row);
                }
            },


            setTypeRole(roles, row){
                for(var r = 0; r < roles.length; r++){
                    roles[r]['type'] = 'warning';
                    switch (roles[r]['id']) {
                        case 1: roles[r]['type'] = 'success'; break;
                        case 2: roles[r]['type'] = 'success'; break;
                        case 3: roles[r]['type'] = 'secondary'; break;
                        case 4: roles[r]['type'] = 'info'; break;
                        case 5: roles[r]['type'] = 'danger'; if(row) row._rowVariant = 'danger'; break;
                    }
                }
                return roles;
            },


            setIsAdmin(roles, row){
                for(var i = 0; i < this.current_roles.length; i++){
                    if (this.current_roles[i]['id'] == 1){
                        return false;
                    }
                }


                var is_admin = false;
                for(var r = 0; r < roles.length; r++){
                    switch (roles[r]['id']) {
                        case 1: is_admin = true; break;
                        case 2:
                            if(row.id != this.current_user.id) is_admin = true;
                            break;
                    }
                }
                return is_admin;
            },


            filterInput(field, value){
                if (value === '') value = null;
                this.usersSearch[field] = value
            },

            startFilter(e){
                if (e.keyCode === 13) {
                    this.usersFilter();
                }
            },

            usersFilter(){
                // console.log(this.usersSearch);
                this.current_page = 1;
                this.loadData();
            },


            changePagination(pag){
                this.current_page = pag.current_page;
                this.per_page = pag.per_page;
                this.loadData();
            },


            changeSort(sort_type, field){
                this.sort.field = null;
                this.sort.sort_type = null;

                for(var i = 0; i < this.fields.length; i++){
                    this.fields[i].sort_down = 'secondary';
                    this.fields[i].sort_up = 'secondary';
                }

                if(sort_type == 'down'){
                    for(var i = 0; i < this.fields.length; i++){
                        if(this.fields[i].key == field) {
                            this.fields[i].sort_down = 'primary';
                            break;
                        }
                    }
                    this.sort.field = field;
                    this.sort.sort_type = sort_type;
                    this.loadData();

                } else if(sort_type == 'up'){
                    for(var i = 0; i < this.fields.length; i++){
                        if(this.fields[i].key == field) {
                            this.fields[i].sort_up = 'primary';
                            break;
                        }
                    }
                    this.fields.sort_up = 'primary';
                    this.sort.field = field;
                    this.sort.sort_type = sort_type;
                    this.loadData();
                }
            },

            deleteEntry(id, index) {
                if (confirm("Вы действительно хотите удалить пользователя?")) {
                    var app = this;
                    axios.delete('/api/v1/users/' + id)
                        .then(function (resp) {
                            // app.users.splice(index, 1);
                            app.loadData();
                        })
                        .catch(function (resp) {
                            console.log("Не удалось удалить пользователя");
                        });
                }
            }
        }
    }
</script>



<style scoped>
    .badge {
        padding: 5px;
        margin-right: 5px;
    }
    .app-label {
        margin-left: 5px;
        margin-bottom: 0;
    }
    .pl-row{
        margin-left: 0px;
        margin-right: 0px;
        width: 100%;
    }
    .pl-row .col {
        padding-left: 1px;
        padding-right: 1px;
    }
</style>