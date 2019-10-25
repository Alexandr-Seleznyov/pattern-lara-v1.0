<template>
    <div class="wrapper">

        <h1>App.vue</h1>

        <hr>
        <div class="form-group">
            <router-link :to="{name: 'usersIndex'}" class="btn btn-default">Все пользователи</router-link>
        </div>
        <hr>

        <router-view></router-view>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component app');
        }
    }

</script>

<style>
</style>
