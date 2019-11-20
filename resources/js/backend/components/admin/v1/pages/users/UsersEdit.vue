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
                                    <div class="col-xs-12 form-group">
                                        <label class="control-label">Имя</label>
                                        <input type="text" v-model="user.name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" v-model="user.email" class="form-control">
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
                loading: false
            }
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


            saveForm() {
                event.preventDefault();
                var app = this;
                var newUser = app.user;
                axios.patch('/api/v1/users/' + app.userId, newUser)
                    .then(function (resp) {
                        app.$router.replace('/admin/users');

                        bus.$emit('setmess', {
                            mess: 'Данные сохранены',
                            variant: 'success'
                        });
                    })
                    .catch(function (resp) {
                        console.log(resp.response);

                        bus.$emit('setmess', {
                            mess: 'Ошибка: ' + resp.response.data.message,
                            variant: 'danger'
                        });
                        // alert("Не удалось изменить данные пользователя");
                    });
            }
        }
    }
</script>

<style scoped>

</style>