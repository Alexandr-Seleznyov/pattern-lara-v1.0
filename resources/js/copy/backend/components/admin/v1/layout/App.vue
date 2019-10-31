<template>
    <div>

        <header-layout></header-layout>

        <div class="container-fluid">
            <div class="row">
                <navigate></navigate>

                <router-view></router-view>
            </div>
        </div>

    </div>
</template>

<script>
    import HeaderLayout from './Header.vue';
    import Navigate from './Navigate.vue';

    export default {
        components : {
            HeaderLayout,
            Navigate
        },
        mounted() {
            console.log('Component app');
        }
    }

</script>

<style>
</style>
