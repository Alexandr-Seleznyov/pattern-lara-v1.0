<template>

    <div>
        <b-card>
            <h5 slot="header" style="margin-bottom: 0;">{{ title }}</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a class="btn btn-info" @click="openFileManager">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </div>
                        <input type="text" readonly
                               class="form-control" v-model="banner_comp">
                    </div>
                    <img class="mt-3 lft-img" :src="banner_comp"/>
                </div>
            </div>
        </b-card>
    </div>

</template>






<script>

    export default {

        name: 'Lfm',

        props : {
            banner: {
                default: null,
                type: String
            },
            type: {
                default: 'Images',
                type: String
            },
            title: {
                default: 'Банер',
                type: String
            }
        },

        data: function () {
            return {
                banner_comp: null
            }
        },

        mounted() {
            this.banner_comp = this.banner;
        },

        methods: {

            openFileManager() {
                var params = {
                    type: this.type
                };

                var url = ['/laravel-filemanager', $.param(params)].join('?');

                window.open(
                    url,
                    "DescriptiveWindowName",
                    "width=800,height=700,resizable,scrollbars=yes,status=1"
                );

                var self = this
                window.SetUrl = function (items) {
                    self.banner_comp = items.replace(window.location.origin, '')
                }
                return false
            }

        }
    }
</script>

<style scoped>
    .lft-img{
        height: 250px;
    }
</style>