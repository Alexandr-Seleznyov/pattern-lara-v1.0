<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'usersCreate'}" class="btn btn-success">Создать нового пользователя</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Список пользователей</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user, index in users">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <router-link :to="{name: 'usersEdit', params: {id: user.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(user.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>



<script>
    export default {
        data: function () {
            return {
                users: []
            }
        },
        mounted() {
            console.log('test');
            var app = this;
            axios.get('/api/v1/users')
                .then(function (resp) {
                    app.users = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось загрузить пользователей");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Вы действительно хотите удалить пользователя?")) {
                    var app = this;
                    axios.delete('/api/v1/users/' + id)
                        .then(function (resp) {
                            app.users.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Не удалось удалить пользователя");
                        });
                }
            }
        }
    }
</script>



<style scoped>

</style>