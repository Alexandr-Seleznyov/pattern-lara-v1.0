<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'users'}" class="btn btn-default">Все пользователи</router-link>
        </div>

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
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                user: {
                    name: '',
                    email: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newUser = app.user;
                axios.post('/api/v1/users', newUser)
                    .then(function (resp) {
                        app.$router.push({path: '/users'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удалось создать пользователя");
                    });
            }
        }
    }
</script>

<style scoped>

</style>