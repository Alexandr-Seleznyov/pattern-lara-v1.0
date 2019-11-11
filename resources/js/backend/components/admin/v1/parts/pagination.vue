<template>
    <b-input-group style="max-width:450px;">
        <b-pagination
                :total-rows="totalRows"
                :per-page="pag.per_page"
                v-model="pag.current_page"
                first-text="First"
                prev-text="⏪"
                next-text="⏩"
                last-text="Last"
                @change="pageChange">
        </b-pagination>
        <b-form-select v-model="pag.per_page"
                       :options="per_page_options"
                       style="margin-left:15px;"
                       @change="perPageSelected">
        </b-form-select>
    </b-input-group>
</template>

<script>
    export default {
        name: "pagination",

        props: {
            test: {
                type: String,
                default: 'default test'
            },
            currentPage: {
                type: Number,
                default: 1
            },
            perPage: {
                type: Number,
                default: 10
            },
            totalRows: {
                type: Number,
                default: 1
            },
            per_page_selected: {
                type: Number,
                default: 10
            },
            per_page_options: {
                type: Array,
                default: () => [
                    { value: 10, text: '10 rows' },
                    { value: 50, text: '50 rows' },
                    { value: 10, text: '100 rows' },
                ]
            }
        },

        data: function () {
            return {
                pag:{
                    current_page: 1,
                    per_page: 10
                }
            }
        },

        methods : {
            pageChange(page){
                this.pag.current_page = page;
                this.changePagination();
            },

            perPageSelected(val){
                this.pag.per_page = val;
                this.pag.current_page = 1;
                this.changePagination();
            },

            changePagination(){
                this.$emit('changePagination', this.pag);
            }
        },

        mounted(){
            this.pag.current_page = this.currentPage;
            this.pag.per_page = this.perPage;
        }

    }
</script>

<style scoped>

</style>