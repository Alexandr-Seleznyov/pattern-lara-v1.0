<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <router-view></router-view>
            </div>
        </div>
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
