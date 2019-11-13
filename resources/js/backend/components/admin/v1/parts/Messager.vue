<template>
    <div>
        <b-alert
                :show="dismissCountDown"
                dismissible
                variant="warning"
                @dismissed="dismissCountDown=0"
                @dismiss-count-down="countDownChanged"
        >
            <!--Текст сообщения-->
            This alert will dismiss after {{ dismissCountDown }} seconds...
        </b-alert>
        <!--<b-button @click="showAlert" variant="info" class="m-1">-->
            <!--Show alert with count-down timer-->
        <!--</b-button>-->
    </div>
</template>

<script>

    // import { bus } from '../../../../bus.js';

    export default {
        name: "Messager",

        data() {
            return {
                dismissSecs: 5,
                dismissCountDown: 0
            }
        },

        mounted: {
            // bus.$on('show-alert', this.showAlert);
            // this.$root.$on('show-alert', this.showAlert);
            // Vue.$on('test', function (msg) {
            //     console.log(msg)
            // });
        },

        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },

            showAlert() {
                this.dismissCountDown = this.dismissSecs
            }
        }
    }
</script>

<style scoped>

</style>