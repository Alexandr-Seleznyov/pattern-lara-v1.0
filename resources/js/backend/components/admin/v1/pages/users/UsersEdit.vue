<template>
    <b-row>
        <b-col>
            <app-preloader-table v-if="loading"></app-preloader-table>
            <transition name="slide">
                <b-card>
                    <div slot="header">
                        <span style="font-size: 20px; font-weight: bold;">Пользователь:</span>
                        <span style="font-size: 18px;">{{ title_name }}</span>
                    </div>

                    <b-card style="padding: 10px;">
                            <form v-on:submit="saveForm()">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="user-last_name">Фамилия</label>
                                        <input type="text" :class="'form-control' + (err.last_name ? ' is-invalid' : '')" id="user-last_name" placeholder="Фамилия" v-model="user.last_name">
                                        <div class="invalid-feedback" v-if="err.last_name">
                                            {{ err.last_name[0] }}
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="user-name">Имя</label>
                                        <input type="text" :class="'form-control' + (err.name ? ' is-invalid' : '')" id="user-name" placeholder="Имя" v-model="user.name">
                                        <div class="invalid-feedback" v-if="err.name">
                                            {{ err.name[0] }}
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="user-patronymic">Отчество</label>
                                        <input type="text" :class="'form-control' + (err.patronymic ? ' is-invalid' : '')" id="user-patronymic" placeholder="Отчество" v-model="user.patronymic">
                                        <div class="invalid-feedback" v-if="err.patronymic">
                                            {{ err.patronymic[0] }}
                                        </div>
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="user-email">Email</label>
                                        <input type="email" :class="'form-control' + (err.email ? ' is-invalid' : '')" id="user-email" placeholder="Email" v-model="user.email">
                                        <div class="invalid-feedback" v-if="err.email">
                                            {{ err.email[0] }}
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="user-date_birthday">Дата рождения</label>
                                        <input type="date" :class="'form-control' + (err.date_birthday ? ' is-invalid' : '')" id="user-date_birthday" placeholder="Дата рождения" v-model="user.date_birthday">
                                        <div class="invalid-feedback" v-if="err.date_birthday">
                                            {{ err.date_birthday[0] }}
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="user-gender">Пол</label>
                                        <br>
                                        <select v-model="user.gender" class="custom-select" id="user-gender">
                                            <option value=""></option>
                                            <option value="male">М</option>
                                            <option value="female">Ж</option>
                                        </select>
                                        <div class="invalid-feedback" v-if="err.gender">
                                            {{ err.gender[0] }}
                                        </div>
                                        <br>
                                    </div>
                                </div>


                                <b-navbar type="light" variant="light">
                                    <button type="button" class="btn btn-warning" style="margin: 10px;"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Отмена</button>
                                    <button type="submit" class="btn btn-success" style="margin: 10px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Сохранить</button>
                                    <!--<router-link :to="{name: 'Users'}" class="btn btn-info"><i class="nav-icon fa fa-users"></i> Все пользователи</router-link>-->
                                </b-navbar>

                            </form>
                    </b-card>

                </b-card>
            </transition>
        </b-col>
    </b-row>

</template>






<script>
    import {bus} from '../../../../../bus.js';

    export default {

        data: function () {
            return {
                userId: null,
                user: {
                    name: '',
                    email: '',
                },
                title_name: null,
                err: {},
                loading: false
            }
        },

        computed: {
            // validation(field) {
            //     // return this.userId.length > 4 && this.userId.length < 13
            //     return true;
            // }
        },

        mounted() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;
                let app = this;
                let id = app.$route.params.id;
                app.userId = id;
                axios.get('/api/v1/users/' + id)
                    .then(function (resp) {
                        app.loading = false;
                        console.log(resp['data']);
                        app.user = resp.data.user;
                        app.title_name = app.user.last_name + ' ' + app.user.name + ' ' + app.user.patronymic;

                        // bus.$emit('setmess', {
                        //     mess: 'Данные загружены',
                        //     variant: 'info'
                        // });
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


            saveForm() {
                this.loading = true;
                event.preventDefault();
                var app = this;
                var newUser = app.user;
                axios.patch('/api/v1/users/' + app.userId, newUser)
                    .then(function (resp) {
                        app.loading = false;
                        console.log(resp);
                        // app.$router.replace('/admin/users');

                        if ('status' in resp.data && resp.data.status === false) {
                            app.loadData();
                            bus.$emit('setmess', {
                                mess: 'Нет доступа для изменения данных',
                                variant: 'warning'
                            });
                        } else {
                            bus.$emit('setmess', {
                                mess: 'Данные сохранены',
                                variant: 'success'
                            });
                        }

                    })
                    .catch(function (resp) {
                        app.loading = false;
                        console.log(resp.response);
                        app.err = resp.response.data.errors;
                        // console.log(app.err);

                        bus.$emit('setmess', {
                            mess: 'Ошибка: ' + resp.response.data.message,
                            variant: 'danger'
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>