<template>
    <div>
        <b-alert
                :show="dismissCountDown"
                :variant="variant"
                @dismissed="dismissCountDown=0"
                @dismiss-count-down="countDownChanged"
        >
            {{ text_message }}
        </b-alert>
        <!--<b-button @click="showAlert" variant="info" class="m-1">-->
            <!--Show alert with count-down timer-->
        <!--</b-button>-->
    </div>
</template>

<script>

    import {bus} from '../../../../bus.js';

    export default {
        name: "messager",
        data() {
            return {
                dismissSecs: 10,      // Количество секунд до исчезновения
                dismissCountDown: 0, // Количество оставшихся секунд
                text_message: null,
                variant: 'info'
            }
        },

        mounted() {
            bus.$on('setmess', this.showAlert)
            // bus.$on('show-alert', this.showAlert);
            // this.$root.$on('show-alert', this.showAlert);
            // Vue.$on('test', function (msg) {
            //     console.log(msg)
            // });
            // this.showAlert();
        },

        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },

            showAlert(arg) {
                if(arg.mess) this.text_message = arg.mess;
                if(arg.variant) this.variant = arg.variant;
                this.dismissCountDown = this.dismissSecs;
            },
        }
    }
</script>

<style scoped>
    .alert{
        margin-top: 9px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>