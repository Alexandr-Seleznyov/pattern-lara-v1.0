<template>

    <div>
        <a href="https://github.com/UniSharp/laravel-filemanager" target="_blank"><h3>Laravel File Manager</h3></a>
        <lfm
            title="Картинка"
            :banner=banner
        ></lfm>

        <b-card>
            <h5 slot="header">Thumb - {{thumb}}</h5>
            <img :src="thumb" alt="">
        </b-card>
    </div>

</template>



<script>
    import Lfm from '../../parts/Lfm.vue'

    export default{
        components: {
            Lfm
        },

        data() {
            return {
                banner: '/photos/shares/demo_pic/task_1557420449_pwz9l4fm.png',
                thumb: null,
            }
        },

        mounted() {
            this.thumb = this.getThumbs(this.banner);
        },

        methods: {
            getThumbs(banner) {
                var thumb = '',
                    arr = banner.split('/');

                for(var i = 1; i < arr.length; i++) {
                    if(i == arr.length - 1) thumb += '/thumbs/' + arr[i];
                    else thumb += '/' + arr[i];
                }

                return thumb;
            }
        }

    }
</script>


<style scoped>
</style>