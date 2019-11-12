<template>

    <b-row>
        <b-col>
            <transition name="slide">
                <b-card>
                    <div slot="header">
                        <span style="font-size: 20px; font-weight: bold;">Пользователь</span>
                    </div>

                    <b-navbar type="light" variant="light">
                        <router-link :to="{name: 'Users'}" class="btn btn-primary">Все пользователи</router-link>
                    </b-navbar>

                    <div class="panel panel-default">
                        <div class="panel-heading">Создать нового пользователя</div>
                        <div class="panel-body">
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
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <button class="btn btn-success">Сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </b-card>
            </transition>
        </b-col>
    </b-row>

</template>

<script>
    export default {

        data: function () {
            return {
                userId: null,
                user: {
                    name: '',
                    email: '',
                },
                title_name: null
            }
        },

        mounted() {
            this.loadData();
        },

        methods: {
            loadData() {
                let app = this;
                let id = app.$route.params.id;
                app.userId = id;
                axios.get('/api/v1/users/' + id)
                    .then(function (resp) {
                        console.log(resp);
                        app.user = resp.data;
                        // app.title = app.user.
                    })
                    .catch(function () {
                        alert("Не удалось загрузить пользователя")
                    });
            },


            saveForm() {
                event.preventDefault();
                var app = this;
                var newUser = app.user;
                axios.patch('/api/v1/users/' + app.userId, newUser)
                    .then(function (resp) {
                        app.$router.replace('/admin/users');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удалось изменить данные пользователя");
                    });
            }
        }
    }
</script>

<style scoped>

</style>